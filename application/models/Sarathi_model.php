<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sarathi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);
    }

    public function get_total_sarathi()
    {
        $this->db->select('s.uid')->from('sarathi as s')->join('users as u', 's.user_id=u.uid')->where_not_in('u.status', const_deleted)->get();
        return $this->db->affected_rows();
    }

    public function getDriversCount($sarathi_id)
    {
        $this->db->select('u.' . field_uid)->from(table_users . ' as u')
            ->join(table_driver . ' as d', 'u.uid=d.user_id')
            ->where('d.' . field_sarathi_id, $sarathi_id)
            ->where_not_in('u.' . field_status, const_deleted)
            ->where_not_in('u.' . field_status, const_pending)->get();
        return $this->db->affected_rows();
    }

    public function userid_exists($userid, $field_name, $table_name)
    {
        $this->db->select($field_name);
        $this->db->from($table_name);
        $this->db->where($field_name, $userid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function condition_to_get_sarathi()
    { // display sarathi list

        $this->db->select(table_users . '.' . field_uid . ',' . table_users . '.' . field_name . ',' . table_users . '.' . field_email . ',' . table_users . '.' . field_mobile . ',' . table_users . '.' . field_status . ',' . table_sarathi . '.' . field_subfranchise_id);
        $this->db->from(table_users);
        $this->db->join(table_sarathi, table_users . '.' . field_uid . '=' . table_sarathi . '.' . field_user_id);
        $this->db->where_not_in(table_users . '.' . field_status, const_deleted);
        $this->db->where(table_users . '.' . field_type_id, value_user_sarathi);
    }

    public function get_sarathi_details($subfranchise_id)
    {

        if (!empty($subfranchise_id)) {
            $this->condition_to_get_sarathi();
            $this->db->where(table_sarathi . '.' . field_subfranchise_id, $subfranchise_id);
        } else {
            $this->condition_to_get_sarathi();
        }

        $query = $this->db->get();
        $query = $query->result_array();

        foreach ($query as $key => $value) {
            $query[$key]['user_id'] = $value['uid'];
            unset($query[$key]['uid']);

            // get subfranchise
            $subfranchise_id = "";
            $subfranchise_name = "";
            if (array_key_exists('sub_franchise_id', $value)) {
                $subfranchise_id = $value['sub_franchise_id'];
                $subfranchise_name = $this->get_subfranchise_name_by_subfranchise_id($subfranchise_id);
            }
            $arr = [
                'id' => $subfranchise_id,
                'name' => ucfirst($subfranchise_name)
            ];
            $query[$key]['subfranchise'] = $arr;
            unset($query[$key]['sub_franchise_id']);
        }
        return (!empty($query)) ? $query : null;
    }

    public function get_subfranchise_name_by_subfranchise_id($subfranchise_id)
    {
        $this->db->select('u.name');
        $this->db->from('users as u');
        $this->db->join('subfranchise as sf', 'u.uid = sf.user_id');
        $this->db->where('sf.uid', $subfranchise_id);
        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0]['name'] : null;
    }

    public function fetch_subfranchise($franchise_id)
    {
        $this->db->select('sf.uid, u.name');
        $this->db->from('users as u');
        $this->db->join('subfranchise as sf', 'sf.user_id = u.uid');
        $this->db->where(['u.type_id' => 'user_sub_franchise', 'u.status' => 'active']);
        if (!empty($franchise_id)) {
            $this->db->where('sf.franchise_id', $franchise_id);
        }
        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function delete_sarathi_details($userid)
    {
        $uid_exist = $this->userid_exists($userid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_deleted, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $userid);
            $this->db->update(table_users);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else
            return false;
    }

    public function deactive_sarathi_status($userid)
    {
        $uid_exist = $this->userid_exists($userid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_deactive, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $userid);
            $this->db->update(table_users);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else
            return false;
    }


    public function active_sarathi_status($userid)
    {
        $uid_exist = $this->userid_exists($userid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_active, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $userid);
            $this->db->update(table_users);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else
            return false;
    }


    public function update_sarathi_details($user_id, $array, $access, $panel)
    {
        $this->db->where(field_uid, $user_id);
        $update = $this->db->update(table_users, $array);
        if ($update) {
            $deleted = $this->db->where(field_user_id, $user_id)->delete(table_permission);
            if ($deleted) {
                $permission = $this->db->insert_batch(table_permission, $access);
                if ($permission) {
                    $exist = $this->userid_exists($user_id, field_user_id, table_panel_access_permissions);
                    if ($exist) {
                        $this->db->where(field_user_id, $user_id)->update(table_panel_access_permissions, $panel);
                    } else {
                        $this->db->insert(table_panel_access_permissions, $panel);
                    }
                    return ($this->db->affected_rows() == 1) ? true : false;
                }
            }
        }
    }

    public function add_sarathi_details($user_id, $sarathi_id, $gid, $user_type_id, $name, $email, $mobile, $subfranchise_id, $access, $panel)
    {
        $data = [
            field_uid => $user_id,
            field_name => $name,
            field_group_id => $gid,
            field_email => $email,
            field_mobile => $mobile,
            field_type_id => $user_type_id,
            field_created_at => date(field_date),
            field_modified_at => date(field_date)
        ];
        $sarathi_data = [
            field_uid => $sarathi_id,
            field_user_id => $user_id,
            field_subfranchise_id => $subfranchise_id,
            field_created_at => date(field_date),
            field_modified_at => date(field_date)
        ];

        $insert = $this->db->insert(table_users, $data);
        if ($insert) {
            $sarathi = $this->db->insert(table_sarathi, $sarathi_data);
            if ($sarathi) {
                $permission = $this->db->insert_batch(table_permission, $access);
                if ($permission) {
                    $this->db->insert(table_panel_access_permissions, $panel);
                    return ($this->db->affected_rows() > 0) ? true : false;
                }
            }
        } else
            return false;
    }

    public function getSarahiData()
    {
        $this->db->select('u.name, u.created_at as joined, s.uid as id, s.user_id as userId, s.refferal_code, s.total_km_purchased');
        $this->db->from(table_sarathi . ' as s');
        $this->db->join(table_users . ' as u', 's.user_id = u.uid');
        $this->db->where('u.status', const_active);
        $this->db->where('u.type_id', 'user_sarathi');
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $key => $value) {
            $query[$key]['joined'] = date("d/m/Y", strtotime($value['joined']));
            $query[$key]['totalDrivers'] = $this->getDriversCount($value['id']);

            $query[$key]['total_km_purchased'] = (empty($query[$key]['total_km_purchased'])) ? " 0 " : $query[$key]['total_km_purchased'];
            $query[$key]['total_km_purchased'] .= " KM";

            $query[$key]['refferal_code'] = (empty($query[$key]['refferal_code'])) ? " - " : $query[$key]['refferal_code'];
        }
        return $query;
    }

    public function get_sarathi_id_by_user_id($user_id)
    {
        $query = $this->db->select(field_uid)->where(field_user_id, $user_id)->get(table_sarathi);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_uid] : null;
    }

    public function get_access_permission($user_id, $permission_id)
    {
        $this->db->select('status');
        $this->db->where(['user_id' => $user_id, 'permission_id' => $permission_id, 'status' => const_active]);
        $query = $this->db->get('permission');
        $query = $query->result_array();
        return (!empty($query)) ? const_active : const_deactive;
    }

    public function get_sub_franchise($specific_id)
    {
        $query = $this->db->select(field_uid)->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        $query = $query->result_array();
        return $query;
    }

    public function get_sarathi_by_subfranchise_id($subfranchise_id)
    {
        $this->db->select('u.name, u.mobile, u.email, u.status, u.uid as user_id, s.sub_franchise_id');
        $this->db->from('users as u');
        $this->db->join('sarathi as s', 'u.uid = s.user_id');
        $this->db->where('s.sub_franchise_id', $subfranchise_id);
        $this->db->where_not_in('u.status', const_deleted);
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $query[$i]['subfranchise'] = $this->get_subfranchise_name_by_id($val['sub_franchise_id']);
            unset($query['sub_franchise_id']);
        }
        return (!empty($query)) ? $query : [];
    }

    protected function get_subfranchise_name_by_id($subfranchise_id)
    {
        $query = $this->db->select('u.name')->from('users as u')->join('subfranchise as sf', 'u.uid = sf.user_id')
            ->where('sf.uid', $subfranchise_id)->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0] : [];
    }

    public function get_driver_ids($sarathi_id)
    {
        $query = $this->db->select(field_uid)->where(field_sarathi_id, $sarathi_id)->get(table_driver);
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }

    public function get_customer_ids($driver_id)
    {
        $query = $this->db->distinct(field_customer_id)->select(field_customer_id)->where(field_driver_id, $driver_id)->get(table_history_ride_transactions);
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }

    public function get_customers_details($customer_id)
    {
        $this->db->distinct('hrt.customer_id')
            ->select('u.name, u.email, u.mobile, u.status, u.uid as user_id')
            ->from(table_users . ' as u')
            ->join(table_customer . ' as c ', 'u.uid=c.user_id')
            ->join(table_history_ride_transactions . ' as hrt', 'c.uid = hrt.customer_id')
            ->where('hrt' . '.' . field_customer_id, $customer_id);
        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function get_sub_franchise_ids($franchise_id)
    {

        $array = [];

        $query = $this->db->select(field_uid)->where(field_franchise_id, $franchise_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $subfranchise_id = $val[field_uid];

            $query = $this->get_sarathi_ids($subfranchise_id);
            foreach ($query as $i => $val) {
                $array[] = $val[field_user_id];

                foreach ($array as $i => $val) {
                    $user_id = $array[$i];
                    $data[$i] = $this->get_sarathi_details_by_user_id($user_id);
                }
            }
        }
        return (!empty($data)) ? $data : [];
    }

    public function get_sarathi_ids_of_subfranchise($subfranchise_id)
    {
        $array = [];
        $query = $this->get_sarathi_ids($subfranchise_id);
        foreach ($query as $i => $val) {
            $array[] = $val[field_user_id];

            foreach ($array as $i => $val) {
                $user_id = $array[$i];
                $data[$i] = $this->get_sarathi_details_by_user_id($user_id);
            }
        }
        return (!empty($data)) ? $data : [];
    }




    public function get_sarathi_ids($subfranchise_id)
    {
        $query = $this->db->select(field_user_id)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();
        return $query;
    }

    public function get_sarathi_details_by_user_id($user_id)
    {
        $query = $this->db->select('u.uid as user_id, u.name, u.email, u.mobile, u.status, s.sub_franchise_id')
            ->from('users as u')->join('sarathi as s', 'u.uid=s.user_id')
            ->where('u.uid', $user_id)
            ->where_not_in('u.status', const_deleted)->get();
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $sf_id = $val['sub_franchise_id'];
            $query[$i]['subfranchise'] = $this->get_subfranchise_name_by_id($sf_id);
        }
        return (!empty($query)) ? $query : [];
    }

    // public function get_sarathi_details_by_user_id($user_id){
    //     $query=$this->db->select('u.uid as user_id, u.name, u.email, u.mobile, u.status, s.sub_franchise_id')
    //          ->from('users as u')->join('sarathi as s', 'u.uid=s.user_id')
    //          ->where('u.uid', $user_id)
    //          ->where_not_in('u.status', const_deleted)->get();
    //     $query=$query->row();
    //     // foreach($query as $i=>$val){
    //         // $sf_id=$val['sub_franchise_id'];
    //         $sf_id=$query->sub_franchise_id;
    //         $query->subfranchise=$this->get_subfranchise_name_by_id($sf_id);
    //     // }
    //     return(!empty($query))?$query:[];
    // }


    public function get_user_name_by_id($user_id){
        $this->db->select(field_name);
        $this->db->limit(1);
        $this->db->where(field_uid, $user_id);
        $query = $this->db->get(table_users);
        $query = $query->result_array();
        $query = (!empty($query)) ? $query[0] : "";
        return (!empty($query)) ? $query[field_name] : "";       
    }


    public function get_recharge_histiry_of_sarathi($user_id){
        $this->db->select(field_recharge_amount . ',' . field_original_km . ',' . field_extra_km . ',' . field_created_at . ','. field_paid_to_user_id . ','. field_payment_mode . ',' . field_recharge_type . ',' . field_payment_status . ',' . field_note . ',' . field_payment_id);
        $this->db->where(field_user_id, $user_id);
        $query = $this->db->get(table_recharge_history);
        $query = $query->result_array();

        $final_arr = [];
        foreach ($query as $key => $value) {
            $paid_to_user_name = "";
            if(!empty($value[field_paid_to_user_id])){
                $paid_to_user_name = $this->get_user_name_by_id($value[field_paid_to_user_id]);
            }
            if($value[field_recharge_type] == STATIC_RECHARGE_TYPE_PAID){

                $rechargeBy = '';
                if( $value[field_note] != NULL || !empty($value[field_note]) ){
                    $rechargeBy = $value[field_note];
                }else if($value[field_payment_id] != NULL){
                    $rechargeBy = STATIC_TEXT_SELF_RECHARGED_BY_DRIVER;
                }else{
                    $rechargeBy = STATIC_TEXT_RECHARGED_BY_SARATHI;
                }

                $final_arr[] = [
                    key_recharge_type => STATIC_RECHARGE_TO_DRIVER,
                    key_transaction_for => strtoupper(str_replace(' ', '_', STATIC_RECHARGE_TO_DRIVER)),
                    key_price=> $value[field_recharge_amount],
                    key_purchesed_km => (string)($value[field_original_km] + $value[field_extra_km]),
                    key_description => 'To ' . $paid_to_user_name . ' for ' . STATIC_RUPEE_SIGN . ' ' .$value[field_recharge_amount],
                    key_date => date("d\nF", strtotime($value[field_created_at])),
                    key_color_code => color_recharge_paid,
                    key_recharge_note => ucwords($rechargeBy)
                ];
            }else{
                $final_arr[] = [
                    key_recharge_type => STATIC_RECHARGE_FOR_SELF,
                    key_transaction_for => strtoupper(str_replace(' ', '_', STATIC_RECHARGE_FOR_SELF)),
                    key_price => $value[field_recharge_amount],
                    key_purchesed_km => (string)($value[field_original_km] + $value[field_extra_km]),
                    key_description => 'Recharge for '.  STATIC_RUPEE_SIGN . ' ' .$value[field_recharge_amount],
                    key_date => date("d\nF", strtotime($value[field_created_at])),
                    key_color_code => color_recharge_self,
                    key_recharge_note => STATIC_RECHARGE_FOR_SELF
                ];
            }
        }
        return (!empty($query)) ? $final_arr : [];
    }


    public function get_user_details($sarathi_id){
        $query = $this->db->select('u.name, u.mobile, u.email, u.status')->from(table_users.' as u')
        ->join(table_sarathi.' as s', 'u.uid=s.user_id')->where('s.uid', $sarathi_id)->get();
        $query = $query->result_array();
        return(!empty($query))?$query[0]:[];
    }



   
}
