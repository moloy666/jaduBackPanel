<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sarathi_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);
    }

    public function get_driver_of_paticular_sarathi($sarathi_id){
        $this->db->select('users.name, users.email, users.mobile , users.status');
        $this->db->from('users');
        $this->db->join('driver', 'users.uid = driver.user_id');
        $this->db->where('driver.sarathi_id', $sarathi_id);
        // $this->db->where_not_in('users.status','deleted');
        // $this->db->where_not_in('users.status','pending');
        $query = $this->db->get();
        $query=$query->result_array();
        // echo $this->db->last_query();
        return $query;
    }

    public function get_sarathi_id_by_user_id($user_id){
        $this->db->select('uid');
        $this->db->where('user_id', $user_id);
        $query=$this->db->get('sarathi');
        $query=$query->result_array();

        return (!empty($query))? $query[0]['uid']: null;
    }

}