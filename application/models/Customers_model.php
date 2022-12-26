<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customers_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);
    }

    // public function get_total_customers(){
    //     $this->db->get(table_customer);
    //     return $this->db->affected_rows();
    // }



    public function get_total_customers($specific_id)
    {
        if (!empty($specific_id)) {
            $total_customer = $this->get_customer_of_sarathi($specific_id);
            return ($total_customer > 0) ? $total_customer : 0;
        } else {
            $this->db->select('c.uid as customer_id');
            $this->db->from('customer_new as c');
            $this->db->join('users as u', 'u.uid = c.user_id');
            $this->db->where('u.status', const_active);
            $this->db->get();
            return $this->db->affected_rows();
        }
    }

    private function get_customer_of_sarathi($specific_id)
    {
        $customer = 0;
        $this->db->select(field_uid);
        $this->db->where(field_sarathi_id, $specific_id);
        $query = $this->db->get(table_driver);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $driver_id = $val[field_uid];
            $customer = $customer + $this->get_total_customer_of_driver($driver_id);
        }
        return $customer;
    }

    private function get_total_customer_of_driver($driver_id)
    {
        $this->db->distinct(field_customer_id)->select(field_customer_id);
        $this->db->where(field_driver_id, $driver_id)->get(table_history_ride_transactions);
        return $this->db->affected_rows();
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

    public function get_customers_details()
    {
        $this->db->select(table_users . '.' . field_uid . ',' . table_users . '.' . field_name . ',' . table_users . '.' . field_email . ',' . table_users . '.' . field_mobile . ',' . table_users . '.' . field_status);
        $this->db->from(table_users);
        $this->db->join(table_customer, table_users . '.' . field_uid . '=' . table_customer . '.' . field_user_id);
        $this->db->where_not_in(table_users . '.' . field_status, const_deleted);
        $this->db->where(table_users . '.' . field_type_id, value_user_customer);

        $query = $this->db->get();

        return $query->result();
    }

    // check uid from customer table

    public function delete_customers_details($uid)
    {
        $uid_exist = $this->userid_exists($uid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_deleted, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $uid);
            $this->db->update(table_users);
            $this->db->affected_rows() == 1 ? true : false;
        } else
            return false;
    }

    public function active_customers_status($uid)
    {
        $uid_exist = $this->userid_exists($uid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_active, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $uid);
            $this->db->update(table_users);
            $this->db->affected_rows() == 1 ? true : false;
        } else
            return false;
    }

    public function deactive_customers_status($uid)
    {
        $uid_exist = $this->userid_exists($uid, field_uid, table_users);
        if ($uid_exist) {
            $this->db->set([field_status => const_deactive, field_modified_at => date(field_date)]);
            $this->db->where(field_uid, $uid);
            $this->db->update(table_users);
            $this->db->affected_rows() == 1 ? true : false;
        } else
            return false;
    }

    public function update_customers_details($uid, $name, $email, $mobile)
    {
        $uid_exist = $this->userid_exists($uid, field_uid, table_users);
        if ($uid_exist) {
            $data = [
                field_name => $name,
                field_email => $email,
                field_mobile => $mobile,
                field_modified_at => date(field_date)
            ];
            $this->db->where(field_uid, $uid);
            $this->db->update(table_users, $data);
            $this->db->affected_rows() == 1 ? true : false;
        } else
            return false;
    }

    public function add_customers_details($user_id, $customer_id, $name, $email, $mobile, $user_type_id)
    {
        $uid_exist = $this->userid_exists($user_id, field_uid, table_users);
        if (!$uid_exist) {
            $data = [
                field_uid => $user_id,
                field_name => $name,
                field_email => $email,
                field_mobile => $mobile,
                field_type_id => $user_type_id
            ];

            $this->db->insert(table_users, $data);

            if ($this->db->affected_rows() > 0) {
                $customer_data = [
                    field_uid => $customer_id,
                    field_user_id => $user_id,
                ];

                $this->db->insert(table_customer, $customer_data);
                return ($this->db->affected_rows() == 1 ? true : false);
            } else
                return false;
        } else
            return "user already exist";
    }


    public function get_customer_by_booking_id($booking_id)
    {
        $this->db->select('u.uid as customer_id, u.name, u.email, u.mobile, u.profile_image, c.uid as customer_id, c.current_lat as lat, c.current_lng as lng');
        $this->db->from('users as u');
        $this->db->join('customer_new as c', 'c.user_id = u.uid');
        $this->db->where('c.unique_id_for_booking_call', $booking_id);
        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function get_ride_type()
    {
        $this->db->select('uid, name');
        $query = $this->db->get('ride_type');
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function get_customers_of_sarathi($sarathi_id)
    {
        $data = [];
        $query = $this->db->select(field_uid)->where(field_sarathi_id, $sarathi_id)->get(table_driver);
        $query = $query->result_array();
        foreach ($query as $i => $val) {
            $driver_id = $val[field_uid];
            $data[$i] = $this->get_customer_data_of_driver($driver_id);
        }
        return (!empty($data)) ? $data : null;
    }

    private function get_customer_data_of_driver($driver_id)
    {
        $query = $this->db->distinct(field_customer_id)->select(field_customer_id)
            ->where(field_driver_id, $driver_id)->get(table_history_ride_transactions);
        $query = $query->result_array();
        return (!empty($query)) ? $query : [];
    }

    //    public function get_driver_id_sarathi_id($sarathi_id){
    //      $query=$this->db->select(field_uid)->where(field_sarathi_id, $sarathi_id)->get(table_driver);
    //      $query=$query->result_array();
    //      foreach($query as $i=>$val){
    //         $driver_id=$val[field_uid];
    //         $query[$i]['customer']=$this->get_customer_id_by_driver_id($driver_id);

    //         unset($query[$i][field_uid]);
    //      }

    //     $myfield_arr = array_column($query, 'customer');
    //     return $myfield_arr;
    //     // return $query;

    //    }

    //    private function get_customer_id_by_driver_id($driver_id){
    //     $this->db->distinct('customer_id');

    //     $query=$this->db->select('customer_id')->where('driver_id', $driver_id)->get(table_history_ride_transactions);


    //     // $query=$this->db->select('u.uid as user_id, u.name, u.email, u.mobile, u.status')
    //     //          ->from('users as u')
    //     //          ->join('driver as d', 'd.user_id = u.uid')
    //     //          ->join('history_ride_transactions as hrt', 'd.uid = hrt.driver_id', 'left')
    //     //          ->where('hrt.driver_id', $driver_id)
    //     //          ->get();

    //     $query=$query->result_array();
    //     return $query;

    //    }

    public function get_driver_id_sarathi_id($sarathi_id)
    {
        $query = $this->db->select(field_uid)->where(field_sarathi_id, $sarathi_id)->get(table_driver);
        $query = $query->result_array();
        return (!empty($query))?$query:null;
    }

    public function get_customer_id_by_driver_id($driver_id)
    {
        $query = $this->db->distinct(field_customer_id)->select(field_customer_id)->where(field_driver_id, $driver_id)->get(table_history_ride_transactions);
        $query = $query->result_array();
        return (!empty($query))?$query:null;

    }

    public function get_customer_details($customer_id){
        $query=$this->db->select('u.name, u.email, u.mobile, u.uid as user_id, u.status')
        ->from('users as u')->join(table_customer.' as c', 'u.uid = c.user_id')
        ->where('c.uid', $customer_id)->get();
        $query=$query->result_array();
        return (!empty($query))?$query:[];
    }

    
}
