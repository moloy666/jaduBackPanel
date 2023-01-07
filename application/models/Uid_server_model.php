<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Uid_server_model extends CI_Model {
	
	private $prefix_data = [
		KEY_USER => UID_USER_PREFIX,
		KEY_SARATHI => UID_SARATHI_PREFIX,
		KEY_DRIVER => UID_DRIVER_PREFIX,
		KEY_CUSTOMER => UID_CUSTOMER_PREFIX,

		KEY_ADMIN => UID_ADMIN_PREFIX,
		KEY_ADMINISTRATOR => UID_ADMINISTRATOR_PREFIX,
		KEY_FRANCHISE => UID_FRANCHISE_PREFIX,
		KEY_SUBFRANCHISE =>  UID_SUBFRANCHISE_PREFIX,
		KEY_IMAGE => UID_IMAGES_PREFIX,
		KEY_SPLASH => UID_SPLASH_PREFIX,
		KEY_VEHICLE => UID_VEHICLE_PREFIX,
		KEY_RENTAL_SLAB => UID_RENTAL_SLAB_PREFIX,
		KEY_GID => UID_GID_PREFIX,
		KEY_BANK_DETAILS=>UID_BANK_DETAILS_PREFIX,
		KEY_HOTEL=>UID_HOTEL_PREFIX,
		KEY_PACKAGES=>UID_PACKAGES_PREFIX,
		
		'SCHEME'=>'SCHEME_',
		'RM'=>'RM_',
		'PERMISSION'=>'PERMISSION_',
		'COUPON'=>'COUPON_',
		'STATE'=>'STATE_',
		'DISTRICT'=>'DISTRICT_',
		'CITY'=>'CITY_',
		'COUNTRY'=>'COUNTRY_',


		// 'BANK_DETAILS' => 'BANK_DETAILS_',
		// KEY_KYC => UID_KYC_PREFIX,
		// 'SARATHI_CREDIT' => 'SARATHI_CREDIT_',
		// KEY_DOCUMENT => UID_DOCUMENT_PREFIX,
		// KEY_GROUP => UID_GROUP_PREFIX,
		// KEY_ADDRESS => UID_ADDRESS_PREFIX,
		// KEY_BANK_DETAILS => UID_BANK_DETAILS_PREFIX,
		// KEY_TOKEN=>UID_TOKEN_PREFIX,
		// KEY_HELP=>UID_HELP_PREFIX
	];

	public function __construct(){
		parent::__construct();
	}

	private function uid(){
        return (bin2hex(openssl_random_pseudo_bytes(16)));
    }

	public function generate_uid($purpose = null){		
  		return (array_key_exists($purpose, $this->prefix_data)) ? $this->prefix_data[$purpose] . $this->uid() ."_". time(): 0;
	}

	function generate_coupon_code($length_of_string) {
		return substr(bin2hex(random_bytes($length_of_string)), 0 , $length_of_string);
	}

	public function is_this_value_exist($field_value, $field_name, $table){		

		$this->db->select('user_type.name');
        $this->db->from($table);
		$this->db->join('user_type', $table.'.type_id = user_type.uid');
        $this->db->where('users.'.$field_name, $field_value);
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


}
