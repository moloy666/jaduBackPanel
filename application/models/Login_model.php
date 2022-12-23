<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
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

    public function get_user_type_id_by_user_type_name($user_type_name)
    {
        $this->db->select(field_uid);
        $this->db->where(field_name, $user_type_name);
        $query = $this->db->get(field_user_type);
        $query = $query->result();
        return $query[0];
    }

    public function get_user_details_on_condition($email, $password, $type_id, $table)
    {
   
        $this->db->select(table_users . '.' . field_uid . ',' . table_users . '.' . field_name . ',' . table_users . '.' . field_type_id . ',' . $table . '.' . field_password.','.field_profile_image.','. $table.'.'.field_uid.' as specific_id');
        $this->db->from(table_users);
        $this->db->join(table_user_type, table_users . '.' . field_type_id . '=' . table_user_type . '.' . field_uid);
        $this->db->join($table, table_users . '.' . field_uid . '=' . $table . '.' . field_user_id);

        $this->db->where(table_users . '.' . field_email, $email);
        $this->db->where($table . '.' . field_password, $password);
        $this->db->where(table_users . '.' . field_type_id, $type_id);

        $this->db->where(table_users . '.' . field_status, const_active);

        $query = $this->db->get();
        $query = $query->result();
        return (!empty($query)) ? $query[0] : null;
    }

    public function display_user_profile($user_id)
    {
        $this->db->where(field_uid, $user_id);
        $this->db->where_not_in(field_status, const_deleted);
        $query = $this->db->get(table_users);
        return $query->result();
    }

    public function update_user_profile_details($user_id, $name, $email, $mobile, $dob, $gender)
    {
        $uid_exist = $this->userid_exists($user_id, field_uid, table_users);
        if ($uid_exist) {

            $input_data = [
                field_name => $name,
                field_email => $email,
                field_mobile => $mobile,
                field_dob => $dob,
                field_gender => $gender
            ];
            $this->db->where(field_uid, $user_id);
            $this->db->update(table_users, $input_data);
            $this->db->affected_rows() == 1 ? true : false;
        } else
            return false;
    }

    public function get_user_list(){

        $user_count=[];
        
        $this->db->where(field_type_id, value_user_admin);
        $query = $this->db->get(table_users);
        $user_count['admin']= $query->num_rows();

        $this->db->where(field_type_id, value_user_franchise);
        $query = $this->db->get(table_users);
        $user_count['franchise']= $query->num_rows();

        $this->db->where(field_type_id, value_user_sub_franchise);
        $query = $this->db->get(table_users);
        $user_count['sub_franchise']= $query->num_rows();

        return $user_count;

    }
    
    //////////////////////// Sarathi Panel Login /////////////////////////////

    public function get_sarathi_details_on_condition($email, $mobile){

        $this->db->where(['email'=> $email, 'mobile'=> $mobile, 'status'=> const_active]);
        $query = $this->db->get('users');
        $query = $query->result();
        return (!empty($query)) ? $query[0] : null;
    }

    public function get_sarathi_status_by_user_id($user_id){
        $this->db->select(field_status);
        $this->db->where(field_uid, $user_id);
        $query=$this->db->get(table_users);
        $query=$query->result_array();
        return(!empty($query))?$query[0][field_status]:false;
    }

    public function get_user_id_by_sarathi_id($sarathi_id){
        $this->db->select(field_user_id);
        $this->db->where(field_uid, $sarathi_id);
        $query = $this->db->get(table_sarathi);
        $query = $query->result_array();
        return(!empty($query))?$query[0][field_user_id]:false;
    }

    //////////////////////////// FRANCHISE || SUBFRANCHISE ////////////////////////////////////////////
    
    public function get_user_status_by_user_id($user_id){
        $this->db->select(field_status);
        $this->db->where(field_uid, $user_id);
        $query=$this->db->get(table_users);
        $query=$query->result_array();
        return(!empty($query))?$query[0][field_status]:null;
    }

    public function get_user_status_by_specific_id($specific_id, $table){  // franchise || subfranchise_id
        $this->db->select('u.status');
        $this->db->from('users as u');
        $this->db->join($table.' as t', 't.user_id = u.uid');
        $this->db->where(['t.uid'=>$specific_id]);
        $query=$this->db->get();
        $query=$query->result_array();
        return(!empty($query))?$query[0][field_status]: const_deactive;
    }

}
