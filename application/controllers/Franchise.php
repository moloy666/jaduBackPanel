<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Franchise extends CI_Controller
{
	private function load_header($header_data = [], $header_link_data = [])
	{
		$this->load->view(franchise_page_header_link, $header_link_data);
		$this->load->view(franchise_page_header, $header_data);
	}
	private function load_sidebar($sidebar_data = [])
	{
		$this->load->view(franchise_page_sidebar, $sidebar_data);
	}
	private function load_footer($footer_data = [], $footer_link_data = [])
	{
		$this->load->view(franchise_page_footer, $footer_data);
		$this->load->view(franchise_page_footer_link, $footer_link_data);
	}

	private function is_user_active()
	{
		$user_id = $this->session->userdata(session_franchise_user_id);
		$this->init_login_model();
		$status = $this->Login_model->get_user_status_by_user_id($user_id);

		$logged_in = (!empty($this->session->userdata(session_franchise_name)) && $status == const_active) ? true : false;
		return $logged_in;
	}

	private function is_user_logged_in()
	{
		// $user_id = $this->session->userdata(session_franchise_user_id);
		// $this->init_login_model();
		// $status = $this->Login_model->get_user_status_by_user_id($user_id);

		$logged_in = (!empty($this->session->userdata(session_franchise_name))) ? true : false;
		return $logged_in;
	}

	private function init_login_model()
	{
		$this->load->model(model_login);
	}

	private function init_uid_server_model()
	{
		$this->load->model(model_uid_server);
	}

	private function init_common_model()
	{
		$this->load->model(model_common);
	}

	private function init_franchise_model()
	{

		$this->load->model(model_franchise_model);
	}

	private function init_sarathi_details_model()
	{
		$this->load->model(model_sarathi_details);
	}

	private function init_sub_franchise_model()
	{
		$this->load->model(model_sub_franchise_model);
	}

	private function init_sarathi_model()
	{
		$this->load->model(model_sarathi);
	}

	private function init_driver_model()
	{
		$this->load->model(model_driver);
	}

	private function init_customer_model()
	{
		$this->load->model(model_customers_model);
	}
	private function init_admin_model()
	{
		$this->load->model(model_admin);
	}

	private function response($data, $status)
	{

		return $this->output->set_content_type("application/json")
			->set_status_header($status)
			->set_output(json_encode($data));
	}

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set(field_location);
	}

	/////////////// VIEW STARTS //////////////////////////

	public function index()
	{

		if ($this->is_user_logged_in()) {
			$user_type = end($this->uri->segments);
			redirect(base_url($user_type . '/dashboard'));
		} else {
			$this->load->view(franchise_page_header_link);
			$this->load->view(view_franchise_login);
			$this->load->view(franchise_page_footer_link);
		}
	}

	public function view_login()
	{
		if ($this->is_user_logged_in()) {
			$user_type = end($this->uri->segments);
			redirect(base_url($user_type . '/dashboard'));
		} else {
			$this->load->view(franchise_page_header_link);
			$this->load->view(view_franchise_login);
			$this->load->view(franchise_page_footer_link);
		}
	}


	public function view_dashboard()
	{
		if ($this->is_user_logged_in()) {
			$user_type = $this->uri->segment(1);
			$table = $this->session->userdata(session_franchise_table);
			$user_id = $this->session->userdata(session_franchise_user_id);
			$this->init_common_model();
			$data[field_specific_level_user_id] = $this->Common_model->get_specific_id_by_user_id($user_id, $table);
			$this->init_franchise_model();

			$this->session->set_userdata(fr_session_subfranchise_data, $this->Franchise_model->get_access_permission($user_id, access_subfranchise_data));
			$this->session->set_userdata(fr_session_sarathi_data, $this->Franchise_model->get_access_permission($user_id, access_sarathi_data));
			$this->session->set_userdata(fr_session_driver_data, $this->Franchise_model->get_access_permission($user_id, access_driver_data));
			$this->session->set_userdata(fr_session_customers_data, $this->Franchise_model->get_access_permission($user_id, access_customers_data));

			$this->session->set_userdata(fr_session_incentive, $this->Franchise_model->get_access_permission($user_id, access_incentives_scheme));
			$this->session->set_userdata(fr_session_call_booking, $this->Franchise_model->get_access_permission($user_id, access_call_booking));
			$this->session->set_userdata(fr_session_ride_rental, $this->Franchise_model->get_access_permission($user_id, access_ride_rental));
			$this->session->set_userdata(fr_session_fare_list, $this->Franchise_model->get_access_permission($user_id, access_fare_management));
			$this->session->set_userdata(fr_session_service_ride, $this->Franchise_model->get_access_permission($user_id, access_service_ride));
			$this->session->set_userdata(fr_session_compliments, $this->Franchise_model->get_access_permission($user_id, access_compliments));
			$this->session->set_userdata(fr_session_achivements, $this->Franchise_model->get_access_permission($user_id, access_achivements));
			$this->session->set_userdata(fr_session_help, $this->Franchise_model->get_access_permission($user_id, access_help));
			$this->session->set_userdata(fr_session_feedback, $this->Franchise_model->get_access_permission($user_id, access_feedback));
			$this->session->set_userdata(fr_session_reports, $this->Franchise_model->get_access_permission($user_id, access_reports));

			$this->session->set_userdata(fr_session_places, $this->Franchise_model->get_access_permission($user_id, access_places));
			$this->session->set_userdata(fr_session_coupon, $this->Franchise_model->get_access_permission($user_id, access_coupon));

			$this->session->set_userdata(session_franchise_status, $this->Common_model->get_status_by_user_id($user_id));

			$this->load_header();
			$this->load_sidebar();
			$this->load->view(view_franchise_dashboard, $data);
			$this->load_footer();
			$this->load->view('franchise/inc/franchise_custom_js/dashboard_js');
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_subfranchise()
	{
		if ($this->is_user_logged_in()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			if ($this->session->userdata(session_franchise_type_id) == 'user_franchise') {
				$this->init_franchise_model();
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);

				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_franchise_subfranchises, $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/subfranchise_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_subfranchise_details($subfranchise_user_id)
	{
		if ($this->is_user_logged_in()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$data['data'] = $this->Franchise_model->get_subfranchise_details($subfranchise_user_id);


			$this->init_franchise_model();
			$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
			$this->load_header();
			$this->load_sidebar();
			$this->load->view(view_franchise_subfranchise_sarathi, $data);
			$this->load_footer();
			$this->load->view('franchise/inc/franchise_custom_js/subfranchise_details_js');
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_sarathi()
	{
		if ($this->is_user_logged_in()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);
			$this->init_franchise_model();
			$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
			$specific_id = $data['specific_id'];
			$this->init_sarathi_model();
			if ($table == table_franchise) {
				$data['sarathi_data'] = $this->Sarathi_model->get_sub_franchise_ids($specific_id);
			} else {
				$data['sarathi_data'] = $this->Sarathi_model->get_sarathi_ids_of_subfranchise($specific_id);
			}

			$this->load_header();
			$this->load_sidebar();
			$this->load->view(view_franchise_sarathi, $data);
			$this->load_footer();
			$this->load->view('franchise/inc/franchise_custom_js/sarathi_js');
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	// public function view_customers(){

	// 	if ($this->is_user_logged_in()) {
	// 		$user_id = $this->session->userdata(session_franchise_user_id);
	// 		$table = $this->session->userdata(session_franchise_table);
	// 		$this->init_franchise_model();
	// 		$specific_id = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
	// 		$data['specific_id']=$specific_id;
	// 		$this->init_sarathi_model();
	// 		if($table==table_franchise){
	// 			$subfranchise_ids=$this->Sarathi_model->get_sub_franchise($specific_id);

	// 			foreach($subfranchise_ids as $i=>$subfranchise){
	// 				$subfranchise_id=$subfranchise[field_uid];
	// 				$data['sarathi_data'][$i]=$this->Sarathi_model->get_sarathi_by_subfranchise_id($subfranchise_id);
	// 			}
	// 		}
	// 		else{
	// 			$data['sarathi_data'][0]=$this->Sarathi_model->get_sarathi_by_subfranchise_id($specific_id);
	// 		}

	// 		$this->load_header();
	// 		$this->load_sidebar();
	// 		$this->load->view('franchise/fr_customers', $data);
	// 		$this->load_footer();
	// 		// $this->load->view('franchise/inc/franchise_custom_js/sarathi_js');
	// 	} else {
	// 		$user_type = ($this->uri->segment(1));
	// 		redirect(base_url($user_type));
	// 	}
	// }

	public function view_sarathi_details($user_id)
	{
		if ($this->is_user_logged_in()) {
			$this->init_sarathi_details_model();
			$data['sarathi_id'] = $this->Sarathi_details_model->get_sarathi_id_by_user_id($user_id);
			$data['sarathi_data'] = $this->Sarathi_details_model->get_all_sarathi_details($user_id);
			$franchise_user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($franchise_user_id, $table);

			$this->load_header();
			$this->load_sidebar();
			$this->load->view('franchise/fr_sarathi_details', $data);
			$this->load_footer();
			$this->load->view('franchise/inc/franchise_custom_js/sarathi_details_js');
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_driver()
	{
		if ($this->is_user_logged_in()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_driver_data);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$specific_id = $data['specific_id'];
				$this->init_driver_model();
				if ($table == table_franchise) {
					$data['driver_data'] = $this->Driver_model->get_driver_data_of_franchise($specific_id);
				} else {
					$data['driver_data'] = $this->Driver_model->get_driver_data_of_subfranchise($specific_id);
				}

				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_franchise_driver, $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/driver_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_driver_details($user_id)
	{
		if ($this->is_user_logged_in()) {
			$this->init_driver_model();
			$this->init_admin_model();
			
			$data['data'] = $this->Driver_model->display_driver_details($user_id);
			$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, table_driver);

			$data['ride_history'] = $this->Admin_model->get_driver_ride_history($specific_id);
			$data['companion'] = 'Customer';

			$data['recharge_history'] =  $this->Driver_model->get_recharge_history_of_driver($user_id);

			$this->load_header();
			$this->load_sidebar();
			$this->load->view('driver_details', $data);
			$this->load_footer();
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_driver_location()
	{
		if ($this->is_user_logged_in()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);
			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_driver_data);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);

				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_driver_location', $data);
				$this->load_footer();
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_incentives()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_incentives_scheme);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_incentives', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/incentives_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_call_booking()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_call_booking);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_call_booking', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/customer_call_booking_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_rental_slabs()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_ride_rental);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_rental_slabs', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/rental_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_rental_features()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_ride_rental);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_rental_features', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/rental_feature_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_rental_details()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_ride_rental);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_rental_details', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/rental_details_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_fare_list()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_fare_management);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_fare_management', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/fare_management_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_services()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_service_ride);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_services', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/services_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_compliments()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_compliments);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_compliments', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/compliments_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_achivements()
	{

		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);
			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_achivements);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_achievement', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/achievement_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_help()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_help);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_help', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/help_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_feedback()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_feedback);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_feedback', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/feedback_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_resolve_reports()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_reports);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_reports', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/resolve_reports_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_unresolve_reports()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_reports);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_unresolve_reports', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/unresolve_reports_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_places()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			$status = $this->Franchise_model->get_access_permission($user_id, access_places);
			if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_places', $data);
				$this->load_footer();
				$this->load->view('franchise/inc/franchise_custom_js/places_js');
			} else {
				$user_type = ($this->uri->segment(1));
				redirect(base_url($user_type . '/dashboard'));
			}
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}



	public function view_profile()
	{
		if ($this->is_user_logged_in()) {
			$table = $this->session->userdata(session_franchise_table);
			$user_id = $this->session->userdata(session_franchise_user_id);
			$this->init_franchise_model();
			$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
			$this->load_header();
			$this->load_sidebar();
			$this->load->view('franchise/fr_profile', $data);
			$this->load_footer();
			$this->load->view('franchise/inc/franchise_custom_js/profile_js');
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}

	public function view_recharge_history()
	{
		if ($this->is_user_active()) {
			$user_id = $this->session->userdata(session_franchise_user_id);
			$table = $this->session->userdata(session_franchise_table);

			$this->init_franchise_model();
			// $status = $this->Franchise_model->get_access_permission($user_id, access_ride_rental);
			// if ($status == const_active) {
				$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($user_id, $table);
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('franchise/fr_recharge_history', $data);
				$this->load_footer();
			// } else {
			// 	$user_type = ($this->uri->segment(1));
			// 	redirect(base_url($user_type . '/dashboard'));
			// }
		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}



	public function view_settings()
	{
		if ($this->is_user_logged_in()) {
			// $user_id = $this->session->userdata(session_franchise_user_id);
			// $this->init_franchise_model();
			// $status = $this->Franchise_model->get_access_permission($user_id, access_incentives_scheme);
			// if($status==const_active){
			$franchise_user_id = $this->session->userdata(session_franchise_user_id);
			$this->init_franchise_model();
			$data['specific_id'] = $this->Franchise_model->get_specific_id_by_user_id($franchise_user_id);
			$this->load_header();
			$this->load_sidebar();
			$this->load->view('franchise/fr_incentives', $data);
			$this->load_footer();
			$this->load->view('franchise/inc/franchise_custom_js/incentives_js');
			// }
			// else{
			// 	$user_type = ($this->uri->segment(1));
			// 	redirect(base_url($user_type.'/dashboard'));
			// }

		} else {
			$user_type = ($this->uri->segment(1));
			redirect(base_url($user_type));
		}
	}



	/////////////// VIEW END ////////////////////////


	public function demo()
	{
		print_r('success');
	}

	public function authenticate_user()
	{

		$email = $this->input->post(param_email);
		$password = md5($this->input->post(param_password));
		$user_type = $this->input->post(param_user_type);
		$user_type_name = '';
		$accepted_user_type = [
			"1" => value_franchise,
			"2" => value_subfranchise
		];
		if (array_key_exists($user_type, $accepted_user_type)) {
			$user_type_name = $accepted_user_type[$user_type];
			$table = ($user_type_name == value_franchise) ? table_franchise : table_subfranchise;
			$this->init_login_model();
			$type = $this->Login_model->get_user_type_id_by_user_type_name($user_type_name);
			$type_id = $type->uid;
			$this->session->set_userdata(session_franchise_user_type, $user_type_name);		// name => franchise || subfranchise
			if (!empty($email) && !empty($password)) {
				$user_details = $this->Login_model->get_franchise_details_on_condition($email, $password, $type_id, $table);
				if (!empty($user_details)) {

					$this->session->set_userdata(session_franchise_type_id, $user_details->type_id);
					$this->session->set_userdata(session_franchise_table, $table);
					$this->session->set_userdata(session_franchise_name, $user_details->name);
					$this->session->set_userdata(session_franchise_user_id, $user_details->uid);
					$this->session->set_userdata(session_franchise_profile_image, $user_details->profile_image);
					$this->session->set_userdata(session_franchise_status, $user_details->status);


					if ($this->session->userdata(session_franchise_type_id) == "user_franchise") {

						$this->response([key_success => true, key_message => "User authentication successfull", key_redirect_to => base_url('franchise/dashboard')], 200);
					}
					if ($this->session->userdata(session_franchise_type_id) == 'user_sub_franchise') {
						$this->response([key_success => true, key_message => "User authentication successfull", key_redirect_to => base_url('subfranchise/dashboard')], 200);
					}
				} else {
					$this->response([key_success => false, key_message => "Invaild Email or Password!"], 200);
				}
			} else {
				$this->response([key_success => false, key_message => "Email or Password is not given!"], 400);
			}
		} else {
			$this->response([key_success => false, key_message => "Select user type"], 400);
		}
	}

	public function logout()
	{
		$user_type = $this->session->userdata(session_franchise_type_id);

		$this->session->unset_userdata(session_franchise_name);
		$this->session->unset_userdata(session_franchise_type_id);
		$this->session->unset_userdata(session_franchise_user_type);
		$this->session->unset_userdata(session_franchise_user_id);
		$this->session->unset_userdata(session_franchise_profile_image);
		$this->session->unset_userdata(session_franchise_table);
		$this->session->unset_userdata(session_franchise_data);
		$this->session->unset_userdata(session_subfranchise_data);
		$this->session->unset_userdata(session_sarathi_data);
		$this->session->unset_userdata(session_driver_data);
		$this->session->unset_userdata(session_customers_data);
		$this->session->unset_userdata(session_franchise_status);

		$this->session->unset_userdata(fr_session_incentive);
		$this->session->unset_userdata(fr_session_call_booking);
		$this->session->unset_userdata(fr_session_ride_rental);
		$this->session->unset_userdata(fr_session_fare_list);
		$this->session->unset_userdata(fr_session_service_ride);
		$this->session->unset_userdata(fr_session_compliments);
		$this->session->unset_userdata(fr_session_achivements);
		$this->session->unset_userdata(fr_session_help);
		$this->session->unset_userdata(fr_session_feedback);
		$this->session->unset_userdata(fr_session_reports);

		if ($user_type == 'user_franchise') {
			redirect(base_url('franchise'));
		} else {
			redirect(base_url('subfranchise'));
		}
	}

	public function get_dashboard_data()
	{
		$this->init_common_model();
		$this->init_admin_model();

		$specific_id = $this->input->post(param_id);  // FRANCHISE || SUBFRANCHISE
		$table = $this->input->post(param_table);
		$user_id = $this->Common_model->get_user_id_by_specific_id($specific_id, $table);


		$data = [
			'totalSubFranchise' => $this->Common_model->get_total_sub_franchise($specific_id),
			'totalSarathi' => $this->Common_model->get_total_sarathi($specific_id),
			'drivers' => [
				'active' => $this->Common_model->get_total_active_drivers($specific_id),
				'inactive' => $this->Common_model->get_total_inactive_drivers($specific_id),
				'total' => $this->Common_model->get_total_drivers($specific_id)
			],
			'totalCustomers' => $this->Common_model->get_total_customers($specific_id),
			'totalRevenue' =>  $this->Common_model->get_total_revenue($specific_id),
			'totalRevenueStatus' =>  $this->Common_model->get_revenue_status($specific_id),
			'totalKmPurchased' =>  $this->Common_model->total_km_purchase($specific_id, $table),
			'totalKmPurchaseToday' => $this->Admin_model->total_km_purchase_today($user_id),

		];
		echo json_encode($data);
	}

	public function get_subfranchise_dashboard_data()
	{
		$this->init_common_model();
		$this->init_admin_model();


		$subfranchise_id = $this->input->post(param_id);  // FRANCHISE || SUBFRANCHISE
		$table = $this->input->post(param_table);
		$user_id = $this->Common_model->get_user_id_by_specific_id($subfranchise_id, $table);

		$data = [
			'totalSarathi' => $this->Common_model->get_total_sarathi_of_sub_franchise($subfranchise_id),
			'drivers' => [
				'active' => $this->Common_model->get_total_active_driver_of_sub_franchise($subfranchise_id),
				'inactive' => $this->Common_model->get_total_inactive_driver_of_sub_franchise($subfranchise_id),
				'total' => $this->Common_model->get_total_driver_of_sub_franchise($subfranchise_id)
			],
			'totalCustomers' => $this->Common_model->get_total_customers_of_subfranchise($subfranchise_id),
			'totalRevenue' =>  $this->Common_model->get_total_revenue_of_subfranchise($subfranchise_id),
			'totalRevenueStatus' =>  $this->Common_model->get_revenue_status_of_subfranchise($subfranchise_id),
			'totalKmPurchased' =>  $this->Common_model->total_km_purchase($subfranchise_id, $table),
			'totalKmPurchaseToday' => $this->Admin_model->total_km_purchase_today($user_id),

		];
		echo json_encode($data);
	}

	public function download_progress_report($specific_id, $table)
	{

		$this->init_common_model();
		$this->init_admin_model();

		$user_id = $this->Common_model->get_user_id_by_specific_id($specific_id, $table);

		if ($table == table_franchise) {
			$data = [
				'totalSubFranchise' => $this->Common_model->get_total_sub_franchise($specific_id),
				'totalSarathi' => $this->Common_model->get_total_sarathi($specific_id),
				'drivers' => [
					'active' => $this->Common_model->get_total_active_drivers($specific_id),
					'inactive' => $this->Common_model->get_total_inactive_drivers($specific_id),
					'total' => $this->Common_model->get_total_drivers($specific_id)
				],
				'totalCustomers' => $this->Common_model->get_total_customers($specific_id),
				'totalRevenue' =>  $this->Common_model->get_total_revenue($specific_id),
				'revenueStatus' =>  $this->Common_model->get_revenue_status($specific_id),
				'totalCarRunning' =>  $this->Common_model->get_total_active_drivers($specific_id),
				'sarathi_data' => $this->Common_model->getSarahiData_for_franchise($specific_id),
				'totalKmPurchased' =>  $this->Common_model->total_km_purchase($specific_id, $table),
				'user_details' => $this->Common_model->get_user_details($specific_id, $table),
				'totalKmPurchaseToday' => $this->Admin_model->total_km_purchase_today($user_id),

			];
		} else {
			$data = [
				'totalSarathi' => $this->Common_model->get_total_sarathi_of_sub_franchise($specific_id),
				'drivers' => [
					'active' => $this->Common_model->get_total_active_driver_of_sub_franchise($specific_id),
					'inactive' => $this->Common_model->get_total_inactive_driver_of_sub_franchise($specific_id),
					'total' => $this->Common_model->get_total_driver_of_sub_franchise($specific_id)
				],
				'totalCustomers' => $this->Common_model->get_total_customers_of_subfranchise($specific_id),
				'totalRevenue' =>  $this->Common_model->get_total_revenue_of_subfranchise($specific_id),
				'revenueStatus' =>  $this->Common_model->get_revenue_status_of_subfranchise($specific_id),
				'totalCarRunning' =>  $this->Common_model->get_total_active_driver_of_sub_franchise($specific_id),
				'sarathi_data' => $this->Common_model->getSarahiData_for_subfranchise($specific_id),
				'totalKmPurchased' =>  $this->Common_model->total_km_purchase($specific_id, $table),
				'user_details' => $this->Common_model->get_user_details($specific_id, $table),
				'totalKmPurchaseToday' => $this->Admin_model->total_km_purchase_today($user_id),

			];
		}
		$name = 'progress_report_' . time();
		$mpdf = new \Mpdf\Mpdf();
		$html = $this->load->view('franchise/fr_progress_report', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output($name . ".pdf", "D");
	}


	public function get_subfranchise_id()
	{
		$franchise_id = $this->input->post('id');
		$this->init_franchise_model();
		$data = $this->Franchise_model->get_subfranchise_ids($franchise_id);
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'found', 'data' => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'found'], 200);
		}
	}

	public function get_sarathi_id()
	{
		$subfranchise_id = $this->input->post('id');
		$this->init_franchise_model();
		$data = $this->Franchise_model->get_sarathi_ids($subfranchise_id);
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'found', 'data' => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'found'], 200);
		}
	}


	public function deactive_driver()
	{

		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$user_id = $this->input->post(param_id);
				$this->init_driver_model();
				$deactive = $this->Driver_model->deactive_driver_status($user_id);
				if ($deactive) {
					$this->response(["success" => true, "message" => "User deactivated successfully "], 200);
				} else {
					$this->response(["success" => false, "message" => "Failed to deactivated user"], 200);
				}
			} else {
				$this->response(["success" => false, "message" => text_account_not_active], 200);
			}
		} else {
			$user_id = $this->input->post(param_id);
			$this->init_driver_model();
			$deactive = $this->Driver_model->deactive_driver_status($user_id);
			if ($deactive) {
				$this->response(["success" => true, "message" => "User deactivated successfully "], 200);
			} else {
				$this->response(["success" => false, "message" => "Failed to deactivated user"], 200);
			}
		}
	}

	public function active_driver()
	{
		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');
		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$user_id = $this->input->post(param_id);
				$this->init_driver_model();
				$active = $this->Driver_model->active_driver_status($user_id);
				if ($active) {
					$this->response(["success" => true, "message" => "User Activate Successfully "], 200);
				} else {
					$this->response(["success" => false, "message" => "Failed to activated user"], 200);
				}
			} else {
				$this->response(["success" => false, "message" => text_account_not_active], 200);
			}
		} else {
			$user_id = $this->input->post(param_id);
			$this->init_driver_model();
			$active = $this->Driver_model->active_driver_status($user_id);
			if ($active) {
				$this->response(["success" => true, "message" => "User activated successfully "], 200);
			} else {
				$this->response(["success" => false, "message" => "Failed to activated user"], 200);
			}
		}
	}

	public function delete_driver()
	{

		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$user_id = $this->input->post(param_id);
				$this->init_driver_model();
				$delete = $this->Driver_model->delete_driver_details($user_id);
				if ($delete) {
					$this->response(["success" => true, "message" => "Data deleted successfully "], 200);
				} else {
					$this->response(["success" => false, "message" => "Failed to delete data"], 200);
				}
			} else {
				$this->response(["success" => false, "message" => text_account_not_active], 200);
			}
		} else {
			$user_id = $this->input->post(param_id);
			$this->init_driver_model();
			$delete = $this->Driver_model->delete_driver_details($user_id);
			if ($delete) {
				$this->response(["success" => true, "message" => "Data deleted successfully "], 200);
			} else {
				$this->response(["success" => false, "message" => "Failed to delete data"], 200);
			}
		}
	}

	public function update_driver()
	{
		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		$user_id = $this->input->post(param_id);
		$name = trim($this->input->post(param_name));
		$email = trim($this->input->post(param_email));
		$mobile = trim($this->input->post(param_mobile));

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$this->mofify_driver($user_id, $name, $mobile, $email);
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$this->mofify_driver($user_id, $name, $mobile, $email);
		}
	}

	public function mofify_driver($user_id, $name, $mobile, $email)
	{
		$this->init_common_model();

		$array = [
			"modified_at" => date(field_date)
		];

		$data = $this->Common_model->get_user_details_by_user_id($user_id);
		$present_name = $data->name;
		$present_mobile = $data->mobile;
		$present_email = $data->email;

		if ($present_name != $name) {
			$array["name"] = $name;
		} else {
			$array["name"] = $present_name;
		}

		if ($present_mobile != $mobile) {
			$array["mobile"] = $mobile;
			$mobile_exist = $this->Common_model->is_this_value_exist($mobile,  field_mobile, table_users);

			if ($mobile_exist) {
				$this->response([key_success => false, key_message => "This Mobile is already registered for " . $mobile_exist->name], 200);
				return;
			}
		} else {
			$array["mobile"] = $present_mobile;
		}

		if ($present_email != $email) {
			$array["email"] = $email;
			$email_exist = $this->Common_model->is_this_value_exist($email, field_email, table_users);

			if ($email_exist) {
				$this->response([key_success => false, key_message => "This Email is already registered for " . $email_exist->name], 200);
				return;
			}
		} else {
			$array["email"] = $present_email;
		}


		if (strlen($mobile) != 10) {
			$this->response([key_success => false, key_message => "Mobile Number Must Contain 10 digits"], 200);
		} else {
			if (strlen($name) < 3) {
				$this->response([key_success => false, key_message => "Name should contain 3 characters"], 200);
			} else {
				$this->init_driver_model();
				$update = $this->Driver_model->update_driver_details($user_id, $array);
				if ($update) {
					$this->response([key_success => true, key_message => "Data updated successfully"], 200);
				} else {
					$this->response([key_success => false, key_message => "Something went wrong"], 200);
				}
			}
		}
	}


	public function manage_franchise_profile()
	{
		$user_id = $this->session->userdata(session_franchise_user_id);
		$this->init_franchise_model();
		$data = $this->Franchise_model->get_franchise_profile($user_id);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "details found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "details not found"], 200);
		}
	}

	public function update_user_profile()
	{

		// $user_id = $this->input->post(param_id);
		$user_id = $this->session->userdata(session_franchise_user_id);

		$name = $this->input->post(param_name);
		$dob = $this->input->post(param_dob);
		$gender = $this->input->post(param_gender);
		// $mobile = $this->input->post(param_mobile);
		// $email = $this->input->post(param_email);

		if (!empty($name) && !empty($dob) && !empty($gender)) {


			$this->init_sarathi_details_model();
			$update = $this->Sarathi_details_model->update_user_profile_details($user_id, $name, $dob, $gender);
			if ($update) {
				$this->response(["success" => true, "message" => "Update Successful"], 200);

				$this->session->set_userdata(session_franchise_name, $name);
			} else {
				$this->response(["success" => false, "message" => "No changes detucted"], 200);
			}
		} else {
			$this->response(["success" => false, "message" => "Input All Fields"], 200);
		}
	}

	public function get_panel_access_list()
	{
		$this->init_common_model();
		$user_id = $this->session->userdata(session_franchise_user_id);
		$data = $this->Common_model->get_panel_access_list($user_id);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found..", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found.."], 200);
		}
	}


	public function getsarathiData()
	{
		$specific_id = $this->input->post(param_specific_id);
		$table = $this->input->post(param_table);
		$this->init_common_model();
		if ($table == table_franchise) {
			$data = $this->Common_model->getSarahiData_for_franchise($specific_id);
		} else {
			$data = $this->Common_model->getSarahiData_for_subfranchise($specific_id);
		}

		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found..", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found.."], 200);
		}
	}

	public function get_customers_data()
	{
		$specific_id = $this->input->post(param_specific_id);
		$table = $this->input->post(param_table);
		$this->init_common_model();
		if ($table == table_franchise) {
			$data = $this->Common_model->get_customer_for_franchise($specific_id);
		} else {
			$data = $this->Common_model->get_customer_for_subfranchise($specific_id);
		}

		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Customers Found..", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found.."], 200);
		}
	}

	public function display_driver_location()
	{
		$specific_id = $this->input->post(param_specific_id);
		$table = $this->input->post('table');

		$this->init_common_model();
		if ($table  == table_franchise) {
			$data = $this->Common_model->display_driver_location($specific_id);
		} else {
			$data = $this->Common_model->display_driver_location_of_subfranchise($specific_id);
		}
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'found', 'data' => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Driver Locations Not Found', 'data' => $data], 200);
		}
	}

	public function download_recharge_history($user_id)
    {
        $this->init_sarathi_model();
        $data['sarathi'] = $this->Sarathi_model->get_user_name_by_id($user_id);
        $data['sarathi_data'] = $this->Sarathi_model->get_recharge_histiry_of_sarathi($user_id);
		$data['user_type'] = $this->Sarathi_model->get_user_type_by_user_id($user_id);

        // $this->load_header();
        // $this->load_sidebar();
        // $this->load->view('sarathi/download_recharge_history', $data);
        // $this->load_footer();

        $name = 'recharge_history_' . time();
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('sarathi/download_recharge_history', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($name . ".pdf", "D");
    }

	// public function display_driver_details($user_id)
	// {
	// 	if ($this->is_user_logged_in()) {
	// 		$this->init_driver_model();
	// 		$this->init_admin_model();

	// 		$data['data'] = $this->Driver_model->display_driver_details($user_id);
	// 		$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, table_driver);

	// 		$data['ride_history'] = $this->Admin_model->get_driver_ride_history($specific_id);
	// 		$data['companion'] = 'Customer';

	// 		$data['recharge_history'] =  $this->Driver_model->get_recharge_history_of_driver($user_id);


	// 		$this->load_header();
	// 		$this->load_sidebar();
	// 		$this->load->view('driver_details', $data);
	// 		$this->load_footer();
	// 	} else {
	// 		redirect(base_url());
	// 	}
	// }
}
