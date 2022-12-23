<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Franchise_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);
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

    // public function get_total_franchise()
    // {
    //     $this->db->get('franchise');
    //     return $this->db->affected_rows();
    // }

    public function get_total_franchise()
    {
        $this->db->select('f.uid as franchise_id');
        $this->db->from('franchise as f');
        $this->db->join('users as u', 'u.uid = f.user_id');
        $this->db->where('u.status', const_active);
        $this->db->get();
        return $this->db->affected_rows();
    }

    public function get_franchise_details()
    {

        $this->db->select(table_users . '.' . field_uid . ',' . table_users . '.' . field_name . ',' . table_users . '.' . field_email . ',' . table_users . '.' . field_mobile . ',' . table_users . '.' . field_status);
        $this->db->from(table_users);
        $this->db->join(table_franchise, table_users . '.' . field_uid . '=' . table_franchise . '.' . field_user_id);
        $this->db->where_not_in(table_users . '.' . field_status, const_deleted);
        $this->db->where(table_users . '.' . field_type_id, value_user_franchise);
        $query = $this->db->get();
        $query = $query->result_array();
        // return $query->result();
        return (!empty($query)) ? $query : [];
    }

    public function delete_franchise_details($uid)
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

    public function deactive_franchise_status($uid)
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

    public function active_franchise_status($uid)
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

    public function update_franchise_details($user_id, $array, $access, $panel)
    {
        $this->db->where(field_uid, $user_id);
        $update = $this->db->update(table_users, $array);
        if($update){
            $deleted=$this->db->where(field_user_id, $user_id)->delete(table_permission);
            if($deleted){
                $permission=$this->db->insert_batch(table_permission, $access);
                if($permission){
                    $this->db->where(field_user_id, $user_id)->update(table_panel_access_permissions, $panel);
                    return ($this->db->affected_rows() ==1) ? true : false;
                }
            }
        }
    }

    public function add_franchise_details($user_id, $gid, $name, $email, $mobile, $user_type_id, $password, $franchise_id, $access, $panel)
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

        $franchise_data = [
            field_uid => $franchise_id,
            field_user_id => $user_id,
            field_password => $password,
            field_created_at => date(field_date),
            field_modified_at => date(field_date)
        ];

        $insert = $this->db->insert(table_users, $data);
        if ($insert) {
            $franchise = $this->db->insert(table_franchise, $franchise_data);
            if ($franchise) {
                $permission=$this->db->insert_batch(table_permission, $access);
                if($permission){
                    $permission=$this->db->insert(table_panel_access_permissions, $panel);
                }
                return ($this->db->affected_rows() ==1) ? true : false;
            }
        }
    }

    ///////////////////// franchise details /////////////////////

    public function franchise_details($user_id)
    {

        $this->db->select('users.uid, users.name, franchise.uid as franchise_id');
        $this->db->from('users');
        $this->db->join('franchise', 'users.uid = franchise.user_id');
        $this->db->where('franchise.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_franchise_id_by_user_id($user_id)
    {
        $this->db->select('uid');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('franchise');
        $query = $query->result_array();
        return (!empty($query)) ? $query[0]['uid'] : null;
    }

    public function get_all_subfranchise_of_franchise($franchise_id)
    {

        $this->db->select('users.uid, users.name, users.email, users.mobile, users.status');
        $this->db->from('users');
        $this->db->join('subfranchise', 'users.uid = subfranchise.user_id');
        $this->db->where('subfranchise.franchise_id', $franchise_id);
        $this->db->where_not_in('users.status', 'deleted');
        $this->db->where_not_in('users.status', 'pending');
        $query = $this->db->get();
        return $query->result_array();
    }

    ///////////////////////// FRANCHISE PANEL ////////////////////////////////////////////////

    public function get_franchise_id_by_franchise_user_id($franchise_user_id)
    {
        $query = $this->db->select(field_uid)->where(field_user_id, $franchise_user_id)->get(table_franchise);
        $query = $query->result_array();
        return (!empty($query)) ? $query[0][field_uid] : null;
    }

    public function get_subfranchise_details($user_id)
    {
        $this->db->select(table_users . '.' . field_uid . ',' . table_users . '.' . field_name . ',' . table_subfranchise . '.' . field_uid . ' as ' . field_subfranchise_id);
        $this->db->from(table_users);
        $this->db->join(table_subfranchise, table_users . '.' . field_uid . '=' . table_subfranchise . '.' . field_user_id);
        $this->db->where(table_users . '.' . field_uid, $user_id);

        $query = $this->db->get();
        $query = $query->result_array();
        return (!empty($query)) ? $query[0] : [];
        return $query;
    }

    public function get_subfranchise_ids($franchise_id)
    {
        $query = $this->db->select(field_uid)->where(field_franchise_id, $franchise_id)->get(table_subfranchise);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }
    public function get_sarathi_ids($subfranchise_id)
    {
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();
        return (!empty($query)) ? $query : null;
    }

    public function get_access_permission($user_id, $permission_id)
    {
        $this->db->select('status');
        $this->db->where(['user_id' => $user_id, 'permission_id' => $permission_id, 'status' => const_active]);
        $query = $this->db->get('permission');
        $query = $query->result_array();
        return (!empty($query)) ? const_active : const_deactive;
    }

    public function get_franchise_profile($user_id){
        $this->db->where(field_uid, $user_id);
        $query=$this->db->get(table_users);
        $query=$query->result_array();
        return (!empty($query))? $query:null;
    }

    public function update_user_profile_details($user_id, $name, $dob, $gender) {

        $input_data = [
            field_name => $name,
            // field_email => $email,
            // field_mobile => $mobile,
            field_dob => $dob,
            field_gender => $gender
        ];
        $this->db->where(field_uid, $user_id);
        $this->db->update(table_users, $input_data);
        return ($this->db->affected_rows() == 1 ? true : false);
    }

    public function get_specific_id_by_user_id($user_id, $table){
        $query=$this->db->select($table.'.'.field_uid)
                ->from($table)
                ->join(table_users, $table.'.'.field_user_id.'='.table_users.'.'.field_uid)
                ->where(table_users.'.'.field_uid, $user_id)
                ->get();
        $query=$query->result_array();
        return(!empty($query))?$query[0][field_uid]:null;    

    }
}
