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
        $query = $this->db->where([field_customer_id =>$hotel_id, field_ride_status=>const_completed])->get('ride_normal');
        $query = $query->result_array();
        foreach($query as $i=>$val){
            $query[$i]['locationText']=json_decode($val['locationText']);
            $query[$i]['extra_data']=json_decode($val['extra_data']);
            $query[$i]['driver']=$this->get_driver_data_by_id($val['driver_id']);
        }
        return (!empty($query))?$query:null;
    }

    public function get_driver_data_by_id($driver_id){
        $query = $this->db->select('u.name, u.mobile, u.dob, u.gender')->from(table_users.' as u')->join(table_driver.' as d', 'u.uid=d.user_id')
        ->where('d.uid', $driver_id)->get();
        $query = $query->result_array();
        return (!empty($query))?$query:null;
    }

    public function display_invoice($ride_id){
        $query = $this->db->select('service_id, fareServiceTypeId, locationText, extra_data, paymentMethod, currency, driver_id, customer_id as hotel_id')
        ->where(field_uid, $ride_id)->get(table_ride_normal);
        $query = $query->result_array();
        foreach($query as $i=>$val){
            $query[$i]['service']=$this->get_service_ride_by_id($val['fareServiceTypeId']);
            $query[$i]['driver']=$this->get_driver_name_by_id($val['driver_id']);
            $query[$i]['extra_data']=json_decode($val['extra_data']);
            $query[$i]['locationText']=json_decode($val['locationText']);
            
        }
        return(!empty($query))?$query[0]:[];
    }

    private function get_service_ride_by_id($service_id){
        $query = $this->db->select(field_name)->where(field_uid, $service_id)->get(table_ride_service_type);
        $query = $query->result_array();
        return (!empty($query))?$query[0][field_name]:null;
    }

    private function get_driver_name_by_id($driver_id){
        $query = $this->db->select('u.name')->from(table_users.' as u')->join(table_driver.' as d', 'u.uid=d.user_id')
        ->where('d.uid', $driver_id)->get();
        $query = $query->result_array();
        return(!empty($query))?$query[0][field_name]:null;

    }

    public function get_hotel_name_by_id($hotel_id){
        $query = $this->db->select(field_name)->where(field_uid, $hotel_id)->get(table_hotel);
        $query = $query->result_array();
        return (!empty($query))?$query[0][field_name]:null;
    } 

}