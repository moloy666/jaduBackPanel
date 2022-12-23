<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Service_model extends CI_Model {
	public function __construct(){
		parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
	}

    public function add_ride_type($ride_id, $service_id, $ride_name, $image_icon, $specific_id){
        $this->db->where(field_name, $ride_name);
        $this->db->get('ride_service_type');
        $exist=$this->db->affected_rows();
        if($exist == 0){
            $data = [
                'uid' => $ride_id,
                'service_id' => $service_id,
                'name' => $ride_name,
                'image' => $image_icon,
                'created_at' => date(field_date),
                'modified_at' => date(field_date),
                'created_by' => $specific_id,
                'modified_by' =>$specific_id,
                
            ];
            $this->db->insert('ride_service_type', $data);
            return ($this->db->affected_rows() == 1) ? true : false;
        }
        else{
            return false;
        }

    }

    public function add_splashdata($uid, $heading, $body, $for, $specific_for, $image){
        $data=[
            "uid"=>$uid,
            "heading"=>$heading,
            "body"=>$body,
            "cover_image_path"=>$image,
            "for"=>$for,
            "specific_for_app"=>$specific_for,
            "created_at"=>date(field_date)
        ];
        $this->db->insert('app_splash_data', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function edit_splashdata($uid, $heading, $body, $for, $image){
        $data=[
            "heading"=>$heading,
            "body"=>$body,
            "cover_image_path"=>$image,
            "for"=>$for,
            "created_at"=>date(field_date)
        ];
        $this->db->where(field_id, $uid);
        $this->db->update('app_splash_data', $data);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function get_image_path_by_uid($uid){
        $this->db->select('cover_image_path');
        $this->db->where(field_id, $uid);
        $query=$this->db->get('app_splash_data');
        $query=$query->result_array();
        return (!empty($query))?$query[0]['cover_image_path']:null;
    }

    public function update_profile_image($user_id, $image){
        $this->db->set('profile_image', $image);
        $this->db->where(field_id, $user_id);
        return ($this->db->affected_rows() == 1) ? true : false;

    }

}