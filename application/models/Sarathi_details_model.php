<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sarathi_details_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);
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

    public function get_all_sarathi_details($user_id){

        // $this->db->select('users.uid, users.name, sarathi.uid as sarathi_id');
        // $this->db->from('users');
        // $this->db->join('sarathi', 'users.uid = sarathi.user_id');
        // $this->db->where('sarathi.user_id', $user_id);

        $this->db->select(table_users.'.'.field_uid.','. table_users.'.'.field_name.','. table_sarathi.'.'.field_uid.' as sarathi_id, users.email, users.mobile');
        $this->db->from(table_users);
        $this->db->join(table_sarathi, table_users.'.'.field_uid.'='. table_sarathi.'.'.field_user_id);
        $this->db->where(table_sarathi.'.'.field_user_id, $user_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_driver_details($sarathi_id){
        
        $this->db->select(table_users.'.'.field_uid.','. table_users.'.'. field_name.','. table_users.'.'.field_email.','. table_users.'.'.field_mobile.','. table_users.'.'.field_status);
        $this->db->from(table_users);
        $this->db->join(table_driver, table_users.'.'.field_uid.'='. table_driver.'.'.field_user_id);
        $this->db->where(table_driver.'.'.field_sarathi_id, $sarathi_id);
        $this->db->where_not_in(table_users.'.'.field_status, const_deleted);
        $this->db->where_not_in(table_users.'.'.field_status, const_pending);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_pending_driver_number($sarathi_id){
        $this->db->from(table_users);
        $this->db->join(table_driver, table_driver.'.'.field_user_id .'='. table_users.'.'.field_uid);
        $this->db->where([
            table_users.'.'.field_status => const_pending, 
            table_users.'.'.field_type_id => value_user_driver,
            table_driver.'.'.field_sarathi_id => $sarathi_id
        ]);
        $query=$this->db->get();
        return $query->num_rows();
    }

    public function get_sarathi_id_by_user_id($user_id){
        $this->db->select(field_uid);
        $this->db->where(field_user_id,$user_id);
        $query=$this->db->get(table_sarathi);
        $query=$query->result_array();
        return (!empty($query))? $query[0][field_uid]:null;
    }
    
    public function get_pending_drivers($sarathi_id){
        $this->db->select(table_users.'.'.field_name.','. table_users.'.'.field_profile_image.','. table_users.'.'.field_uid.','. table_users.'.'.field_email.','. table_users.'.'.field_mobile);
        $this->db->from(table_users);
        $this->db->join(table_driver, table_driver.'.'.field_user_id .'='. table_users.'.'.field_uid);
        $this->db->where([
            table_users.'.'.field_status => const_pending, 
            table_users.'.'.field_type_id => value_user_driver,
            table_driver.'.'.field_sarathi_id => $sarathi_id
        ]);
        $query=$this->db->get();
        $query=$query->result();
        return(!empty($query))?$query:[];
        
    }

    public function get_pending_document_name($gid){
        $this->db->distinct(field_name);
        $this->db->select(field_name);
        $this->db->where(field_group_id, $gid);
        $query=$this->db->get(table_documents);
        $query=$query->result();
        return (!empty($query))?$query:[];
    }

    public function get_pending_driver_details($gid){
        $document = $this->get_pending_document_name($gid);
        foreach($document as $i=>$d){
            $name = $d->name;
            $result[$i]=$this->get_pending_document_image($name, $gid);
        }
        return(!empty($result))?$result:[];
        
    }

    public function get_pending_document_image($name, $gid){
        $this->db->select(field_uid.','. field_name.','. field_verified.','. field_assets);
        $this->db->where(field_name, $name);
        $this->db->where(field_group_id, $gid);
        $this->db->order_by(field_created_at, 'desc');
        $query=$this->db->get(table_documents);
        $query=$query->result();
        return (!empty($query))?$query[0]:[];
    }

    public function activate_pending_driver($user_id){
        $this->db->set(field_status, const_active);
        $this->db->where(field_uid, $user_id);
        return $this->db->update(table_users);

        // if($update){
        //     $this->db->set('working_status', const_active);
        //     $this->db->where(field_user_id, $user_id);
        //     $this->db->update(table_driver);
        //     return ($this->db->affected_rows()==1)? true:false;

        // }
    }

    public function get_gid_by_user_id($user_id){
        $this->db->select(field_group_id);
        $this->db->where(field_uid,$user_id);
        $query=$this->db->get(table_users);
        $query=$query->result_array();
        return (!empty($query))?$query[0][field_group_id]:null;
        
    }

    public function get_name_by_user_id($user_id){
        $this->db->select(field_name.','.field_email.','.field_mobile);
        $this->db->where(field_uid, $user_id);
        $query=$this->db->get(table_users);
        $query=$query->result();
        return (!empty($query))?$query:null;
    }

    public function approved_driver_documents($gid, $document_id){

        $this->db->set([field_verified => const_submit, field_status => const_active]);
        $this->db->where([field_group_id=>$gid, field_uid=>$document_id]);
        $this->db->update(table_documents);
        return ($this->db->affected_rows()==1)? true:false;
    }

    public function deny_driver_documents($gid, $document_id){

        $this->db->set([field_verified=> const_rejected, field_status=>const_deactive]);
        $this->db->where([field_group_id=>$gid, field_uid=>$document_id]);
        $this->db->update(table_documents);
        return ($this->db->affected_rows()==1)? true:false;
    }


    public function total_km_purchase($sarathi_id){
        $this->db->select(field_total_km_purchased);
        $this->db->where(field_uid, $sarathi_id );
        $query= $this->db->get(table_sarathi);
        $query=$query->result_array();

        return (!empty($query))? $query[0][field_total_km_purchased]:null;
    }

    // sarathi profile manage

    public function get_sarathi_profile($user_id){
        $this->db->where(field_uid, $user_id);
        $query=$this->db->get(table_users);
        $query=$query->result_array();
        return (!empty($query))? $query:null;
    }

    // display sarathi documents

    public function display_sarathi_documents($gid){
        $this->db->distinct('name');
        $this->db->where(field_group_id, $gid);
        $this->db->order_by(field_created_at,'desc');
        $query=$this->db->get(table_documents);
        $query=$query->result_array();

        return (!empty($query))? $query:null;
    }

    public function display_driver_location($sarathi_id){
        $this->db->select('d.uid as driver_id, d.current_lat as lat, d.current_lng as lng, u.name as driver_name, d.working_status_current_value as driver_status');
        $this->db->from('driver as d');
        $this->db->join('users as u', 'u.uid = d.user_id');
        $this->db->where('d.sarathi_id', $sarathi_id);
        $this->db->where('u.status', const_active);
        $this->db->where_not_in('d.current_lat','NULL');
        $this->db->where_not_in('d.current_lng','NULL');
        $this->db->where_not_in('d.working_status_current_value','NULL');
        $query=$this->db->get();
        $query=$query->result_array();

        foreach($query as $i=>$val){
            $query[$i]['driver_name']=ucwords($val['driver_name']);
        }
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

    public function get_specific_id($user_id){  // driver user_id

        $this->db->select('d.uid as driver_id, d.sarathi_id, u.name as driver_name');
        $this->db->from('driver as d');
        $this->db->join('users as u', 'u.uid = d.user_id');
        $this->db->where('d.user_id', $user_id);
        $query=$this->db->get();
        $query=$query->result_array();
        return (!empty($query))?$query[0]:null;
    }

    public function get_total_km_purchased($sarathi_id){
        $this->db->select(field_total_km_purchased);
        $this->db->where(field_uid, $sarathi_id);
        $query=$this->db->get(table_sarathi);
        $query=$query->result_array();
        return (!empty($query))?$query[0][field_total_km_purchased]:null;
    }


   
}
