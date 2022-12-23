<?php
class Common_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

    private function get_user_type_id($user_type){
        $this->db->select(field_id);
        $this->db->where(field_name, $user_type);
        $query = $this->db->get(table_user_type);
        $query = $query->result_array();
        return $query[0][field_id];
    }

	// public function get_country_code(){
	// 	$query = $this->db->get(table_country);
	// 	return $query->result_array();
	// }

    // public function get_country_list(){
    //     $this->db->select(field_id .",". field_name);
    //     $this->db->where(field_type, STATIC_PLACE_COUNTRY);
    //     $this->db->where(field_status, STATIC_STATUS_ACTIVE);
    //     $query = $this->db->get(table_place);
        
    //     return $query->result_array();
    // }

    // public function get_state_list($country_id){
    //     $this->db->select(field_id .",". field_name);
    //     $this->db->where(field_type, STATIC_PLACE_STATE);
    //     $this->db->where(field_status, STATIC_STATUS_ACTIVE);
    //     $this->db->where(field_parent, $country_id);
    //     $query = $this->db->get(table_place);
        
    //     return $query->result_array();
    // }

    // public function get_district_list($state_id){
    //     $this->db->select(field_id .",". field_name);
    //     $this->db->where(field_type, STATIC_PLACE_DISTRICT);
    //     $this->db->where(field_status, STATIC_STATUS_ACTIVE);
    //     $this->db->where(field_parent, $state_id);
    //     $query = $this->db->get(table_place);

    //     return $query->result_array();
    // }

    // public function get_city_list($district_id){
    //     $this->db->select(field_id .",". field_name);
    //     $this->db->where(field_type, STATIC_PLACE_CITY);
    //     $this->db->where(field_status, STATIC_STATUS_ACTIVE);
    //     $this->db->where(field_parent, $district_id);
    //     $query = $this->db->get(table_place);
        
    //     return $query->result_array();
    // }

	// public function do_upload($path, $send_img){
    //     $resp = function ($data) {
    //         $data_final = [
    //             key_status => $data[0],
    //             key_message => $data[1],
    //             key_isadd => $data[2],
    //         ];
    //         return $data_final;
    //     };
    //     $config[key_upload_path]   = './' . $path;
    //     $config[key_allowed_types] = type_allowed;
    //     // $config[key_encrypt_name] = TRUE;

    //     $this->load->library(library_upload, $config);
    //     $this->upload->initialize($config);

    //     return (!$this->upload->do_upload($send_img)) ? false : true;
    // }

    // public function get_all_packages($user_type){
    //     $user_type_id = $this->get_user_type_id($user_type);
    //     $this->db->select(field_id .",". field_name);
    //     $this->db->where(field_user_type_id, $user_type_id);
    //     $this->db->where(field_status, STATIC_STATUS_ACTIVE);
    //     $query = $this->db->get(table_packages);
    //     return $query->result_array();
    // }



    public function is_this_value_exist($field_value, $field_name, $table){		

		// $this->db->select('user_type.name');
        // $this->db->from($table);
		// $this->db->join('user_type', $table.'.type_id = user_type.uid');
        // $this->db->where('users.'.$field_name, $field_value);

		$this->db->select(table_user_type.'.'.field_name);
        $this->db->from($table);
		$this->db->join(table_user_type, $table.'.'.field_type_id.' = '.table_user_type.'.'.field_uid);
        $this->db->where(table_users.'.'.$field_name, $field_value);
        $query = $this->db->get();
		$query=$query->result();

		return (!empty($query))? $query[0]: [];
	}

    
	public function get_user_type_id_by_user_type_name($user_type_name){
		$this->db->select(field_uid);
		$this->db->where(field_name,$user_type_name);
		$query=$this->db->get(table_user_type);
		$query=$query->result_array();
		return (!empty($query))? $query[0][field_uid]: null;
		
	}

    public function is_value_exist($mobile, $user_id, $field_name){
        $this->db->where(field_uid, $user_id);
        $this->db->where($field_name, $mobile);
        $this->db->get(table_users);
        return($this->db->affected_rows() >= 1)? true : false;
    }

    public function get_user_details_by_user_id($user_id){
        $this->db->where('uid', $user_id);
        $query=$this->db->get('users');
        $query=$query->result();
        return(!empty($query))?$query[0]:null;
    }

    public function get_specific_id_by_user_id($user_id, $table){

        $query = $this->db->select('t.uid')->from($table.' as t')->join(table_users.' as u', 'u.uid = t.user_id')->where('t.user_id', $user_id)->get();
        $query = $query->result_array();
        return(!empty($query))? $query[0][field_uid]:null;
    }


    ////////////////////////////////////// FRANCHISE DASHBOARD ///////////////////////////////////////////////////////////

    public function get_total_sub_franchise($specific_id){
        $this->db->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        return $this->db->affected_rows();
    }

    public function get_total_sarathi($specific_id){    // get sarathi of each subfranchise
        $sarathi = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach($query as $key => $val){
            $subfranchise_id = $val[field_uid];
            $sarathi = $sarathi + $this->get_sarathi_of_subfranchise($subfranchise_id);
        }       
        return $sarathi; 
    }

    public function get_sarathi_of_subfranchise($subfranchise_id){
        $this->db->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        return $this->db->affected_rows();
    }

    // =========================================== //

    public function get_total_drivers($specific_id){
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach($query as $key => $val){
            $subfranchise_id = $val[field_uid];
            $driver = $driver + $this->get_sarathi_id_by_subfranchise_id($subfranchise_id);
        }       
        return $driver;
    }

    public function get_sarathi_id_by_subfranchise_id($subfranchise_id){
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach($query as $key=> $val){
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_driver_of_sarathi($sarathi_id);
        }
        return $driver;
    }

    public function get_driver_of_sarathi($sarathi_id){

        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
                ->where('d.'.field_sarathi_id, $sarathi_id)
                ->where_not_in('u.status', const_pending)
                ->where_not_in('u.status', const_deleted)->get();

        return $this->db->affected_rows();
    }

    // ==================================== //

    public function get_total_customers($franchise_id){
        
        $query=$this->db->select(field_uid)->where(field_franchise_id, $franchise_id)->get(table_subfranchise);
        $query=$query->result_array();
        foreach($query as $i=>$val){
            $sf_id=$val[field_uid];
            $data=$this->get_sarathi_of_sub_franchise($sf_id);
        }
        return $data;
    }

    private function get_sarathi_of_sub_franchise($subfranchise_id){
        $query=$this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query=$query->result_array();
        foreach($query as $i=>$val){
            $sarathi_id=$val[field_uid];
            $data=$this->get_total_driver_of_sarathi($sarathi_id);
        }
        return $data;
    }

    function get_total_driver_of_sarathi($sarathi_id){
        $data=0;
        $query=$this->db->select(field_uid)->where(field_sarathi_id, $sarathi_id)->get(table_driver);
        $query=$query->result_array();
        foreach($query as $i=>$val){
            $driver_id=$val[field_uid];
            $data = $data + $this->get_total_customer_of_driver($driver_id);
        }
        return $data;
    }

    private function get_total_customer_of_driver($driver_id){
        $this->db->distinct(field_customer_id)->select(field_customer_id)->where(field_driver_id, $driver_id);
        return $this->db->affected_rows();
    }


    // ====================================================

    public function get_total_active_drivers($specific_id){
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach($query as $key => $val){
            $subfranchise_id = $val[field_uid];
            $driver = $driver + $this->get_sarathi_id_by_subfranchise_id_for_driver($subfranchise_id);
        }       
        return $driver;
    }

    public function get_sarathi_id_by_subfranchise_id_for_driver($subfranchise_id){
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach($query as $key=> $val){
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_active_driver_of_sarathi($sarathi_id);
        }
        return $driver;
    }

    public function get_active_driver_of_sarathi($sarathi_id){
        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
        ->where('d.'.field_sarathi_id, $sarathi_id)
        ->where('d.working_status', const_active)
        ->where_not_in('u.status', const_pending)
        ->where_not_in('u.status', const_deleted)->get();
        return $this->db->affected_rows();
    }

    // =========================================================================

    public function get_total_inactive_drivers($specific_id){
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_franchise_id, $specific_id)->get(table_subfranchise);
        $query = $query->result_array();
        foreach($query as $key => $val){
            $subfranchise_id = $val[field_uid];
            $driver = $driver + $this->get_sarathi_id_by_subfranchise_id_for_inactive_driver($subfranchise_id);
        }       
        return $driver;
    }

    public function get_sarathi_id_by_subfranchise_id_for_inactive_driver($subfranchise_id){
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach($query as $key=> $val){
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_inactive_driver_of_sarathi($sarathi_id);
        }
        return $driver;
    }

    public function get_inactive_driver_of_sarathi($sarathi_id){
        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
        ->where('d.'.field_sarathi_id, $sarathi_id)
        ->where('d.working_status', const_deactive)
        ->where_not_in('u.status', const_pending)
        ->where_not_in('u.status', const_deleted)->get();
        return $this->db->affected_rows();
    }


    /////////////////////////////// Sub franchise dashboard ///////////////////////////////

    public function get_total_sarathi_of_sub_franchise($subfranchise_id){
        $this->db->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        return $this->db->affected_rows();
    }

    public function get_total_driver_of_sub_franchise($subfranchise_id){
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach($query as $key=> $val){
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_driver_of_sf($sarathi_id);
        }
        return $driver;
    }

    public function get_driver_of_sf($sarathi_id){
        $this->db->select('u.uid')->from('users as u')->join('driver as d', 'u.uid = d.user_id')
        ->where('d.'.field_sarathi_id, $sarathi_id)
        ->where_not_in('u.status', const_pending)
        ->where_not_in('u.status', const_deleted)->get();
        return $this->db->affected_rows();
    }

    public function get_total_active_driver_of_sub_franchise($subfranchise_id){
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach($query as $key=> $val){
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_active_driver_of_sarathi($sarathi_id);
        }
        return $driver;
    }

    
    public function get_total_inactive_driver_of_sub_franchise($subfranchise_id){
        $driver = 0;
        $query = $this->db->select(field_uid)->where(field_subfranchise_id, $subfranchise_id)->get(table_sarathi);
        $query = $query->result_array();

        foreach($query as $key=> $val){
            $sarathi_id = $val[field_uid];
            $driver = $driver + $this->get_inactive_driver_of_sarathi($sarathi_id);
        }
        return $driver;
    }


    //////////////////////////// PANEL ACCESS /////////////

    public function get_panel_access_list($user_id){
        $query = $this->db->select('permission')->where(field_user_id, $user_id)->get(table_panel_access_permissions);
        $query = $query->result_array();
        foreach($query as $i=>$val){
            $query[$i]['permission']=json_decode($val['permission']);
        }
        return(!empty($query))?$query[0]:null;
    }

    public function get_user_panel_access($user_id){
        $query=$this->db->select('permission')->where(field_user_id, $user_id)->get(table_panel_access_permissions);
        $query=$query->result_array();
        foreach($query as $i=>$val){
            $query[$i]['permission']=json_decode($val['permission']);
        }
        return (!empty($query))? $query[0]:[];
    }

}
?>