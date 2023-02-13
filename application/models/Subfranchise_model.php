<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subfranchise_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    private function userid_exists($userid, $field_name, $table_name)
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

    // public function get_total_sub_franchise()
    // {
    //     $this->db->get('subfranchise');
    //     return $this->db->affected_rows();
    // }

    public function get_total_sub_franchise()
    {

        $this->db->select('sf.uid as subfranchise_id');
        $this->db->from('subfranchise as sf');
        $this->db->join('users as u', 'u.uid = sf.user_id');
        $this->db->where('u.status', const_active);
        $this->db->get();
        return $this->db->affected_rows();
    }

    public function condition_to_get_subfranchise()
    {
        $this->db->select('u.uid, u.name, u.email, u.mobile, u.status, sf.franchise_id');
        $this->db->from('users as u');
        $this->db->join('subfranchise as sf', 'sf.user_id = u.uid');
        $this->db->where_not_in('u.status', 'deleted');
        $this->db->where('u.type_id', 'user_sub_franchise');
    }

    public function get_sub_franchise_details($franchise_id)
    {

        if (!empty($franchise_id)) {
            $this->condition_to_get_subfranchise();
            $this->db->where('sf.franchise_id', $franchise_id);
        } else {
            $this->condition_to_get_subfranchise();
        }

        $query = $this->db->get();
        $query = $query->result_array();

        foreach ($query as $key => $value) {
            $query[$key]['user_id'] = $value['uid'];
            unset($query[$key]['uid']);

            // get franchise
            $franchise_id = "";
            $franchise_name = "";
            if (array_key_exists('franchise_id', $value)) {
                $franchise_id = $value['franchise_id'];
                $franchise_name = $this->get_franchise_name_by_franchise_id($franchise_id);
            }
            $arr = [
                'id' => $franchise_id,
                'name' => ucfirst($franchise_name)
            ];
            $query[$key]['franchise'] = $arr;
            unset($query[$key]['franchise_id']);
        }

        return (!empty($query)) ? $query : null;
    }

    public function get_franchise_name_by_franchise_id($franchise_id)
    {
        $this->db->select('u.name');
        $this->db->from('users as u');
        $this->db->join('franchise as f', 'u.uid = f.user_id');
        $this->db->where('f.uid', $franchise_id);
        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0]['name'] : null;
    }

    public function delete_sub_franchise_details($uid)
    {
        $uid_exist = $this->userid_exists($uid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_deleted, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $uid);
            $this->db->update(table_users);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else
            return false;
    }

    public function deactive_sub_franchise_status($uid)
    {

        $uid_exist = $this->userid_exists($uid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_deactive, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $uid);
            $this->db->update(table_users);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else
            return false;
    }

    public function active_sub_franchise_status($uid)
    {
        $uid_exist = $this->userid_exists($uid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_active, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $uid);
            $this->db->update(table_users);
            return ($this->db->affected_rows() == 1) ? true : false;
        } else
            return false;
    }

    public function update_sub_franchise_details($user_id, $array, $access, $panel)
    {

        $this->db->where(field_uid, $user_id);
        $update = $this->db->update(table_users, $array);
        if ($update) {
            $deleted = $this->db->where(field_user_id, $user_id)->delete(table_permission);
            if ($deleted) {
                $permission=$this->db->insert_batch(table_permission, $access);
                if($permission){
                    $this->db->where(field_user_id, $user_id)->update(table_panel_access_permissions, $panel);
                    return ($this->db->affected_rows() ==1)? true : false;
                }
            }
        }
    }

    public function add_sub_franchise_details($subfranchise_id, $user_id, $gid, $name, $email, $mobile, $user_type_id, $password, $franchise_id, $access, $panel, $address_data, $specific_id)
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

        $sub_franchise_data = [
            field_uid => $subfranchise_id,
            field_franchise_id => $franchise_id,
            field_user_id => $user_id,
            field_password => md5($password),
            field_created_by=> $specific_id,
            field_created_at => date(field_date),
            field_modified_at => date(field_date)
        ];

        $insert = $this->db->insert(table_users, $data);
        if ($insert) {
            $sub_franchise = $this->db->insert(table_subfranchise, $sub_franchise_data);
            if ($sub_franchise) {
                $permission = $this->db->insert_batch(table_permission, $access);
                if ($permission) {
                    $permission = $this->db->insert(table_panel_access_permissions, $panel);
                    if($permission){
                        $this->db->insert(table_address, $address_data);
                        return ($this->db->affected_rows() == 1) ? true : false;
                    }
                }
            }
        } else {
            return false;
        }
    }

    public function display_all_franchise()
    {

        $this->db->select('f.uid, u.name');
        $this->db->from('users as u');
        $this->db->join('franchise as f', 'f.user_id = u.uid');
        $this->db->where(['u.type_id' => 'user_franchise', 'u.status' => 'active']);
        $query = $this->db->get();
        $query = $query->result();
        return (!empty($query)) ? $query : null;
    }


    ///////////////// sub franchise details //////////////////////////

    public function subfranchise_details($user_id)
    {
        $this->db->select('users.uid, users.name, subfranchise.uid as subfranchise_id');
        $this->db->from('users');
        $this->db->join('subfranchise', 'users.uid = subfranchise.user_id');
        $this->db->where('subfranchise.user_id', $user_id);

        // $this->db->select(table_users.'.'.field_uid.','. table_users.'.'.field_name.','. table_subfranchise.'.'.field_uid.' as subfranchise_id');
        // $this->db->from(table_users);
        // $this->db->join(table_subfranchise, table_users.'.'.field_uid.'='. table_subfranchise.'.'.field_user_id);
        // $this->db->where(table_subfranchise.'.'.field_user_id, $user_id);

        $query = $this->db->get();
        $query = $query->result();
        return (!empty($query)) ? $query : [];
    }

    public function get_subfranchise_id_by_user_id($user_id)
    {
        $this->db->select(field_uid);
        $this->db->where(field_user_id, $user_id);
        $query = $this->db->get(table_subfranchise);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_uid] : null;
    }


    public function get_all_sarathi_of_subfranchise($subfranchise_id)
    {

        $this->db->select('users.uid, users.name, users.email, users.mobile, users.status');
        $this->db->from('users');
        $this->db->join('sarathi', 'users.uid = sarathi.user_id');
        $this->db->where('sarathi.sub_franchise_id', $subfranchise_id);
        $this->db->where_not_in('users.status', 'deleted');
        $this->db->where_not_in('users.status', 'pending');

        // $this->db->select(table_users.'.'.field_uid.','. table_users.'.'.field_name.','. table_users.'.'.field_email.','. table_users.'.'.field_mobile.','. table_users.'.'.field_status);
        // $this->db->from(table_users);
        // $this->db->join(table_sarathi, table_users.'.'.field_uid.'='. table_sarathi.'.'.field_user_id);
        // $this->db->where(table_sarathi.'.'.field_subfranchise_id, $subfranchise_id);
        // $this->db->where_not_in(table_users.'.'.field_status, const_deleted);
        // $this->db->where_not_in(table_users.'.'.field_status,const_pending);

        $query = $this->db->get();
        return $query->result_array();
    }


    /////////////////////////////////////////////////////


}
