<?php
class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);
        
    }

    private function get_user_type_id($user_type)
    {
        $this->db->select(field_id);
        $this->db->where(field_name, $user_type);
        $query = $this->db->get(table_user_type);
        $query = $query->result_array();
        return $query[0][field_id];
    }

   
    public function is_this_value_exist($field_value, $field_name, $table, $user_type_id){
        $this->db->select(table_user_type . '.' . field_name);
        $this->db->from($table);
        $this->db->join(table_user_type, $table . '.' . field_type_id . ' = ' . table_user_type . '.' . field_uid);
        $this->db->where(table_users . '.' . $field_name, $field_value);
        $this->db->where('users.type_id', $user_type_id);
        $this->db->where('users.status', const_active);
        $query = $this->db->get();
        $query = $query->result();
        return (!empty($query)) ? $query[0] : [];
    }

    public function get_user_type_id_by_user_type_name($user_type_name)
    {
        $this->db->select(field_uid);
        $this->db->where(field_name, $user_type_name);
        $query = $this->db->get(table_user_type);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_uid] : null;
    }

    public function is_value_exist($mobile, $user_id, $field_name)
    {
        $this->db->where(field_uid, $user_id);
        $this->db->where($field_name, $mobile);
        $this->db->get(table_users);
        return ($this->db->affected_rows() >= 1) ? true : false;
    }

    public function get_user_details_by_user_id($user_id)
    {
        $this->db->where('uid', $user_id);
        $query = $this->db->get('users');
        $query = $query->result();
        return (!empty($query)) ? $query[0] : null;
    }

    public function get_specific_id_by_user_id($user_id, $table)
    {

        $query = $this->db->select('t.uid')->from($table . ' as t')->join(table_users . ' as u', 'u.uid = t.user_id')->where('t.user_id', $user_id)->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_uid] : null;
    }


    ////////////////////////////////////// FRANCHISE DASHBOARD ///////////////////////////////////////////////////////////

    public function get_total_sub_franchise($specific_id)
    {
        $this->db->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        return $this->db->affected_rows();
    }

    public function get_total_sarathi($specific_id){    // get sarathi of each subfranchise
        $sarathi = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach ($query as $key => $val) {
            $subfranchise_id = $val[field_uid];
            $sarathi = $sarathi + $this->get_sarathi_of_subfranchise($subfranchise_id);
        }
        return $sarathi;
    }

    public function get_sarathi_of_subfranchise($subfranchise_id)
    {
        $query = $this->db->select('u.'.field_uid)->from(table_users.' as u')
        ->join(table_sarathi.' as s', 'u.uid=s.user_id')
        ->where('s.'.field_subfranchise_id, $subfranchise_id)
        ->where_not_in('u.'.field_status, const_deleted)->get();
        $query = $query->result_array();
        return $this->db->affected_rows();
    }

    // =========================================== //

    public function get_total_drivers($specific_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach ($query as $key => $val) {
            $subfranchise_id = $val[field_uid];
            $driver = $driver + $this->get_sarathi_id_by_subfranchise_id($subfranchise_id);
        }
        return $driver;
    }

    public function get_sarathi_id_by_subfranchise_id($subfranchise_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach ($query as $key => $val) {
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_driver_of_sarathi($sarathi_id);
        }
        return $driver;
    }

    public function get_driver_of_sarathi($sarathi_id)
    {

        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
            ->where('d.' . field_sarathi_id, $sarathi_id)
            ->where_not_in('u.status', const_pending)
            ->where_not_in('u.status', const_deleted)->get();

        return $this->db->affected_rows();
    }

    // ==================================== //

    public function get_total_customers($franchise_id)
    {
        $customer = 0;

        $query = $this->db->select(field_uid)->where(field_franchise_id, $franchise_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $sf_id = $val[field_uid];
            $sarathi = $this->get_sarathi_of_sub_franchise($sf_id);

            foreach ($sarathi as $i => $val) {
                $sarathi_ids[] = $sarathi[$i];
            }

            foreach ($sarathi_ids as $i => $val) {
                $sarathi_id = $sarathi_ids[$i][field_uid];
                $result_array = $this->get_total_driver_of_sarathi($sarathi_id);
                foreach ($result_array as $i => $array_value) {
                    $driver[] = $array_value[field_uid];
                }
            }
            $driver = array_unique($driver);
            foreach ($driver as $i => $val) {
                $driver_id = $driver[$i];
                $customer += $this->get_total_customer_of_driver($driver_id);
            }
        }
        return (!empty($customer)) ? $customer : 0;
    }

    private function get_sarathi_of_sub_franchise($subfranchise_id)
    {
        $query = $this->db->distinct(field_uid)->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }

    private function get_total_driver_of_sarathi($sarathi_id)
    {

        $query = $this->db->distinct(field_uid)->select(field_uid)->where(field_sarathi_id, $sarathi_id)->get(table_driver);
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }

    private function get_total_customer_of_driver($driver_id)
    {
        $this->db->distinct(field_customer_id);
        $query = $this->db->select(field_customer_id)
            ->where(field_driver_id, $driver_id)->get(table_history_ride_transactions);
        $query = $query->result_array();
        return (!empty($query)) ? count($query) : 0;
    }


    // ====================================================

    public function get_total_active_drivers($specific_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach ($query as $key => $val) {
            $subfranchise_id = $val[field_uid];
            $driver = $driver + $this->get_sarathi_id_by_subfranchise_id_for_driver($subfranchise_id);
        }
        return $driver;
    }

    public function get_sarathi_id_by_subfranchise_id_for_driver($subfranchise_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach ($query as $key => $val) {
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_active_driver_of_sarathi($sarathi_id);
        }
        return $driver;
    }

    public function get_active_driver_of_sarathi($sarathi_id)
    {
        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
            ->where('d.' . field_sarathi_id, $sarathi_id)
            ->where('d.working_status', const_active)
            ->where_not_in('u.status', const_pending)
            ->where_not_in('u.status', const_deleted)->get();
        return $this->db->affected_rows();
    }

    //=========================================================

    public function get_total_running_drivers($specific_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach ($query as $key => $val) {
            $subfranchise_id = $val[field_uid];
            $driver = $driver + $this->get_sarathi_id_by_subfranchise_id_for_driver($subfranchise_id);
        }
        return $driver;
    }

    public function get_sarathi_id_by_subfranchise_id_for_running_driver($subfranchise_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach ($query as $key => $val) {
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_running_driver_of_sarathi($sarathi_id);
        }
        return $driver;
    }

    public function get_running_driver_of_sarathi($sarathi_id)
    {
        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
            ->where('d.' . field_sarathi_id, $sarathi_id)
            ->where('d.working_status_current_value', STATUS_DRIVER_GO_TO)
            ->where_not_in('u.status', const_pending)
            ->where_not_in('u.status', const_deleted)->get();
        return $this->db->affected_rows();
    }

    // =========================================================================

    public function get_total_inactive_drivers($specific_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach ($query as $key => $val) {
            $subfranchise_id = $val[field_uid];
            $driver = $driver + $this->get_sarathi_id_by_subfranchise_id_for_inactive_driver($subfranchise_id);
        }
        return $driver;
    }

    public function get_sarathi_id_by_subfranchise_id_for_inactive_driver($subfranchise_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach ($query as $key => $val) {
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_inactive_driver_of_sarathi($sarathi_id);
        }
        return $driver;
    }

    public function get_inactive_driver_of_sarathi($sarathi_id)
    {
        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
            ->where('d.' . field_sarathi_id, $sarathi_id)
            ->where('d.working_status', const_deactive)
            ->where_not_in('u.status', const_pending)
            ->where_not_in('u.status', const_deleted)->get();
        return $this->db->affected_rows();
    }


    /////////////////////////////// Sub franchise dashboard ///////////////////////////////

    public function get_total_sarathi_of_sub_franchise($subfranchise_id)
    {
        $this->db->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        return $this->db->affected_rows();
    }

    public function get_total_driver_of_sub_franchise($subfranchise_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach ($query as $key => $val) {
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_driver_of_sf($sarathi_id);
        }
        return $driver;
    }

    public function get_driver_of_sf($sarathi_id)
    {
        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
            ->where('d.' . field_sarathi_id, $sarathi_id)
            ->where_not_in('u.status', const_pending)
            ->where_not_in('u.status', const_deleted)->get();
        return $this->db->affected_rows();
    }

    public function get_total_active_driver_of_sub_franchise($subfranchise_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach ($query as $key => $val) {
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_active_driver_of_sarathi($sarathi_id);
        }
        return $driver;
    }


    public function get_total_inactive_driver_of_sub_franchise($subfranchise_id)
    {
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach ($query as $key => $val) {
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_inactive_driver_of_sarathi($sarathi_id);
        }
        return (!empty($driver))?$driver:0;
    }

    public function get_total_customers_of_subfranchise($sf_id)
    {
        $customer = 0;

        $sarathi = $this->get_sarathi_of_sub_franchise($sf_id);

        foreach ($sarathi as $i => $val) {
            $sarathi_ids[] = $sarathi[$i];
        }

        foreach ($sarathi_ids as $i => $val) {
            $sarathi_id = $sarathi_ids[$i][field_uid];
            $result_array = $this->get_total_driver_of_sarathi($sarathi_id);
            foreach ($result_array as $i => $array_value) {
                $driver[] = $array_value[field_uid];
            }
        }
        $driver = array_unique($driver);
        foreach ($driver as $i => $val) {
            $driver_id = $driver[$i];
            $customer += $this->get_total_customer_of_driver($driver_id);
        }

        return (!empty($customer)) ? $customer : 0;
    }

    ///  ================================  ///

    public function getSarahiData_for_franchise($franchise_id)
    {
        $query = $this->db->select(field_uid)->where(field_franchise_id, $franchise_id)->get(table_subfranchise);
        $query = $query->result_array();

        foreach ($query as $i => $val) {
            $sf_id = $val[field_uid];
            $array_result = $this->get_sarathi_of_sub_franchise($sf_id);
            foreach ($array_result as $i => $value) {
                $sarathi_id = $value[field_uid];
                $sarathi[] = $this->getSarahiData($sarathi_id);
            }
        }
        return (!empty($sarathi)) ? $sarathi : [];
    }

    public function getSarahiData_for_subfranchise($sf_id)
    {
        $array_result = $this->get_sarathi_of_sub_franchise($sf_id);
        foreach ($array_result as $i => $value) {
            $sarathi_id = $value[field_uid];
            $sarathi[] = $this->getSarahiData($sarathi_id);
        }
        return (!empty($sarathi)) ? $sarathi : [];
    }



    public function getSarahiData($sarathi_id)
    {
        $this->db->select('u.name, u.created_at as joined, s.uid as id, s.user_id as userId, s.refferal_code, s.total_km_purchased');
        $this->db->from(table_sarathi . ' as s');
        $this->db->join(table_users . ' as u', 's.user_id = u.uid');
        $this->db->where('u.status', const_active);
        $this->db->where_not_in('u.status', const_deleted);
        $this->db->where_not_in('u.status', const_pending);
        $this->db->where('s.uid', $sarathi_id);
        $this->db->where('u.type_id', 'user_sarathi');
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $key => $value) {
            $query[$key]['name'] = strtoupper($value['name']);
            $query[$key]['joined'] = date("d/m/Y", strtotime($value['joined']));
            $query[$key]['totalDrivers'] = $this->getDriversCount($value['id']);

            $query[$key]['total_km_purchased'] = (empty($query[$key]['total_km_purchased'])) ? " 0 " : $query[$key]['total_km_purchased'];
            $query[$key]['total_km_purchased'] .= " KM";

            $query[$key]['refferal_code'] = (empty($query[$key]['refferal_code'])) ? " - " : $query[$key]['refferal_code'];
        }
        return (!empty($query)) ? $query[0] : [];
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

    /////////////////////////// customer listing /////////////////////////////////////////

    // public function get_customer_for_franchise($franchise_id){
    //     $query=$this->db->select(field_uid)->where(field_franchise_id, $franchise_id)->get(table_subfranchise);
    //     $query=$query->result_array();
    //     foreach($query as $i=>$val){
    //         $sf_id=$val[field_uid];
    //         $sarathi=$this->get_sarathi_of_sub_franchise($sf_id);

    //         foreach($sarathi as $i=>$val){
    //             $sarathi_ids[] = $sarathi[$i];
    //         }

    //         foreach($sarathi_ids as $i=>$val){
    //             $sarathi_id = $sarathi_ids[$i][field_uid];
    //             $result_array = $this->get_total_driver_of_sarathi($sarathi_id);
    //             foreach($result_array as $i => $array_value){
    //                 $driver[] = $array_value[field_uid];
    //             }
    //         }
    //         $driver=array_unique($driver);
    //         foreach($driver as $i=>$val){
    //             $driver_id = $driver[$i];
    //             $result_array = $this->get_customer_of_drivers($driver_id);
    //             foreach($result_array as $i => $array_value){
    //                 $customer[] = $array_value[field_customer_id];
    //             }
    //         }
    //     }
    //     return $customer;
    // }

    // private function get_customer_of_drivers($driver_id){
    //     $query = $this->db->distinct(field_customer_id)->select(field_customer_id)->where(field_driver_id, $driver_id)->get(table_history_ride_transactions);
    //     $query = $query->result_array();
    //     foreach($query as $i=>$val){
    //         $customer_id=$val[field_customer_id];

    //     }
    //     return(!empty($query))?$query:[];
    // }

    // private function get_customer_details_by_id($customer_id){
    //     $query = $this->db->select('u.uid as user_id, u.name, u.email, u.mobile, u.status')->from(table_users.' as u')
    //     ->join(table_customer.' as c', 'u.uid = c.user_id')
    //     ->where('c.'.field_uid, $customer_id)
    //     ->where_not_in('u.'.field_status, const_deleted)
    //     ->where_not_in('u.'.field_status, const_pending)->get();
    //     $query = $query->result_array();
    //     return(!empty($query))?$query:[];
    // }


    ///////////////// //////////////////////


    public function get_total_revenue_old($franchise_id)
    {
        $revenue = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $franchise_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $sf_id = $val[field_uid];
            $result_array = $this->get_sarathi_of_sub_franchise($sf_id);

            foreach ($result_array as $i => $value) {
                $sarathi_id = $value[field_uid];
                $revenue += $this->get_revenue_of_each_sarathi($sarathi_id);
            }
        }
        return (!empty($revenue)) ? $revenue : 0;
    }




    public function get_total_revenue_of_last_month($franchise_id)
    {
        $revenue = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $franchise_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $sf_id = $val[field_uid];
            $result_array = $this->get_sarathi_of_sub_franchise($sf_id);

            foreach ($result_array as $i => $value) {
                $sarathi_id = $value[field_uid];
                $revenue += $this->get_last_month_revenue($sarathi_id);
            }
        }
        return (!empty($revenue)) ? $revenue : 0;
    }

    public function get_total_revenue_of_last_month_of_sf($sf_id)
    {
        $revenue = 0;

        $result_array = $this->get_sarathi_of_sub_franchise($sf_id);

        foreach ($result_array as $i => $value) {
            $sarathi_id = $value[field_uid];
            $revenue += $this->get_last_month_revenue($sarathi_id);
        }
        return (!empty($revenue)) ? $revenue : 0;
    }

    public function get_total_revenue_of_subfranchise_old($sf_id)
    {
        $revenue = 0;
        $result_array = $this->get_sarathi_of_sub_franchise($sf_id);
        foreach ($result_array as $i => $value) {
            $sarathi_id = $value[field_uid];
            $revenue += $this->get_revenue_of_each_sarathi($sarathi_id);
        }
        return (!empty($revenue)) ? $revenue : 0;
    }

    private function get_revenue_of_each_sarathi($sarathi_id)
    {
        $query = $this->db->select('SUM(hrt.amount) as total_amount')
            ->from(table_history_ride_transactions . ' as hrt')
            ->join('driver as d', 'hrt.driver_id=d.uid')
            ->join('sarathi as s', 'd.sarathi_id=s.uid')
            ->where('d.sarathi_id', $sarathi_id)
            ->where('hrt.' . field_status, const_success)
            ->get();
        $query = $query->result_array();

        return (!empty($query)) ? $query[0]['total_amount'] : 0;
    }

    public function get_revenue_status($specific_id)
    {
        $current_rev = $this->get_total_revenue($specific_id);
        $last_rev = $this->get_total_revenue_of_last_month($specific_id);
        if($last_rev==0){
            return 0;
        }
        $growth = (($current_rev - $last_rev) / $last_rev) * 100;
        return (!empty($growth)) ? round($growth) : null;
    }

    public function get_revenue_status_of_subfranchise($subfranchise_id)
    {
        $current_rev = $this->get_total_revenue_of_subfranchise($subfranchise_id);
        $last_rev = $this->get_total_revenue_of_last_month_of_sf($subfranchise_id);
        if($current_rev > $last_rev){
            if($last_rev==0){
                return 0;
            }
            $growth = (($current_rev - $last_rev) / $last_rev) * 100;
            return (!empty($growth)) ? round($growth) : 0;
        }
        else{
            return 0;
        }
    }

    private function get_last_month_revenue($specific_id)
    {

        $query = $this->db->select('SUM(hrt.amount) as total_amount')
            ->from(table_history_ride_transactions . ' as hrt')
            ->join('driver as d', 'hrt.driver_id=d.uid')
            ->join('sarathi as s', 'd.sarathi_id=s.uid')
            ->where('d.sarathi_id', $specific_id)
            ->where('hrt.' . field_status, const_success)
            ->where('hrt.created_at < (DATE_SUB(NOW(), INTERVAL 1 MONTH))', NULL, FALSE)
            ->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0]['total_amount'] : 0;
    }


    public function total_km_purchase($specific_id, $table){
        $query = $this->db->select(field_total_km_purchased)->where(field_uid, $specific_id)->get($table);
        $query = $query->result_array();
        return (!empty($query))?$query[0][field_total_km_purchased]:0;
    }

    /////////////////////////////////////////////////////////////

    public function display_driver_location($franchise_id)
    {
        $query = $this->db->select(field_uid)->where(field_franchise_id, $franchise_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $sf_id = $val[field_uid];
            $array_result = $this->get_sarathi_of_sub_franchise($sf_id);
            foreach ($array_result as $i => $val) {
                $sarathi_id = $val[field_uid];
                $driver = $this->driver_location($sarathi_id);
                foreach ($driver as $i => $val) {
                    $location[] = $val;
                }
                unset($query[$i][field_uid]);
            }
        }
        return $location;
    }



    public function display_driver_location_of_subfranchise($sf_id)
    {
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $sf_id)->get(table_sarathi);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $sarathi_id = $val[field_uid];
            $driver = $this->driver_location($sarathi_id);
            foreach ($driver as $i => $val) {
                $location[] = $val;
            }
            unset($query[$i][field_uid]);
        }
        return (!empty($location)) ? $location : null;
    }

    private function driver_location($sarathi_id)
    {
        $this->db->select('d.uid as driver_id, d.current_lat as lat, d.current_lng as lng, u.name as driver_name, d.working_status_current_value as driver_status, d.totalTravelled, d.vehicle_number');
        $this->db->from('driver as d');
        $this->db->join('users as u', 'u.uid = d.user_id');
        $this->db->where('d.sarathi_id', $sarathi_id);
        $this->db->where('u.status', const_active);
        $this->db->where_not_in('d.current_lat', 'NULL');
        $this->db->where_not_in('d.current_lng', 'NULL');
        $this->db->where_not_in('d.working_status_current_value', 'NULL');
        $query = $this->db->get();
        $query = $query->result_array();

        foreach ($query as $i => $val) {
            $query[$i]['driver_name'] = ucwords($val['driver_name']);
        }
        return (!empty($query)) ? $query : [];
    }


    //////////////////////////// PANEL ACCESS /////////////

    public function get_panel_access_list($user_id)
    {
        $query = $this->db->select('permission')->where(field_user_id, $user_id)->get(table_panel_access_permissions);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $query[$i]['permission'] = json_decode($val['permission']);
        }
        return (!empty($query)) ? $query[0] : null;
    }

    public function get_user_panel_access($user_id)
    {
        $query = $this->db->select('permission')->where(field_user_id, $user_id)->get(table_panel_access_permissions);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $query[$i]['permission'] = json_decode($val['permission']);
        }
        return (!empty($query)) ? $query[0] : [];
    }

    public function get_status_by_user_id($user_id){
        $query = $this->db->select(field_status)->where(field_uid, $user_id)->get(table_users);
        $query = $query->result_array();
        return(!empty($query))?$query[0][field_status]:const_deactive;
    }

    public function get_user_details($specific_id, $table){
        $query = $this->db->select('u.name, u.mobile, u.email, u.status, t.uid as specific_id')->from(table_users.' as u')
        ->join($table.' as t', 'u.uid=t.user_id')->where('t.uid', $specific_id)->get();
        $query = $query->result_array();
        return (!empty($query))?$query[0]:[];
    }

    public function get_packages($user_type){
        $query = $this->db->select(field_uid .",". field_name)
        ->where([field_user_type_id => $user_type, field_status => const_active])->get(table_packages);
        $query = $query->result_array();
        return (!empty($query))?$query:[];
    }

    public function getRatePerKm(){
        $this->db->select(field_rate_per_km);
        $this->db->limit(1);
        $this->db->order_by(field_created_at, value_sort_dir_desc);
        $query = $this->db->get(table_rate_per_km);
        $query = $query->result_array();
        return (!empty($query))?$query[0][field_rate_per_km]:[];
    }

    public function get_extra_percentage_km_by_user_type($user_type){
        $this->db->select(field_percentage);
        $this->db->where(field_user_type_id, $user_type);
        $query = $this->db->get(table_excess_percentage);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_percentage] : null ;
    }

    public function get_user_id_by_specific_id($specific_id, $table){
        $query = $this->db->select('u.uid')->from('users as u')->join($table. ' as t', 'u.uid=t.user_id')
        ->where('t.uid', $specific_id)->get();
        $query = $query->result_array();

        return(!empty($query))?$query[0][field_uid]:null;
    }

    public function get_user_recharge_data($user_id){
        $query = $this->db->select('original_km, date(created_at) as recharge_date')
        ->where([field_user_id=> $user_id, field_recharge_type=>'received'])
        ->get('recharge_history');
        $query = $query->result_array();
        return (!empty($query))?$query:null;
    }

    public function get_sarathi_id_by_driver_user_id($user_id){
        $query = $this->db->select(field_sarathi_id)->where(field_user_id, $user_id)->get(table_driver);
        $query = $query->result_array();
        return(!empty($query))?$query[0][field_sarathi_id]:null;
    }


    public function total_km_purchase_today($user_id)
    {
        $query = $this->db->select('SUM(original_km) as today_recharge')
            ->where(['recharge_type' => 'received', 'payment_status' => 'captured', field_user_id => $user_id])
            ->group_start()
            ->where('rechargeIn', 'purchaseKm')
            ->or_where('rechargeIn', NULL)
            ->group_end()
            ->like(field_created_at, date('Y-m-d'))
            ->get(table_recharge_history);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0]['today_recharge'] : 0;
    }

    /////////////////////////////////

    public function giveDriverBonous100KmAsFirstTime($user_id_of_sarathi, $user_id_of_driver){
        $km = 100;
        $sarathi_data_in_recharge_history = [
            field_uid               => $this->Uid_server_model->generate_uid(KEY_RECHARGE),
            field_user_id           => $user_id_of_sarathi,
            field_payment_mode      => STATIC_RECHARGE_MODE_ONLINE,
            field_order_id          => $this->Uid_server_model->generate_uid(KEY_ORDER),
            field_package_id        => '',
            field_recharge_type     => STATIC_RECHARGE_TYPE_PAID,
            field_recharge_amount   => $km,
            field_original_km       => $km,
            field_extra_km          => 0,
            field_paid_to_user_id   => $user_id_of_driver,
            field_payment_status    => constant_captured,
            field_created_at        => date(field_date)
        ];
        $recharge = $this->insertRechargeTable($sarathi_data_in_recharge_history);
        $manage = $this->manageSarathiAndDriverBalence($user_id_of_sarathi, $user_id_of_driver, $km);
        if($recharge && $manage){
            return true;
        }
        else{
            return false;
        }
    }
    
    private function insertRechargeTable($data){
        $this->db->insert(table_recharge_history, $data);
        return($this->db->affected_rows()==1)?true:false;
    }
    
    private function manageSarathiAndDriverBalence($user_id_of_sarathi, $user_id_of_driver, $selected_package_value){
        $previous_km_of_sarathi = $this->get_already_have_km($user_id_of_sarathi, table_sarathi);
        $updated_km_of_sarathi = $previous_km_of_sarathi - $selected_package_value;
        $update_km = $this->updated_km_of($user_id_of_sarathi, $updated_km_of_sarathi, table_sarathi);
    
        if($update_km){
            $previous_km_of_driver = $this->get_already_have_km($user_id_of_driver, table_driver);
            $updated_km_of_driver = $previous_km_of_driver + $selected_package_value;
            $update_km = $this->updated_km_of($user_id_of_driver, $updated_km_of_driver, table_driver);
            return true;
        }else{
            return false;
        } 
    }
    
    private function get_already_have_km($user_id, $table_name){
        $this->db->select(field_total_km_purchased);
        $this->db->where(field_user_id, $user_id);
        $query = $this->db->get($table_name);
        $query = $query->result_array();
        if(!empty($query)){
            $query = $query[0];
            $total_km_purchased = $query[field_total_km_purchased];
            return ($total_km_purchased != null) ? $total_km_purchased : 0;
        }else{
            return 0;
        }
    }
    
    private function updated_km_of($user_id, $updated_km_of_sarathi, $table_name){
        $data = [
            field_total_km_purchased => $updated_km_of_sarathi
        ];
        $this->db->where(field_user_id, $user_id);
        $this->db->update($table_name, $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function checkUserCurrentStatus($authConst, $userType){
        // $authConst = [
        //     "mobile" => "",
        //     "email" => ""
        // ];

        // UNKNOWN
        // pending
        // ACTIVE
        // DEACTIVE

        $sql = "SELECT status FROM users WHERE ";
        if( array_key_exists("email", $authConst) ){
            $sql .= "email = '" .$authConst['email'] ."' ";
        }else if(array_key_exists("mobile", $authConst)){
            $sql .= "mobile = '" .$authConst['mobile'] ."' ";
        }     
        $sql .= "AND type_id = '{$userType}'" ;

        $query = $this->db->query($sql);
        $query = $query->result_array();

        if(empty($query)) return "UNKNOWN";

        return $query[0]['status'];       
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function get_total_revenue($franchise_id)
    {
        $total = 0;
        $query = $this->db->select('u.uid')
        ->from(table_users.' as u')
        ->join(table_subfranchise.' as sf', 'u.uid=sf.user_id')
        ->where(['u.'.field_type_id => value_user_sub_franchise, 'sf.franchise_id'=>$franchise_id])
        ->get();
        $query = $query->result_array();
        foreach($query as $i=>$val){
            $total = $total + $this->get_total_recharge_amount($val[field_uid]);
        }
        return (!empty($total))?$total:0;
    }

    public function get_total_revenue_of_subfranchise($sf_id)
    {
        $total = 0;
        $query = $this->db->select('u.uid')
        ->from(table_users.' as u')
        ->join(table_sarathi.' as s', 'u.uid=s.user_id')
        ->where(['u.'.field_type_id => value_user_sarathi, 's.sub_franchise_id'=>$sf_id])
        ->get();
        $query = $query->result_array();
        foreach($query as $i=>$val){
            $total = $total + $this->get_total_recharge_amount($val[field_uid]);
        }
        return (!empty($total))?$total:0;
    }

    private function get_total_recharge_amount($user_id){
        $query = $this->db->select('SUM(recharge_amount) as amount')
        ->where(field_user_id, $user_id)
        ->get(table_recharge_history);
        $query = $query->result_array();
        return (!empty($query))?$query[0]['amount']:0;
    }

    public function get_address_details($gid){
        $query = $this->db->select('address_line_1, city_id, district_id, state_id, pincode')
        ->where(field_group_id, $gid)
        ->get(table_user_address);
        $query = $query->result_array();
        foreach($query as $key=>$value){
            $state    = $this->get_place_name_by_id($value['state_id'], 'state');
            $district = $this->get_place_name_by_id($value['district_id'], 'district');
            $city     = $this->get_place_name_by_id($value['city_id'], 'city');
            
            $arr =[ 
                "state"    => $state,
                "district" => $district,
                "city"     => $city
            ];
            $query[$key]['address'] = $arr;
            unset($query[$key]['city_id']);
            unset($query[$key]['district_id']);
            unset($query[$key]['state_id']);
        }
        return(!empty($query))?$query[0]:[];
    }
    
    private function get_place_name_by_id($uid, $type){
        $query = $this->db->select(field_name)->where([field_uid=> $uid, 'type'=>$type])->get(table_place);
        $query = $query->result_array();
        return(!empty($query))?$query[0][field_name]:"";
    }

    public function reset_password($email, $user_type_id, $password, $table){
       $query = $this->db->select(field_uid)
       ->where([
            field_email   => $email,
            field_type_id => $user_type_id
            ])
        ->get(table_users);
       $query = $query->result_array();
       $user_id = $query[0][field_uid];

       $data=[
        field_password    => md5($password),
        field_modified_at => date(field_date)
       ];
       $this->db->where(field_user_id, $user_id)->update($table, $data);
       return ($this->db->affected_rows()==1)?true:false;
    }

    public function generateReferralCode()
	{
		return strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6));
	}

    public function show_refferal_code($subfranchise_id){
        $query = $this->db->select(field_refferal_code)->where(field_uid, $subfranchise_id)->get(table_subfranchise);
        $query = $query->result_array();
        return(!empty($query))?$query[0][field_refferal_code]:"N/A";
    }

}
