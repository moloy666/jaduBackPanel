<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotel_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		date_default_timezone_set(field_location);

    }

    public function check_user_status($hotel_id){
        $query=$this->db->select(field_status)->where(field_uid, $hotel_id)->get(table_hotel);
        $query=$query->result_array();
        return(!empty($query))?$query[0][field_status]: const_deleted;
    }

    public function check_value_exist($value, $field_name){
        $this->db->where([$field_name => $value])
        ->where_not_in(field_status, const_deleted)->get(table_hotel);
        return($this->db->affected_rows()==1)?true:false;
    }

    public function register_basic_details($uid, $name, $email, $mobile, $location, $district, $state, $pincode, $password){
        $data=[
            field_uid=> $uid,
            field_name=> $name,
            field_mobile=> $mobile,
            field_email=> $email,
            "location"=> $location,
            "district"=>$district,
            "state"=>$state,
            "pincode"=>$pincode,
            field_password=>$password,
            field_status=>const_active,
            field_created_at=>date(field_date),
            field_modified_at=>date(field_date)
        ];

        $this->db->insert(table_hotel, $data);
        return($this->db->affected_rows()==1)?true:false;
    }

    public function get_hotel_details_on_condition($email, $password){
        $query=$this->db->where([field_email=>$email, field_password=>$password])->get(table_hotel);
        $query=$query->result_array();
        return(!empty($query))?$query[0]:[];
    }

    public function get_profile_details($hotel_id){
        $query = $this->db->where(field_uid, $hotel_id)->get(table_hotel)->result_array();
        return(!empty($query))?$query[0]:[];
    }

    public function get_booking_details($hotel_id){
        $query = $this->db->where(field_customer_id, $hotel_id)->get('ride_normal');
        $query = $query->result_array();
        return (!empty($query))?$query:null;
    }

}