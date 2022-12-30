<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	private function load_header($header_data = [], $header_link_data = [])
	{
		$this->load->view(page_header_link, $header_link_data);
		$this->load->view(page_header, $header_data);
	}
	private function load_sidebar($sidebar_data = [])
	{
		$this->load->view(page_sidebar, $sidebar_data);
	}
	private function load_footer($footer_data = [], $footer_link_data = [])
	{
		$this->load->view(page_footer, $footer_data);
		$this->load->view(page_footer_link, $footer_link_data);
	}

	// private function is_user_logged_in()
	// {
	// 	$logged_in = (!empty($this->session->userdata(field_name))) ? true : false;
	// 	return $logged_in;
	// }

	private function is_user_logged_in()
	{
		$user_id = $this->session->userdata(field_user_id);
		$this->init_login_model();
		$status = $this->Login_model->get_user_status_by_user_id($user_id);

		$logged_in = (!empty($this->session->userdata(field_name)) && $status == const_active) ? true : false;
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
	private function init_admin_model()
	{
		$this->load->model(model_admin);
	}
	private function init_franchise_model()
	{
		$this->load->model(model_franchise_model);
	}
	private function init_sub_franchise_model()
	{
		$this->load->model(model_sub_franchise_model);
	}
	private function init_sarathi_model()
	{
		$this->load->model(model_sarathi);
	}
	private function init_sarathi_details_model()
	{
		$this->load->model(model_sarathi_details);
	}
	private function init_driver_model()
	{
		$this->load->model(model_driver);
	}
	private function init_customer_model()
	{
		$this->load->model(model_customers_model);
	}
	private function response($data, $status)
	{
		return $this->output->set_content_type("application/json")
			->set_status_header($status)
			->set_output(json_encode($data));
	}

	public function php_info()
	{
		echo phpversion();
	}

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set(field_location);
	}
	public function index()
	{
		if ($this->is_user_logged_in()) {
			redirect(base_url('administrator/dashboard'));
		} else {
			$this->load->view(page_header_link);
			$this->load->view(view_login);
			$this->load->view(page_footer_link);
		}
	}

	public function view_compliments()
	{

		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_compliments);
			} else {
				$status = const_active;
			}

			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load_sidebar();
				$this->load->view('compliments');
				$this->load_footer();
				$this->load->view('inc/custom_js/compliments_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_achivements()
	{

		if ($this->is_user_logged_in()) {

			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_achivements);
			} else {
				$status = const_active;
			}

			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('achievement');
				$this->load_footer();
				$this->load->view('inc/custom_js/achievement_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_dormant_account()
	{

		if ($this->is_user_logged_in()) {
			// if ($this->session->userdata(field_type_id) == const_user_admin) {
			// 	$admin_id = $this->session->userdata(session_admin_specific_id);
			// 	$this->init_admin_model();
			// 	$status = $this->Admin_model->get_access_permission($admin_id, access_incentives_scheme);
			// } else {
			// 	$status = const_active;
			// }
			// if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('dormant_account');
				$this->load_footer();
				$this->load->view('inc/custom_js/incentives_js');
			// } else {
			// 	redirect(base_url('administrator/dashboard'));
			// }
		} else {
			redirect(base_url());
		}
	}

	public function view_incentives()
	{

		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_incentives_scheme);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_incentives);
				$this->load_footer();
				$this->load->view('inc/custom_js/incentives_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_ride_details()
	{
		if ($this->is_user_logged_in()) {
			// if ($this->session->userdata(field_type_id) == const_user_admin) {
			// 	$admin_id = $this->session->userdata(session_admin_specific_id);
			// 	$this->init_admin_model();
			// 	$status = $this->Admin_model->get_access_permission($admin_id, access_incentives_scheme);
			// } else {
			// 	$status = const_active;
			// }
			// if ($status == const_active) {

				$this->load_header();
				$this->load_sidebar();
				$this->load->view('ride_details');
				$this->load_footer();
				$this->load->view('inc/custom_js/ride_details_js');

			// } else {
			// 	redirect(base_url('administrator/dashboard'));
			// }
		} else {
			redirect(base_url());
		}
	}

	public function view_rental_slabs()
	{
		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_ride_rental);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('rental_slabs');
				$this->load_footer();
				$this->load->view('inc/custom_js/rental_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_rental_features()
	{

		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_ride_rental);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {

				$this->load_header();
				$this->load_sidebar();
				$this->load->view('rental_features');
				$this->load_footer();
				$this->load->view('inc/custom_js/rental_feature_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}


	public function view_coupons()
	{

		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_coupon);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {

			$this->load_header();
			$this->load_sidebar();
			$this->load->view('coupons');
			$this->load_footer();

			$this->load->view('inc/custom_js/coupons_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_places()
	{

		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_places);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {

			$this->load_header();
			$this->load_sidebar();
			$this->load->view('places');
			$this->load_footer();

			$this->load->view('inc/custom_js/places_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}


	public function view_rental_details()
	{

		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_ride_rental);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('rental_details');
				$this->load_footer();
				$this->load->view('inc/custom_js/rental_details_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_ride_history($user_id)
	{
		if ($this->is_user_logged_in()) {

			$user_type = $this->uri->segment(2);

			$this->init_admin_model();
			$data['username'] = $this->Admin_model->get_name_by_user_id($user_id);
			if ($user_type == "driver") {
				$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, table_driver);
				$data['ride_history'] = $this->Admin_model->get_driver_ride_history($specific_id);
				$data['companion'] = 'Customer';
			}
			if ($user_type == "customers") {
				$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, table_customer);
				$data['ride_history'] = $this->Admin_model->get_customer_ride_history($specific_id);
				$data['companion'] = 'Driver';
			}
			// $this->load_header();
			// $this->load_sidebar();
			// $this->load->view(view_ride_history, $data);
			// $this->load_footer();

			$name = 'ride_history_'.time();
			$mpdf = new \Mpdf\Mpdf();
			$html = $this->load->view(view_ride_history, $data, true);
			$mpdf->WriteHTML($html);
			$mpdf->Output($name.".pdf", "D");
		} else {
			redirect(base_url());
		}
	}

	public function ride_history_csv($user_id)
	{
		$filename = 'ride_history_' . time() . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");

		$user_type = $this->uri->segment(2);

		$this->init_admin_model();
		$data['username'] = $this->Admin_model->get_name_by_user_id($user_id);
		if ($user_type == "driver") {
			$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, table_driver);
			$data = $this->Admin_model->get_driver_ride_history($specific_id);
			$companion = 'Customer';
		}
		if ($user_type == "customers") {
			$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, table_customer);
			$data = $this->Admin_model->get_customer_ride_history($specific_id);
			$companion = 'Driver';
		}

		if (!empty($data)) {
			foreach ($data as $i => $val) {
				$ride_data[$i]['count'] = $i + 1;
				$ride_data[$i]['companion_name'] = ucwords($data[$i]['companion_name']);
				$ride_data[$i]['payment_mode'] = $data[$i]['payment_mode'];
				$ride_data[$i]['amount'] = $data[$i]['amount'];
				$ride_data[$i]['created_at'] = $data[$i]['created_at'];
			}
		} else {
			$ride_data[0]['count'] = 'No Data Found';
			$ride_data[0]['companion_name'] = 'No Data Found';
			$ride_data[0]['payment_mode'] = 'No Data Found';
			$ride_data[0]['amount'] = 'No Data Found';
			$ride_data[0]['created_at'] = 'No Data Found';
		}

		$file = fopen('php://output', 'w');

		$header = array('#', $companion, "Payment Mode", "Amount (₹)", "Date");
		fputcsv($file, $header);
		foreach ($ride_data as $i => $line) {
			fputcsv($file, $line);
		}
		fclose($file);
		exit;
	}


	public function generate_ride_history_pdf()
	{
		$data = $this->input->post('html');
		// $data=$this->load->view(view_ride_history);
		$mpdf = new \Mpdf\Mpdf();
		$html = $this->load->view('ride_history', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output("ride_history.pdf", "I");
	}

	public function authenticate_user()
	{

		$email = $this->input->post(param_email);
		$password = md5($this->input->post(param_password));
		$user_type = $this->input->post(param_user_type);
		$user_type_name = '';
		$accepted_user_type = [
			"1" => value_administrator,
			"2" => value_admin
		];
		if (array_key_exists($user_type, $accepted_user_type)) {
			$user_type_name = $accepted_user_type[$user_type];
			$table = ($user_type_name == value_administrator) ? value_administrator : value_admin;
			$this->init_login_model();
			$type = $this->Login_model->get_user_type_id_by_user_type_name($user_type_name);
			$type_id = $type->uid;
			$this->session->set_userdata(field_user_type, $user_type_name);		// name => administrator || admin
			if (!empty($email) && !empty($password)) {
				$user_details = $this->Login_model->get_user_details_on_condition($email, $password, $type_id, $table);
				if (!empty($user_details)) {
					$this->session->set_userdata(session_table, $table);	// reports section || change password
					$this->session->set_userdata(field_name, $user_details->name);
					$this->session->set_userdata(field_type_id, $user_details->type_id);
					$this->session->set_userdata(field_user_id, $user_details->uid);
					$this->session->set_userdata(field_profile_image, $user_details->profile_image);
					$this->session->set_userdata(session_admin_specific_id, $user_details->specific_id);
					if ($this->session->userdata(field_type_id) == "user_super_admin") {
						$this->response([key_success => true, key_message => "User authentication successfull", key_redirect_to => base_url('administrator/dashboard')], 200);
					}
					if ($this->session->userdata(field_type_id) == "user_admin") {
						$this->response([key_success => true, key_message => "User authentication successfull", key_redirect_to => base_url('administrator/dashboard')], 200);
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


	public function profile()
	{

		if ($this->is_user_logged_in()) {
			$this->load_header();
			$this->load_sidebar();
			$this->load->view(view_profile);
			$this->load_footer();
			$this->load->view('inc/custom_js/profile_js');
		} else {
			redirect(base_url());
		}
	}

	public function get_user_profile()
	{
		$this->init_login_model();
		$user_id = $this->session->userdata(field_user_id);
		$profile = $this->Login_model->display_user_profile($user_id);
		echo json_encode($profile);
	}

	public function get_user_list()
	{
		$this->init_login_model();
		$user_count = $this->Login_model->get_user_list();
		echo json_encode($user_count);
	}

	public function update_user_profile(){
		// $user_id = $this->input->post(param_id);
		$user_id = $this->session->userdata(field_user_id);
		$name = $this->input->post(param_name);
		$mobile = $this->input->post(param_mobile);
		$email = $this->input->post(param_email);
		$dob = $this->input->post(param_dob);
		$gender = $this->input->post(param_gender);
		if (!empty($name) && !empty($mobile) && !empty($email) && !empty($dob) && !empty($gender)) {

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

			$this->init_admin_model();
			$update = $this->Admin_model->update_user_profile_details($user_id, $name, $email, $mobile, $dob, $gender);
			if ($update) {
				$this->response(["success" => true, "message" => "Update Successful"], 200);
				$this->session->set_userdata(field_name, $name);
			} else {
				$this->response(["success" => false, "message" => "No changes detucted"], 200);
			}
		} else {
			$this->response(["success" => false, "message" => "Input All Fields"], 200);
		}
	}

	public function logout()
	{

		$this->session->unset_userdata(field_name);
		$this->session->unset_userdata(field_type_id);
		$this->session->unset_userdata(field_user_type);
		$this->session->unset_userdata(field_user_id);
		$this->session->unset_userdata(field_profile_image);
		$this->session->unset_userdata(session_table);
		$this->session->unset_userdata(session_sarathi_id);		//	create in sarathi_details function
		$this->session->unset_userdata(session_franchise_id);
		$this->session->unset_userdata(session_subfranchise_id);
		$this->session->unset_userdata(session_admin_specific_id);

		$this->session->unset_userdata(session_franchise_data);
		$this->session->unset_userdata(session_subfranchise_data);
		$this->session->unset_userdata(session_sarathi_data);
		$this->session->unset_userdata(session_driver_data);
		$this->session->unset_userdata(session_customers_data);

		$this->session->unset_userdata(session_incentive);
		$this->session->unset_userdata(session_call_booking);
		$this->session->unset_userdata(session_ride_rental);
		$this->session->unset_userdata(session_fare_list);
		$this->session->unset_userdata(session_service_ride);
		$this->session->unset_userdata(session_compliments);
		$this->session->unset_userdata(session_achivements);
		$this->session->unset_userdata(session_help);
		$this->session->unset_userdata(session_feedback);
		$this->session->unset_userdata(session_reports);

		redirect(base_url());
	}

	public function admin()
	{
		if ($this->is_user_logged_in()) {

			if ($this->session->userdata(field_type_id) == 'user_admin') {
				redirect(base_url('administrator/dashboard'));
			} else {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_admin);
				$this->load_footer();
			}
		} else {
			redirect(base_url());
		}
	}

	public function get_admin()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->get_admin_details();
		echo json_encode($data);
	}

	public function view_admin_details($user_id)
	{
		if ($this->is_user_logged_in()) {

			if ($this->session->userdata(field_type_id) == 'user_super_admin') {
				$this->init_admin_model();
				$data['data'] = $this->Admin_model->display_request_permission_of_admin($user_id);
				$data['details'] = $this->Admin_model->display_admin_details($user_id);

				$this->load_header();
				$this->load_sidebar();
				$this->load->view('admin_details', $data);
				$this->load_footer();
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function display_request_permission_of_admin()
	{
		$user_id = $this->input->post('user_id');
		$this->init_admin_model();
		$data = $this->Admin_model->display_request_permission_of_admin($user_id);
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => "found", "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => "not found"], 200);
		}
	}


	public function add_admin()
	{
		$missing_key = [];
		$input_data = [];
		$admin_data = [];

		$this->init_uid_server_model();
		$user_id = $this->Uid_server_model->generate_uid(KEY_USER);
		$admin_id = $this->Uid_server_model->generate_uid(KEY_ADMIN);
		$gid = $this->Uid_server_model->generate_uid(KEY_GID);

		$name = trim($this->input->post(param_name));
		$email = trim($this->input->post(param_email));
		$mobile = trim($this->input->post(param_mobile));
		$password = md5(trim($this->input->post(param_mobile)));

		$permission_ids = $this->input->post('permission');
		$panel_lists_ids = $this->input->post('panel_list');

		$panel_acess_list = json_encode(implode(',', $panel_lists_ids));

		$panel_access = [
			field_uid => $this->Uid_server_model->generate_uid('PERMISSION'),
			field_user_id => $user_id,
			field_specific_level_user_id => $admin_id,
			"permission" => $panel_acess_list,
			field_modified_at => date(field_date)
		];

		foreach ($permission_ids as $i => $permision) {
			$access[$i][field_uid] = $this->Uid_server_model->generate_uid('PERMISSION');
			$access[$i][field_user_id] = $user_id;
			$access[$i][field_specific_id] = $admin_id;
			$access[$i]['permission_id'] = $permision;
			$access[$i][field_status] = const_active;
		}

		$input_data[field_group_id] = $gid;

		if (!empty($name)) {
			$input_data[field_name] = $name;
		} else {
			$missing_key[] = field_name;
		}
		if (!empty($mobile)) {
			$input_data[field_mobile] = $mobile;
		} else {
			$missing_key[] = field_mobile;
		}
		if (!empty($email)) {
			$input_data[field_email] = $email;
		} else {
			$missing_key[] = field_email;
		}
		if (!empty($password)) {
			$admin_data[field_password] = $password;
		} else {
			$missing_key[] = field_password;
		}
		$admin_data[field_uid] = $admin_id;
		if (!empty($missing_key)) {
			$missing_string = implode(", ", $missing_key);
			$missing_string = rtrim($missing_string, ", ");
			$this->response([key_success => false, key_message => $missing_string . " not given!"], 200);
		} else {

			$this->init_common_model();
			$mobile_exist = $this->Common_model->is_this_value_exist($mobile, field_mobile, table_users);
			$email_exist = $this->Common_model->is_this_value_exist($email, field_email, table_users);
			if (!empty($mobile_exist)) {
				$this->response([key_success => false, key_message => "This Number already exist for " . $mobile_exist->name], 200);
				return;
			}
			if (!empty($email_exist)) {
				$this->response([key_success => false, key_message => "This Email already exist for " . $email_exist->name], 200);
				return;
			}
			$user_type_id = $this->Common_model->get_user_type_id_by_user_type_name(user_type_admin);
			$this->init_admin_model();
			$is_added = $this->Admin_model->add_admin_details($user_id, $user_type_id, $input_data, $admin_data, $access, $panel_access);
			if ($is_added) {
				$this->response([key_success => true, key_message => "Add new admin successfully."], 200);
			} else {
				$this->response([key_success => false, key_message => "Failed to add  new admin"], 200);
			}
		}
	}

	public function update_admin()
	{

		$user_id = $this->input->post(param_id);
		$name = trim($this->input->post(param_name));
		$mobile = trim($this->input->post(param_mobile));
		$email = trim($this->input->post(param_email));
		$permission_ids = $this->input->post(param_permission);
		$panel_ids = $this->input->post(param_panel_list);

		$this->init_admin_model();
		$this->init_uid_server_model();
		$admin_id = $this->Admin_model->get_specific_id_by_uid($user_id, table_admin);

		$panel_acess_list = json_encode(implode(',', $panel_ids));

		$panel_access = [
			field_permission => $panel_acess_list,
			field_modified_at => date(field_date)
		];

		foreach ($permission_ids as $i => $permision) {
			$access[$i]['uid'] = $this->Uid_server_model->generate_uid('PERMISSION');
			$access[$i]['user_id'] = $user_id;
			$access[$i]['specific_id'] = $admin_id;
			$access[$i]['permission_id'] = $permision;
			$access[$i]['status'] = const_active;
		}

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
				$update = $this->Admin_model->update_admin_details($user_id, $array, $access, $panel_access);
				if ($update) {
					$this->response([key_success => true, key_message => "Data updated successfully"], 200);
				} else {
					$this->response([key_success => false, key_message => "No Changes deducted"], 200);
				}
			}
		}
	}

	public function delete_admin()
	{

		$userid = $this->input->post(param_id);
		$this->init_admin_model();
		$delete = $this->Admin_model->delete_admin_details($userid);
		echo json_encode($delete);
	}

	public function deactive_admin()
	{

		$userid = $this->input->post(param_id);
		$this->init_admin_model();
		$status = $this->Admin_model->deactive_admin_status($userid);
		echo json_encode($status);
	}

	public function active_admin()
	{

		$userid = $this->input->post(param_id);
		$this->init_admin_model();
		$status = $this->Admin_model->active_admin_status($userid);
		echo json_encode($status);
	}
	/////////////////////////////////////////////////////////////////

	public function dashboard()
	{
		if ($this->is_user_logged_in()) {

			if ($this->session->userdata(field_type_id) == value_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$this->session->set_userdata(session_franchise_data, $this->Admin_model->get_access_permission($admin_id, access_franchise_data));
				$this->session->set_userdata(session_subfranchise_data, $this->Admin_model->get_access_permission($admin_id, access_subfranchise_data));
				$this->session->set_userdata(session_sarathi_data, $this->Admin_model->get_access_permission($admin_id, access_sarathi_data));
				$this->session->set_userdata(session_driver_data, $this->Admin_model->get_access_permission($admin_id, access_driver_data));
				$this->session->set_userdata(session_customers_data, $this->Admin_model->get_access_permission($admin_id, access_customers_data));

				$this->session->set_userdata(session_incentive, $this->Admin_model->get_access_permission($admin_id, access_incentives_scheme));
				$this->session->set_userdata(session_call_booking, $this->Admin_model->get_access_permission($admin_id, access_call_booking));
				$this->session->set_userdata(session_ride_rental, $this->Admin_model->get_access_permission($admin_id, access_ride_rental));
				$this->session->set_userdata(session_fare_list, $this->Admin_model->get_access_permission($admin_id, access_fare_management));
				$this->session->set_userdata(session_service_ride, $this->Admin_model->get_access_permission($admin_id, access_service_ride));
				$this->session->set_userdata(session_compliments, $this->Admin_model->get_access_permission($admin_id, access_compliments));
				$this->session->set_userdata(session_achivements, $this->Admin_model->get_access_permission($admin_id, access_achivements));
				$this->session->set_userdata(session_help, $this->Admin_model->get_access_permission($admin_id, access_help));
				$this->session->set_userdata(session_feedback, $this->Admin_model->get_access_permission($admin_id, access_feedback));
				$this->session->set_userdata(session_reports, $this->Admin_model->get_access_permission($admin_id, access_reports));

				$this->session->set_userdata(session_places, $this->Admin_model->get_access_permission($admin_id, access_places));
				$this->session->set_userdata(session_coupon, $this->Admin_model->get_access_permission($admin_id, access_coupon));
			}

			$this->load_header();
			$this->load_sidebar();
			$this->load->view(view_dashboard);
			$this->load_footer();
		} else {
			redirect(base_url());
		}
	}
	public function settings()
	{
		if ($this->is_user_logged_in()) {

			$this->init_admin_model();
			$this->load->view('inc/custom_js/ckeditor_js');

			$this->load_header();
			$this->load_sidebar();
			$this->load->view(view_settings);
			$this->load_footer();
			$this->load->view('inc/custom_js/splashData_js');
			$this->load->view('inc/custom_js/privacy_term_js');
		} else {
			redirect(base_url());
		}
	}

	public function feedback()
	{
		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_feedback);
			} else {
				$status = const_active;
			}

			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_feedback);
				$this->load_footer();
				$this->load->view('inc/custom_js/feedback_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function resolve_reports()
	{
		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_reports);
			} else {
				$status = const_active;
			}

			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_reports);
				$this->load_footer();
				$this->load->view('inc/custom_js/resolve_reports_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function unresolve_reports()
	{
		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_reports);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_unresolve_reports);
				$this->load_footer();
				$this->load->view('inc/custom_js/unresolve_reports_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function fare_management()
	{
		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_fare_management);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_fare_management);
				$this->load_footer();
				$this->load->view('inc/custom_js/fare_management_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_services()
	{

		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_service_ride);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_services);
				$this->load_footer();
				$this->load->view('inc/custom_js/services_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_help()
	{
		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_help);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('help');
				$this->load_footer();
				$this->load->view('inc/custom_js/help_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_driver_location()
	{
		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_driver_data);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('driver_location');
				$this->load_footer();
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}


	//////////////////////// sarathi ////////////////////////////////
	public function sarathi()
	{
		if ($this->is_user_logged_in()) {

			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_sarathi_data);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_sarathi);
				$this->load_footer();
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function get_sarathi()
	{
		$subfranchise_id = $this->input->post(param_subfranchise_id);
		$this->init_sarathi_model();
		$data = $this->Sarathi_model->get_sarathi_details($subfranchise_id);
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'sarathi found', 'data' => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'sarathi not found'], 200);
		}
	}

	public function fetch_subfranchise()
	{
		$franchise_id = $this->input->post('franchise_id');
		$this->init_sarathi_model();
		$subfranchise = $this->Sarathi_model->fetch_subfranchise($franchise_id);
		if (!empty($subfranchise)) {
			$this->response(['success' => true, 'message' => 'subfranchise found', 'data' => $subfranchise], 200);
		} else {
			$this->response(['success' => false, 'message' => 'subfranchise not found'], 200);
		}
	}

	public function add_sarathi()
	{

		$specific_id = $this->input->post('specific_id');

		$subfranchise_id = $this->input->post(param_subfranchise);
		$name = trim($this->input->post(param_name));
		$email = trim($this->input->post(param_email));
		$mobile = trim($this->input->post(param_mobile));
		// $password = md5(trim($this->input->post(param_mobile)));
		$permission_ids = $this->input->post('permission');
		$panel_lists_ids = $this->input->post('panel_list');


		$table = $this->input->post('table');
		if (!empty($table)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$this->insert_sarathi($mobile, $name, $email, $subfranchise_id, $permission_ids, $panel_lists_ids);
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$this->insert_sarathi($mobile, $name, $email, $subfranchise_id, $permission_ids, $panel_lists_ids);
		}
	}


	public function insert_sarathi($mobile, $name, $email, $subfranchise_id, $permission_ids, $panel_lists_ids)
	{
		$this->init_uid_server_model();
		$user_id = $this->Uid_server_model->generate_uid(KEY_USER);
		$sarathi_id = $this->Uid_server_model->generate_uid(KEY_SARATHI);
		$gid = $this->Uid_server_model->generate_uid(KEY_GID);

		$panel_acess_list = json_encode(implode(',', $panel_lists_ids));

		$panel_access = [
			field_uid => $this->Uid_server_model->generate_uid('PERMISSION'),
			field_user_id => $user_id,
			field_specific_level_user_id => $subfranchise_id,
			"permission" => $panel_acess_list,
			field_modified_at => date(field_date)
		];

		foreach ($permission_ids as $i => $permision) {
			$access[$i]['uid'] = $this->Uid_server_model->generate_uid('PERMISSION');
			$access[$i]['user_id'] = $user_id;
			$access[$i]['specific_id'] = $sarathi_id;
			$access[$i]['permission_id'] = $permision;
			$access[$i]['status'] = const_active;
		}

		if (strlen($mobile) != 10) {
			$this->response([key_success => false, key_message => "Mobile Number Must Contain 10 digits"], 200);
		} else {
			if (strlen($name) < 3) {
				$this->response([key_success => false, key_message => "Name should contain minimum 3 characters"], 200);
			} else {
				$this->init_common_model();
				$mobile_exist = $this->Common_model->is_this_value_exist($mobile, field_mobile, table_users);
				$email_exist = $this->Common_model->is_this_value_exist($email, field_email, table_users);
				if (!empty($mobile_exist)) {
					$this->response([key_success => false, key_message => "This Number already exist for " . $mobile_exist->name], 200);
					return;
				}
				if (!empty($email_exist)) {
					$this->response([key_success => false, key_message => "This Email already exist for " . $email_exist->name], 200);
					return;
				}
				$user_type_id = $this->Common_model->get_user_type_id_by_user_type_name(user_type_sarathi);
				$this->init_sarathi_model();
				$data = $this->Sarathi_model->add_sarathi_details($user_id, $sarathi_id, $gid, $user_type_id, $name, $email, $mobile, $subfranchise_id, $access, $panel_access);
				if ($data) {
					$this->response([key_success => true, key_message => "New Sarathi insert successfully.."], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to insert details"], 200);
				}
			}
		}
	}

	public function update_sarathi()
	{

		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		$user_id = $this->input->post(param_id);
		$name = trim($this->input->post(param_name));
		$email = trim($this->input->post(param_email));
		$mobile = trim($this->input->post(param_mobile));
		$permission_ids = $this->input->post(param_permission);

		$panel_ids = $this->input->post('panel_list');

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$this->mofify_sarathi($user_id, $name, $mobile, $email, $permission_ids, $panel_ids);
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$this->mofify_sarathi($user_id, $name, $mobile, $email, $permission_ids, $panel_ids);
		}
	}


	public function mofify_sarathi($user_id, $name, $mobile, $email, $permission_ids, $panel_ids)
	{

		$this->init_common_model();
		$this->init_admin_model();
		$this->init_sarathi_model();
		$this->init_uid_server_model();

		$array = [
			"modified_at" => date(field_date)
		];


		$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, table_sarathi);

		$panel_acess_list = json_encode(implode(',', $panel_ids));

		$exist=$this->Sarathi_model->userid_exists($user_id, field_user_id, table_panel_access_permissions);
		if($exist){
			$panel_access = [
				field_permission => $panel_acess_list,
				field_modified_at => date(field_date)
			];
		}
		else{
			$panel_access = [
				field_uid => $this->Uid_server_model->generate_uid('PERMISSION'),
				field_user_id => $user_id,
				field_specific_level_user_id => $specific_id,
				field_permission => $panel_acess_list,
				field_modified_at => date(field_date)
			];
		}
		

		foreach ($permission_ids as $i => $permision) {
			$access[$i]['uid'] = $this->Uid_server_model->generate_uid('PERMISSION');
			$access[$i]['user_id'] = $user_id;
			$access[$i]['specific_id'] = $specific_id;
			$access[$i]['permission_id'] = $permision;
			$access[$i]['status'] = const_active;
		}

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
				$update = $this->Sarathi_model->update_sarathi_details($user_id, $array, $access, $panel_access);
				if ($update) {
					$this->response([key_success => true, key_message => "Data updated successfully"], 200);
				} else {
					$this->response([key_success => false, key_message => "Something went wrong"], 200);
				}
			}
		}
	}



	public function delete_sarathi()
	{

		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$userid = $this->input->post(param_id);
				$this->init_sarathi_model();
				$delete = $this->Sarathi_model->delete_sarathi_details($userid);
				if ($delete) {
					$this->response([key_success => true, key_message => "Deleted this user successfully..."], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to delete this user ! "], 200);
				}
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$userid = $this->input->post(param_id);
			$this->init_sarathi_model();
			$delete = $this->Sarathi_model->delete_sarathi_details($userid);
			if ($delete) {
				$this->response([key_success => true, key_message => "Deleted this user successfully..."], 200);
			} else {
				$this->response([key_success => false, key_message => "Failed to delete this user ! "], 200);
			}
		}
	}

	public function deactive_sarathi()
	{
		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$userid = $this->input->post(param_id);
				$this->init_sarathi_model();
				$status = $this->Sarathi_model->deactive_sarathi_status($userid);
				if ($status) {
					$this->response([key_success => true, key_message => "Dectivate this user successfully..."], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to deactivate this user ! "], 200);
				}
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$userid = $this->input->post(param_id);
			$this->init_sarathi_model();
			$status = $this->Sarathi_model->deactive_sarathi_status($userid);
			if ($status) {
				$this->response([key_success => true, key_message => "Deactivate this user successfully..."], 200);
			} else {
				$this->response([key_success => false, key_message => "Failed to deactivate this user ! "], 200);
			}
		}
	}

	public function active_sarathi()
	{
		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$userid = $this->input->post(param_id);
				$this->init_sarathi_model();
				$active = $this->Sarathi_model->active_sarathi_status($userid);
				if ($active) {
					$this->response([key_success => true, key_message => "Activate this user successfully..."], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to activate this user ! "], 200);
				}
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$userid = $this->input->post(param_id);
			$this->init_sarathi_model();
			$active = $this->Sarathi_model->active_sarathi_status($userid);
			if ($active) {
				$this->response([key_success => true, key_message => "Activate this user successfully..."], 200);
			} else {
				$this->response([key_success => false, key_message => "Failed to deactivate this user ! "], 200);
			}
		}
	}
	////////////////////// driver start /////////////////////////////
	public function driver()
	{
		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_driver_data);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_driver);
				$this->load_footer();
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function load_only_driver_view()
	{
		if ($this->is_user_logged_in()) {
			$this->load_header();
			// $this->load->view(view_driver);
			$this->load_only_driver_view();
			$this->load_footer();
		} else {
			redirect(base_url());
		}
	}

	public function get_driver()
	{
		$this->init_driver_model();
		$sarathi_id = $this->input->post(param_id);
		$data = $this->Driver_model->get_driver_details($sarathi_id);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "driver found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Driver list is Empty"], 200);
		}
	}

	public function delete_driver()
	{
		$sarathi_id = $this->input->post('sarathi_id');
		if (!empty($sarathi_id)) {
			$this->init_login_model();
			$sarathi_user_id = $this->Login_model->get_user_id_by_sarathi_id($sarathi_id);
			$status = $this->Login_model->get_sarathi_status_by_user_id($sarathi_user_id);
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

		$user_id = $this->input->post(param_id);
		$name = trim($this->input->post(param_name));
		$email = trim($this->input->post(param_email));
		$mobile = trim($this->input->post(param_mobile));

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

	public function deactive_driver()
	{

		$sarathi_id = $this->input->post('sarathi_id');
		if (!empty($sarathi_id)) {
			$this->init_login_model();
			$sarathi_user_id = $this->Login_model->get_user_id_by_sarathi_id($sarathi_id);
			$status = $this->Login_model->get_sarathi_status_by_user_id($sarathi_user_id);
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

		$sarathi_id = $this->input->post('sarathi_id');
		if (!empty($sarathi_id)) {
			$this->init_login_model();
			$sarathi_user_id = $this->Login_model->get_user_id_by_sarathi_id($sarathi_id);
			$status = $this->Login_model->get_sarathi_status_by_user_id($sarathi_user_id);
			if ($status == const_active) {
				$user_id = $this->input->post(param_id);
				$this->init_driver_model();
				$active = $this->Driver_model->active_driver_status($user_id);
				if ($active) {
					$this->response(["success" => true, "message" => "User activated successfully "], 200);
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

	public function add_driver()
	{

		$this->init_uid_server_model();
		$user_id = $this->Uid_server_model->generate_uid(KEY_USER);
		$driver_id = $this->Uid_server_model->generate_uid(KEY_DRIVER);
		$name = $this->input->post(param_name);
		$email = $this->input->post(param_email);
		$mobile = $this->input->post(param_mobile);
		$this->init_common_model();
		$mobile_exist = $this->Common_model->is_this_value_exist($mobile, field_mobile, table_users);
		$email_exist = $this->Common_model->is_this_value_exist($email, field_email, table_users);
		if (!empty($mobile_exist)) {
			$this->response([key_success => false, key_message => "This Number already exist for " . $mobile_exist->name], 200);
			return;
		}
		if (!empty($email_exist)) {
			$this->response([key_success => false, key_message => "This Email already exist for " . $email_exist->name], 200);
			return;
		}
		$user_type_id = $this->Common_model->get_user_type_id_by_user_type_name(user_type_driver);
		$this->init_driver_model();
		$data = $this->Driver_model->add_driver_details($user_id, $driver_id, $name, $email, $mobile, $user_type_id);
		if ($data) {
			$this->response([key_success => true, key_message => "Data insert successfull"], 200);
		} else {
			$this->response([key_success => true, key_message => "Failed to insert data"], 200);
		}
	}
	////////////////// franchise start //////////////////////////////////////

	public function franchise()
	{
		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == "user_admin") {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_franchise_data);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_franchise);
				$this->load_footer();
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function get_franchise()
	{
		$this->init_franchise_model();
		$data = $this->Franchise_model->get_franchise_details();
		echo json_encode($data);
	}

	public function delete_franchise()
	{
		$uid = $this->input->post(field_id);
		$this->init_franchise_model();
		$delete = $this->Franchise_model->delete_franchise_details($uid);
		echo json_encode($delete);
	}

	public function update_franchise()
	{
		$user_id = $this->input->post(param_id);
		$name = trim($this->input->post(param_name));
		$email = trim($this->input->post(param_email));
		$mobile = trim($this->input->post(param_mobile));
		$permission_ids = $this->input->post(param_permission);
		$panel_ids = $this->input->post(param_panel_list);

		$panel_acess_list = json_encode(implode(',', $panel_ids));

		$panel_access = [
			field_permission => $panel_acess_list,
			field_modified_at => date(field_date)
		];

		$this->init_common_model();
		$this->init_admin_model();
		$this->init_uid_server_model();

		$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, table_franchise);

		foreach ($permission_ids as $i => $permision) {
			$access[$i]['uid'] = $this->Uid_server_model->generate_uid('PERMISSION');
			$access[$i]['user_id'] = $user_id;
			$access[$i]['specific_id'] = $specific_id;
			$access[$i]['permission_id'] = $permision;
			$access[$i]['status'] = const_active;
		}

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
				$this->init_franchise_model();
				$update = $this->Franchise_model->update_franchise_details($user_id, $array, $access, $panel_access);
				if ($update) {
					$this->response([key_success => true, key_message => "Data updated successfully"], 200);
				} else {
					$this->response([key_success => false, key_message => "Something went wrong"], 200);
				}
			}
		}
	}

	public function deactive_franchise()
	{
		$uid = $this->input->post(param_id);
		$this->init_franchise_model();
		$status = $this->Franchise_model->deactive_franchise_status($uid);
		echo json_encode($status);
	}

	public function active_franchise()
	{
		$userid = $this->input->post(param_id);
		$this->init_franchise_model();
		$status = $this->Franchise_model->active_franchise_status($userid);
		echo json_encode($status);
	}

	public function add_franchise()
	{

		$this->init_uid_server_model();
		$user_id = $this->Uid_server_model->generate_uid(KEY_USER);
		$franchise_id = $this->Uid_server_model->generate_uid(KEY_FRANCHISE);
		$gid = $this->Uid_server_model->generate_uid(KEY_GID);
		$name = trim($this->input->post(param_name));
		$email = trim($this->input->post(param_email));
		$mobile = trim($this->input->post(param_mobile));
		$password = md5(trim($this->input->post(param_mobile)));

		$permission_ids = $this->input->post('permission');

		$panel_lists_ids = $this->input->post('panel_list');

		$panel_acess_list = json_encode(implode(',', $panel_lists_ids));

		$panel_access = [
			field_uid => $this->Uid_server_model->generate_uid('PERMISSION'),
			field_user_id => $user_id,
			field_specific_level_user_id => $franchise_id,
			"permission" => $panel_acess_list,
			field_modified_at => date(field_date)
		];

		foreach ($permission_ids as $i => $permision) {
			$access[$i]['uid'] = $this->Uid_server_model->generate_uid('PERMISSION');
			$access[$i]['user_id'] = $user_id;
			$access[$i]['specific_id'] = $franchise_id;
			$access[$i]['permission_id'] = $permision;
			$access[$i]['status'] = const_active;
		}

		if (strlen($mobile) != 10) {
			$this->response([key_success => false, key_message => "Mobile Number Must Contain 10 digits"], 200);
		} else {
			if (strlen($name) < 3) {
				$this->response([key_success => false, key_message => "Name should contain minimum 3 characters"], 200);
			} else {
				$this->init_common_model();
				$mobile_exist = $this->Common_model->is_this_value_exist($mobile, field_mobile, table_users);
				$email_exist = $this->Common_model->is_this_value_exist($email, field_email, table_users);
				if (!empty($mobile_exist)) {
					$this->response([key_success => false, key_message => "This Number already exist for " . $mobile_exist->name], 200);
					return;
				}
				if (!empty($email_exist)) {
					$this->response([key_success => false, key_message => "This Email already exist for " . $email_exist->name], 200);
					return;
				}
				$user_type_id = $this->Common_model->get_user_type_id_by_user_type_name(user_type_franchise);
				$this->init_franchise_model();
				$data = $this->Franchise_model->add_franchise_details($user_id, $gid, $name, $email, $mobile, $user_type_id, $password, $franchise_id, $access, $panel_access);
				if ($data) {
					$this->response([key_success => true, key_message => "Data insert successfull"], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to insert data"], 200);
				}
			}
		}
	}
	///////////////////// sub_franchise ////////////////////////////////////////
	public function sub_franchise()
	{

		if ($this->is_user_logged_in()) {

			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_subfranchise_data);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_sub_franchise);
				$this->load_footer();
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function display_all_franchise()
	{
		$this->init_sub_franchise_model();
		$data = $this->Subfranchise_model->display_all_franchise();
		echo json_encode($data);
	}

	public function get_sub_franchise()
	{
		$franchise_id = $this->input->post(param_franchise_id);
		$this->init_sub_franchise_model();
		$data = $this->Subfranchise_model->get_sub_franchise_details($franchise_id);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => " sub franchise found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => " sub franchise not found"], 200);
		}
	}

	public function delete_sub_franchise()
	{

		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {

				$uid = $this->input->post(field_id);
				$this->init_sub_franchise_model();
				$delete = $this->Subfranchise_model->delete_sub_franchise_details($uid);
				if ($delete) {
					$this->response([key_success => true, key_message => "Deleted this data successfully.."], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to delete this data ! "], 200);
				}
			} else {
				$this->response(["success" => false, key_message => text_account_not_active], 200);
			}
		} else {
			$uid = $this->input->post(field_id);
			$this->init_sub_franchise_model();
			$delete = $this->Subfranchise_model->delete_sub_franchise_details($uid);
			if ($delete) {
				$this->response([key_success => true, key_message => "Deleted this data successfully.."], 200);
			} else {
				$this->response([key_success => false, key_message => "Failed to delete this data ! "], 200);
			}
		}
	}

	public function update_sub_franchise()
	{

		$franchise_id = $this->input->post(field_franchise_id);
		$table = $this->input->post('table');

		$user_id = $this->input->post(param_id);
		$name = trim($this->input->post(param_name));
		$email = trim($this->input->post(param_email));
		$mobile = trim($this->input->post(param_mobile));

		$permission_ids = $this->input->post(param_permission);
		$panel_ids = $this->input->post(param_panel_list);

		if (!empty($franchise_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($franchise_id, $table);
			if ($status == const_active) {
				$this->modify_subfranchise($user_id, $name, $mobile, $email, $permission_ids, $panel_ids);
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$this->modify_subfranchise($user_id, $name, $mobile, $email, $permission_ids, $panel_ids);
		}
	}

	private function modify_subfranchise($user_id, $name, $mobile, $email, $permission_ids, $panel_ids)
	{
		$array = [
			"modified_at" => date(field_date)
		];

		$this->init_common_model();
		$this->init_admin_model();
		$this->init_uid_server_model();

		$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, table_subfranchise);

		$panel_acess_list = json_encode(implode(',', $panel_ids));

		$panel_access = [
			field_permission => $panel_acess_list,
			field_modified_at => date(field_date)
		];

		foreach ($permission_ids as $i => $permision) {
			$access[$i]['uid'] = $this->Uid_server_model->generate_uid('PERMISSION');
			$access[$i]['user_id'] = $user_id;
			$access[$i]['specific_id'] = $specific_id;
			$access[$i]['permission_id'] = $permision;
			$access[$i]['status'] = const_active;
		}

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
				$this->init_sub_franchise_model();
				$update = $this->Subfranchise_model->update_sub_franchise_details($user_id, $array, $access, $panel_access);
				if ($update) {
					$this->response([key_success => true, key_message => "Data updated successfully"], 200);
				} else {
					$this->response([key_success => false, key_message => "No changes deducted"], 200);
				}
			}
		}
	}

	public function deactive_sub_franchise()
	{

		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$uid = $this->input->post(param_id);
				$this->init_sub_franchise_model();
				$deactive = $this->Subfranchise_model->deactive_sub_franchise_status($uid);
				if ($deactive) {
					$this->response([key_success => true, key_message => "Deactivate this user successfully..."], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to deactivate this user ! "], 200);
				}
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$uid = $this->input->post(param_id);
			$this->init_sub_franchise_model();
			$deactive = $this->Subfranchise_model->deactive_sub_franchise_status($uid);
			if ($deactive) {
				$this->response([key_success => true, key_message => "Deactivate this user successfully..."], 200);
			} else {
				$this->response([key_success => false, key_message => "Failed to deactivate this user ! "], 200);
			}
		}
	}

	public function active_sub_franchise()
	{

		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			// print_r($status);

			if ($status == const_active) {
				$uid = $this->input->post(param_id);
				$this->init_sub_franchise_model();
				$active = $this->Subfranchise_model->active_sub_franchise_status($uid);
				if ($active) {
					$this->response([key_success => true, key_message => "Activate this user successfully..."], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to activate this user ! "], 200);
				}
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$uid = $this->input->post(param_id);
			$this->init_sub_franchise_model();
			$active = $this->Subfranchise_model->active_sub_franchise_status($uid);
			if ($active) {
				$this->response([key_success => true, key_message => "Activate this user successfully..."], 200);
			} else {
				$this->response([key_success => false, key_message => "Failed to activate this user ! "], 200);
			}
		}
	}

	public function add_sub_franchise()
	{

		$franchise_id = $this->input->post(field_franchise_id);
		$name = trim($this->input->post(param_name));
		$email = trim($this->input->post(param_email));
		$mobile = trim($this->input->post(param_mobile));
		$password = md5(trim($this->input->post(param_mobile)));
		$permission_ids = $this->input->post(param_permission);
		$panel_lists_ids = $this->input->post(param_panel_list);

		$table = $this->input->post('table');
		if (!empty($table)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($franchise_id, $table);
			if ($status == const_active) {
				$this->insert_subfranchise_data($mobile, $name, $email, $password, $franchise_id, $permission_ids, $panel_lists_ids);
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$this->insert_subfranchise_data($mobile, $name, $email, $password, $franchise_id, $permission_ids, $panel_lists_ids);
		}
	}

	private function insert_subfranchise_data($mobile, $name, $email, $password, $franchise_id, $permission_ids, $panel_lists_ids)
	{
		$this->init_uid_server_model();
		$subfranchise_id = $this->Uid_server_model->generate_uid(KEY_SUBFRANCHISE);
		$user_id = $this->Uid_server_model->generate_uid(KEY_USER);
		$gid = $this->Uid_server_model->generate_uid(KEY_GID);

		$panel_acess_list = json_encode(implode(',', $panel_lists_ids));

		$panel_access = [
			field_uid => $this->Uid_server_model->generate_uid('PERMISSION'),
			field_user_id => $user_id,
			field_specific_level_user_id => $subfranchise_id,
			"permission" => $panel_acess_list,
			field_modified_at => date(field_date)
		];

		foreach ($permission_ids as $i => $permision) {
			$access[$i]['uid'] = $this->Uid_server_model->generate_uid('PERMISSION');
			$access[$i]['user_id'] = $user_id;
			$access[$i]['specific_id'] = $subfranchise_id;
			$access[$i]['permission_id'] = $permision;
			$access[$i]['status'] = const_active;
		}

		if (strlen($mobile) != 10) {
			$this->response([key_success => false, key_message => "Mobile Number Must Contain 10 digits"], 200);
		} else {
			if (strlen($name) < 3) {
				$this->response([key_success => false, key_message => "Name should contain minimum 3 characters"], 200);
			} else {
				$this->init_common_model();
				$mobile_exist = $this->Common_model->is_this_value_exist($mobile, field_mobile, table_users);
				$email_exist = $this->Common_model->is_this_value_exist($email, field_email, table_users);
				if (!empty($mobile_exist)) {
					$this->response([key_success => false, key_message => "This Number already exist for " . $mobile_exist->name], 200);
					return;
				}
				if (!empty($email_exist)) {
					$this->response([key_success => false, key_message => "This Email already exist for " . $email_exist->name], 200);
					return;
				}
				$user_type_id = $this->Common_model->get_user_type_id_by_user_type_name(user_type_sub_franchise);
				$this->init_sub_franchise_model();
				$data = $this->Subfranchise_model->add_sub_franchise_details($subfranchise_id, $user_id, $gid, $name, $email, $mobile, $user_type_id, $password, $franchise_id, $access, $panel_access);
				if ($data) {
					$this->response([key_success => true, key_message => "Data insert successfully"], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to insert data"], 200);
				}
			}
		}
	}





	/////////////////////////// customers ////////////////////////////////////////

	public function customers()
	{
		if ($this->is_user_logged_in()) {
			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_customers_data);
			} else {
				$status = const_active;
			}

			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view(view_customers);
				$this->load_footer();
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_call_booking()
	{

		if ($this->is_user_logged_in()) {

			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_call_booking);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('call_booking');
				$this->load_footer();
				$this->load->view('inc/custom_js/customer_call_booking_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function view_hotel()
	{

		if ($this->is_user_logged_in()) {

			if ($this->session->userdata(field_type_id) == const_user_admin) {
				$admin_id = $this->session->userdata(session_admin_specific_id);
				$this->init_admin_model();
				$status = $this->Admin_model->get_access_permission($admin_id, access_call_booking);
			} else {
				$status = const_active;
			}
			if ($status == const_active) {
				$this->load_header();
				$this->load_sidebar();
				$this->load->view('hotel');
				// $this->load->view('hotel_booking');
				$this->load_footer();
				// $this->load->view('inc/custom_js/hotel_js');
				// $this->load->view('inc/custom_js/hotel_booking_js');
			} else {
				redirect(base_url('administrator/dashboard'));
			}
		} else {
			redirect(base_url());
		}
	}

	public function get_customers_data()
	{
		$this->init_customer_model();
		$data = $this->Customers_model->get_customers_details();
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Customer List Not Found"], 200);
		}
	}

	public function delete_customers()
	{
		$uid = $this->input->post(param_id);
		$this->init_customer_model();
		$delete = $this->Customers_model->delete_customers_details($uid);
		echo json_encode($delete);
	}

	public function update_customers()
	{

		$userid = $this->input->post(param_id);
		$name = $this->input->post(param_name);
		$email = $this->input->post(param_email);
		$mobile = $this->input->post(param_mobile);
		$this->init_customer_model();
		$update = $this->Customers_model->update_customers_details($userid, $name, $email, $mobile);
		echo json_encode($update);
	}

	public function deactive_customers()
	{

		$uid = $this->input->post(param_id);
		$this->init_customer_model();
		$status = $this->Customers_model->deactive_customers_status($uid);
		echo json_encode($status);
	}

	public function active_customers()
	{

		$uid = $this->input->post(param_id);
		$this->init_customer_model();
		$status = $this->Customers_model->active_customers_status($uid);
		echo json_encode($status);
	}

	public function add_customers()
	{
		$this->init_uid_server_model();
		$uid = $this->Uid_server_model->generate_uid(KEY_USER);
		$customer_id = $this->Uid_server_model->generate_uid(KEY_CUSTOMER);
		$name = $this->input->post(param_name);
		$email = $this->input->post(param_email);
		$mobile = $this->input->post(param_mobile);
		$this->init_common_model();
		$mobile_exist = $this->Common_model->is_this_value_exist($mobile, field_mobile, table_users);
		$email_exist = $this->Common_model->is_this_value_exist($email, field_email, table_users);
		if (!empty($mobile_exist)) {
			$this->response([key_success => false, key_message => "This Number already exist for " . $mobile_exist->name], 200);
			return;
		}
		if (!empty($email_exist)) {
			$this->response([key_success => false, key_message => "This Email already exist for " . $email_exist->name], 200);
			return;
		}
		$user_type_id = $this->Common_model->get_user_type_id_by_user_type_name(user_type_customer);
		$this->init_customer_model();
		$data = $this->Customers_model->add_customers_details($uid, $customer_id, $name, $email, $mobile, $user_type_id);
		if ($data) {
			$this->response([key_success => true, key_message => "Data insert successfull"], 200);
		} else {
			$this->response([key_success => false, key_message => "Failed to insert data"], 200);
		}
	}

	public function get_current_datetime()
	{
		$date = date('Y-m-d');
		$this->response([key_success => true, key_message => "found", "date" => $date],  200);
	}

	public function get_ride_type()
	{
		$this->init_customer_model();
		$data = $this->Customers_model->get_ride_type();
		if (!empty($data)) {
			$this->response([key_success => true, key_message => "found", "data" => $data], 200);
		} else {
			$this->response([key_success => false, key_message => " Not Found "], 200);
		}
	}
	public function get_customer_by_booking_id()
	{
		$booking_id = $this->input->post('booking_id');
		if (!empty($booking_id)) {
			$this->init_customer_model();
			$data = $this->Customers_model->get_customer_by_booking_id($booking_id);
			if (!empty($data)) {
				$this->response([key_success => true, key_message => "successfull", "data" => $data], 200);
			} else {
				$this->response([key_success => false, key_message => "Customer Details Not Found "], 200);
			}
		} else {
			$this->response([key_success => false, key_message => "Enter Customer Code "], 200);
		}
	}

	//////////////////////////////////////////////////////////////

	// sarathi details 
	public function sarathi_details($user_id)
	{
		$this->init_sarathi_details_model();
		$data['sarathi_data'] = $this->Sarathi_details_model->get_all_sarathi_details($user_id);
		$sarathi_id = $this->Sarathi_details_model->get_sarathi_id_by_user_id($user_id);
		$this->session->set_userdata(session_sarathi_id, $sarathi_id);
		$data['driver_pending'] = $this->Sarathi_details_model->get_pending_driver_number($sarathi_id);
		$data['user_id']=$user_id;
		if ($this->is_user_logged_in()) {
			$this->load_header();
			$this->load_sidebar();
			$this->load->view(view_sarathi_details, $data);
			$this->load_footer();
		} else {
			redirect(base_url());
		}
	}

	public function is_value_exist()
	{
		$mobile = $this->input->post(param_mobile);
		$this->init_common_model();
		$mobile_exist = $this->Common_model->is_this_value_exist($mobile, field_mobile, table_users);
		if (!empty($mobile_exist)) {
			echo json_encode("This Number already exist for " . $mobile_exist->name);
		} else {
			echo json_encode("success");
		}
	}

	public function get_pending_drivers()
	{
		$sarathi = $this->input->post('id');
		if (empty($sarathi)) {
			$sarathi_id = $this->session->userdata(session_sarathi_id);
		} else {
			$sarathi_id = $sarathi;
		}
		$this->init_sarathi_details_model();
		$driver_detail = $this->Sarathi_details_model->get_pending_drivers($sarathi_id);
		if (!empty($driver_detail)) {
			$this->response([key_success => true, key_message => "Found", "data" => $driver_detail], 200);
		} else {
			$this->response([key_success => false, key_message => "Driver Not Found"], 200);
		}
	}
	public function show_pending_drivers($user_id){   // open pending driver doument page
		$this->init_sarathi_details_model();
		$user[field_user_id] = $user_id;
		$gid = $this->Sarathi_details_model->get_gid_by_user_id($user_id);
		$user['info'] = $this->Sarathi_details_model->get_name_by_user_id($user_id);
		$user['documents'] = $this->Sarathi_details_model->get_pending_driver_details($gid);
		
		if ($this->is_user_logged_in()) {
			$this->load_header();
			$this->load_sidebar();
			$this->load->view(view_pending_driver, $user);
			$this->load_footer();
		} else {
			redirect(base_url());
		}
	}
	public function show_driver_document($user_id)
	{
		$this->show_pending_drivers($user_id);
	}
	public function activate_pending_driver()
	{
		$user_id = $this->input->post(field_id);
		$this->init_sarathi_details_model();
		$active = $this->Sarathi_details_model->activate_pending_driver($user_id);
		if ($active) {
			$this->response(['success' => true, 'message' => 'Driver is Activated'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to Activate driver'], 200);
		}
	}
	public function approved_driver_documents()
	{
		$user_id = $this->input->post(param_id);	// driver's user_id
		$document_id = $this->input->post('document_id');
		$this->init_sarathi_details_model();
		$gid = $this->Sarathi_details_model->get_gid_by_user_id($user_id);
		$approved = $this->Sarathi_details_model->approved_driver_documents($gid, $document_id);
		if ($approved) {
			$this->response(['success' => true, 'message' => $document_id . ' is approved', 'document' => $document_id], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Something went wrong !'], 200);
		}
	}
	public function deny_driver_documents()
	{
		$user_id = $this->input->post(param_id);	// driver's user_id
		$document_id = $this->input->post('document_id');
		$this->init_sarathi_details_model();
		$gid = $this->Sarathi_details_model->get_gid_by_user_id($user_id);
		$deny = $this->Sarathi_details_model->deny_driver_documents($gid, $document_id);
		if ($deny) {
			$this->response(['success' => true, 'message' => $document_id . ' is Rejected', 'document' => $document_id], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Something went wrong !'], 200);
		}
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////
	public function getDashboardData()
	{
		$this->init_admin_model();
		$this->init_sarathi_model();
		$this->init_driver_model();
		$this->init_customer_model();
		$this->init_franchise_model();
		$this->init_sub_franchise_model();
		$specific_id = $this->input->post(param_id);	// sarathi specific id

		$data = [
			'totalSarathi' => $this->Sarathi_model->get_total_sarathi(),
			'drivers' => [
				'active' => $this->Driver_model->get_total_active_drivers($specific_id),
				'inactive' => $this->Driver_model->get_total_inactive_drivers($specific_id),
				'total' => $this->Driver_model->get_total_drivers($specific_id)
			],
			'totalCustomers' => $this->Customers_model->get_total_customers($specific_id),
			'totalFranchise' => $this->Franchise_model->get_total_franchise(),
			'totalSubFranchise' => $this->Subfranchise_model->get_total_sub_franchise(), // Franchise specific id
			'totalCarRunning' =>  $this->Driver_model->get_total_car_running($specific_id),
			'totalRevenue'=> $this->Admin_model->get_total_revenue($specific_id),
			'revenueStatus'=> $this->Admin_model->get_revenue_status($specific_id),
		];
		echo json_encode($data);
	}

	public function download_progress_report($specific_id){
		$this->init_admin_model();
		$this->init_sarathi_model();
		$this->init_driver_model();
		$this->init_customer_model();
		$this->init_franchise_model();
		$this->init_sub_franchise_model();
		$this->init_sarathi_details_model();


		$data = [
			'totalSarathi' => $this->Sarathi_model->get_total_sarathi(),
			'drivers' => [
				'active' => $this->Driver_model->get_total_active_drivers($specific_id),
				'inactive' => $this->Driver_model->get_total_inactive_drivers($specific_id),
				'total' => $this->Driver_model->get_total_drivers($specific_id)
			],
			'totalCustomers' => $this->Customers_model->get_total_customers($specific_id),
			'totalFranchise' => $this->Franchise_model->get_total_franchise(),
			'totalSubFranchise' => $this->Subfranchise_model->get_total_sub_franchise(), // Franchise specific id
			'totalCarRunning' =>  $this->Driver_model->get_total_car_running($specific_id),
			'totalRevenue'=> $this->Admin_model->get_total_revenue($specific_id),
			'revenueStatus'=> $this->Admin_model->get_revenue_status($specific_id),
			'totalKmPurchase'=> $this->Sarathi_details_model->total_km_purchase($specific_id),
			'driver_data' => $this->Driver_model->getdriverData($specific_id)


		];

		$name = 'progress_report_'.time();
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('progress_report', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($name.".pdf", "D");

		// $this->load_header();
        // $this->load_sidebar();
        // $this->load->view('progress_report', $data);
        // $this->load_footer();
	}

	public function getsarathiData()
	{
		$this->init_sarathi_model();
		$sarathiData = $this->Sarathi_model->getSarahiData();
		echo json_encode($sarathiData);
	}

	public function getdriverData()
	{
		$sarathi_id = $this->input->post(param_id);
		$this->init_driver_model();
		$driverData = $this->Driver_model->getdriverData($sarathi_id);
		echo json_encode($driverData);
	}

	////////////////////// splash data ////////////////////////////////////
	public function splash_data()
	{
		$this->init_admin_model();
		$splash_for = $this->input->post(param_for);	# sarathi | driver
		$splash = $this->Admin_model->splash_data($splash_for);
		if (!empty($splash)) {
			$this->response(['success' => true, 'message' => 'splash data found', 'data' => $splash], 200);
		} else {
			$this->response(['success' => false, 'message' => 'splash data not found'], 200);
		}
	}

	public function delete_splash_data()
	{
		$splash_id = $this->input->post(field_id);
		$this->init_admin_model();
		$delete = $this->Admin_model->delete_splash_data($splash_id);
		if ($delete) {
			$this->response(['success' => true, 'message' => 'splash data deleted successfully'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to delete this data'], 200);
		}
	}

	public function add_splash_data()
	{	// depriciated
		$this->init_uid_server_model();
		$splash_id = $this->Uid_server_model->generate_uid(KEY_SPLASH);
		$heading = $this->input->post(param_heading);
		$for = $this->input->post(param_for);
		$for_app = $this->input->post(param_for_app);
		$body = $this->input->post(param_body);
		$this->init_admin_model();
		$limit = $this->Admin_model->count_splash_limit($for_app);
		if ($limit < 3) {
			$added = $this->Admin_model->add_splash_data($splash_id, $heading, $for, $for_app, $body);
			if ($added) {
				$this->response(['success' => true, 'message' => 'splash data added successfully'], 200);
			} else {
				$this->response(['success' => false, 'message' => 'splash data add failed'], 200);
			}
		} else {
			$this->response(['success' => false, 'message' => 'Limit crossed to add splash data for this app'], 200);
		}
	}

	public function update_splash_data()
	{ // depriciated
		$path = "assets/images/splashData/";

		$splash_id = $this->input->post(param_id);
		$heading = $this->input->post(param_heading);
		$body = $this->input->post(param_body);
		$for = $this->input->post(param_for);
		$this->init_admin_model();
		$update = $this->Admin_model->update_splash_data($splash_id, $heading, $body, $for);
		if ($update) {
			$this->response(['success' => true, 'message' => 'splash data updated'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'No changes detuct'], 200);
		}
	}

	private function upload_user_image($path, $image)
	{
		$user_image_path = "";
		$filename_array = explode(".", $image[param_name]);
		$this->init_uid_server_model();
		$file_name = $this->Uid_server_model->generate_Uid(KEY_IMAGE);
		// $file_name = $image[param_name];
		$file_extension = end($filename_array);
		$file_save_path = $path . $file_name . "." . $file_extension;
		// $file_save_path = $path . $file_name;
		$file_upload_path = FCPATH . $file_save_path;
		if (move_uploaded_file($image['tmp_name'], $file_upload_path)) {
			$user_image_path = $file_save_path;
		}
		return $user_image_path;
	}

	public function display_feedback()
	{
		$this->init_admin_model();
		$specific_id = $this->input->post(param_specific_id);
		$feedback = $this->Admin_model->display_feedback($specific_id);
		if (!empty($feedback)) {
			$this->response(['success' => true, 'message' => 'feedback found', 'data' => $feedback], 200);
		} else {
			$this->response(['success' => false, 'message' => 'feedback not found'], 200);
		}
	}

	public function display_resolved_reports()
	{
		$rating = 3;
		$this->init_admin_model();
		$specific_id = $this->input->Post(param_specific_id);
		$reports = $this->Admin_model->display_resolved_reports($rating, $specific_id);
		if (!empty($reports)) {
			$this->response(['success' => true, 'message' => 'reports found', 'data' => $reports], 200);
		} else {
			$this->response(['success' => false, 'message' => 'reports not found'], 200);
		}
	}

	public function display_unresolved_reports()
	{
		$rating = 3;
		$this->init_admin_model();
		$specific_id = $this->input->Post(param_specific_id);
		$reports = $this->Admin_model->display_unresolve_reports($rating, $specific_id);
		if (!empty($reports)) {
			$this->response(['success' => true, 'message' => 'reports found', 'data' => $reports], 200);
		} else {
			$this->response(['success' => false, 'message' => 'reports not found'], 200);
		}
	}

	public function change_report_status()
	{
		$id = $this->input->post(param_id);
		$status_value = $this->input->post('value');
		$this->init_admin_model();
		$update = $this->Admin_model->change_report_status($id, $status_value);
		if ($update) {
			$this->response(['success' => true, 'message' => 'status updated'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Something went wrong'], 200);
		}
	}

	public function submit_report_comment()
	{
		$id = $this->input->post(param_id);
		$comment = $this->input->post(param_comment);
		$status = $this->input->post(param_status);
		// $table = $this->session->userdata(session_table);
		// $user_id = $this->session->userdata(field_user_id);
		$this->init_admin_model();

		$specific_id = $this->input->post(param_specific_id);
		if (empty($specific_id)) {
			$specific_id = $this->session->userdata(session_admin_specific_id);
		}

		$update = $this->Admin_model->submit_report_comment($id, $comment, $status, $specific_id);
		if ($update) {
			$this->response(['success' => true, 'message' => 'Comment send successfully..'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to send comment'], 200);
		}
	}

	// franchise details
	public function franchise_details($user_id)
	{
		$this->init_franchise_model();
		$data['franchise_data'] = $this->Franchise_model->franchise_details($user_id);
		$franchise_id = $this->Franchise_model->get_franchise_id_by_user_id($user_id);
		$data['user_id']=$user_id;
		$this->session->set_userdata(session_franchise_id, $franchise_id);
		if ($this->is_user_logged_in()) {
			$this->load_header();
			$this->load_sidebar();
			$this->load->view(view_franchise_details, $data);
			$this->load_footer();
		} else {
			redirect(base_url());
		}
	}

	// sub franchise details
	public function subfranchise_details($user_id)
	{
		$this->init_sub_franchise_model();
		$data['subfranchise_data'] = $this->Subfranchise_model->subfranchise_details($user_id);
		$data['user_id']=$user_id;
		$subfranchise_id = $this->Subfranchise_model->get_subfranchise_id_by_user_id($user_id);
		$this->session->set_userdata(session_subfranchise_id, $subfranchise_id);
		if ($this->is_user_logged_in()) {
			$this->load_header();
			$this->load_sidebar();
			$this->load->view(view_subfranchise_details, $data);
			$this->load_footer();
		} else {
			redirect(base_url());
		}
	}

	public function total_km_purchase(){	#----------sarathi panel
		$sarathi_id = $this->input->post(param_id);
		$this->init_sarathi_details_model();
		$km_purchase = $this->Sarathi_details_model->total_km_purchase($sarathi_id);
		if (!empty($km_purchase)) {
			$this->response(["success" => true, "message" => "km purchase found", "data" => $km_purchase], 200);
		} else {
			$this->response(["success" => false, "message" => "km purchase not found"], 200);
		}
	}
	////////////////////////////////////////////////////////////
	public function update_profile_image()
	{
		$path = 'assets/images/profile_image/';
		if (!empty($_FILES['image'][param_name])) {
			$image = $this->upload_user_image($path, $_FILES['image']);
		}
		if (!empty($image)) {
			$user_id = $this->session->userdata(field_user_id);
			$this->init_admin_model();
			$is_added = $this->Admin_model->save_profile_image($image, $user_id);
			if ($is_added) {
				$this->response(['success' => true, "message" => "image update success"], 200);
				$this->session->set_userdata(field_profile_image, $image);
			} else {
				$this->response(['success' => false, "message" => "No changes detucted",], 200);
			}
		} else {
			$this->response(['success' => false, "message" => "select an image"], 200);
		}
	}

	public function change_user_password(){

		$specific_id=$this->input->post(param_specific_id);
		$table=$this->input->post('table');

		$old_password = md5($this->input->post('old_password'));
		$new_password = md5($this->input->post('new_password'));


		$this->init_admin_model();
		if (!empty($old_password) && !empty($new_password)) {
			$match = $this->Admin_model->match_old_password($specific_id, $old_password, $table);
			if (!$match) {
				$this->response(["success" => false, "message" => "Old Password Not Matched ! "], 200);
			} else {
				$updated = $this->Admin_model->set_new_password($specific_id, $new_password, $table);
				if ($updated) {
					$this->response(["success" => true, "message" => "Password Changed Successfully !"], 200);
				} else {
					$this->response(["success" => true, "message" => "Something went wrong !"], 200);
				}
			}
		} else {
			$this->response(["success" => false, "message" => "Fill all credentials !"], 200);
		}
	}

	// date 01/11/22 moloy
	public function display_privacy_policy()
	{
		$this->init_admin_model();
		$for_app = $this->input->post('for');
		$data = $this->Admin_model->display_privacy_policy($for_app);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "data found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "data not found"], 200);
		}
	}


	public function display_fare_list()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_fare_list();
		if (!empty($data)) {
			$this->response([key_success => true, key_message => "found", "data" => $data], 200);
		} else {
			$this->response([key_success => false, key_message => "not found"], 200);
		}
	}

	public function update_fare_price()
	{
		$vehicle_id = $this->input->post('id');
		$data = json_decode($this->input->post('data'));
		if (!empty($vehicle_id) && !empty($data)) {
			$this->init_admin_model();
			$update = $this->Admin_model->update_fare_price($vehicle_id, $data);
			if ($update) {
				$this->response(['success' => true, "message" => "Data Updated Successfully"], 200);
			} else {
				$this->response(['success' => false, "message" => "No changes detucted"], 200);
			}
		} else {
			$this->response(['success' => false, "message" => "No changes detucted"], 200);
		}
	}

	public function display_documentation_content()
	{
		$this->init_admin_model();
		$for_app = $this->input->post('for');
		$data = $this->Admin_model->display_documentation_content($for_app);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "data found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "data not found", "for_app" => $data], 200);
		}
	}

	public function update_documentation_content()
	{
		$this->init_admin_model();
		$name = trim($this->input->post(param_name));
		$value = $this->input->post(param_value);
		$specific_id = $this->get_specific_user_id();
		if (!empty($name) && !empty($value)) {
			$update = $this->Admin_model->update_documentation_content($name, $value, $specific_id);
			if ($update) {
				$this->response(["success" => true, "message" => "Data updated successfully"], 200);
			} else {
				$this->response(["success" => false, "message" => "No changes deducted"], 200);
			}
		} else {
			$this->response(["success" => false, "message" => "Enter documentation details"], 200);
		}
	}


	public function display_user_address()
	{
		$mobile = $this->input->post('mobile');
		$this->init_admin_model();
		$gid = $this->Admin_model->get_gid_by_mobile($mobile);
		$data = $this->Admin_model->display_user_address($gid);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found"], 200);
		}
	}

	public function display_bank_details()
	{
		$user_id = $this->input->post(param_id);
		$this->init_admin_model();
		$gid = $this->Admin_model->get_gid_by_user_id($user_id);
		$data = $this->Admin_model->display_bank_details($gid);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found"], 200);
		}
	}
	///////////////// SERVICES /////////////////////////////////////////////
	public function display_service_name()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_service_name();
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found"], 200);
		}
	}

	public function display_ride_names()
	{
		$service_id = $this->input->post('id');
		$this->init_admin_model();
		$data = $this->Admin_model->display_ride_names($service_id);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found"], 200);
		}
	}
	public function display_cab_names()
	{
		$ride_id = $this->input->post('id');
		$this->init_admin_model();
		$data = $this->Admin_model->display_cab_names($ride_id);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found"], 200);
		}
	}
	public function add_service_type()
	{
		$table = $this->session->userdata(session_table);
		$user_id = $this->session->userdata(field_user_id);
		$service_name = $this->input->post('name');
		if (!empty($service_name)) {
			$service_id = UID_SERVICE_PREFIX . strtoupper(str_replace(" ", "_", trim($service_name)));
			$this->init_admin_model();
			$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, $table);  // administrator || admin (uid)
			$isAdded = $this->Admin_model->add_service_type($service_id, $service_name, $specific_id);
			if ($isAdded) {
				$this->response(["success" => true, "message" => "Service Added Successfully"], 200);
			} else {
				$this->response(["success" => false, "message" => "This Service Already Exist"], 200);
			}
		} else {
			$this->response(["success" => false, "message" => "Enter Service Name"], 200);
		}
	}

	private function upload_image($path, $image)
	{
		$user_image_path = "";
		$filename_array = explode(".", $image[param_name]);
		$this->init_uid_server_model();
		$file_name = $this->Uid_server_model->generate_Uid(KEY_IMAGE);
		// $file_name = $image[param_name];
		$file_extension = end($filename_array);
		$file_save_path = $path . $file_name . "." . $file_extension;
		// $file_save_path = $path . $file_name;
		$file_upload_path = FCPATH . $file_save_path;
		if (move_uploaded_file($image['tmp_name'], $file_upload_path)) {
			$user_image_path = $file_save_path;
		}
		return $user_image_path;
	}

	public function add_ride_type()
	{
		$path = 'assets/images/';
		if (!empty($_FILES['image'][param_name])) {
			$image = $this->upload_image($path, $_FILES['image']);
		}
		$table = $this->session->userdata(session_table);
		$user_id = $this->session->userdata(field_user_id);
		$service_id = $this->input->post('service');
		$ride_name = $this->input->post('name');
		$normal_rate = $this->input->post('rate_normal');
		$outstation_rate = $this->input->post('rate_outstation');
		if (empty($image) || empty($ride_name) || empty($normal_rate) || empty($outstation_rate) || empty($service_id)) {
			$this->response(["success" => false, "message" => "Fill all credentials"], 200);
		} else {
			$this->init_admin_model();
			$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, $table);  // administrator || admin (uid)
			$ride_id = 'ride_' . strtolower(str_replace(" ", "_", $ride_name));	// **
			$isAdded = $this->Admin_model->add_ride_type($ride_id, $service_id, $ride_name, $image, $normal_rate, $outstation_rate, $specific_id);
			if ($isAdded) {
				$this->response(["success" => true, "message" => "Ride added successfully"], 200);
			} else {
				$this->response(["success" => false, "message" => "Something went wrong"], 200);
			}
		}
	}
	public function add_cab_name()
	{
		$ride_id = $this->input->post('ride_id');
		$cab_name = $this->input->post('cab_name');
		if (!empty($cab_name) || !empty($ride_id)) {
			$this->init_uid_server_model();
			$uid = $this->Uid_server_model->generate_uid('VEHICLE');
			$this->init_admin_model();
			$isAdded = $this->Admin_model->add_cab_name($uid, $ride_id, $cab_name);
			if ($isAdded) {
				$this->response(["success" => true, "message" => "New Cab added successfully"], 200);
			} else {
				$this->response(["success" => false, "message" => "This cab is already registered"], 200);
			}
		} else {
			$this->response(["success" => false, "message" => "Enter all credentials"], 200);
		}
	}

	public function delete_service_type()
	{

		$id = trim($this->input->post(param_id));
		$table = trim($this->input->post('table'));

		if (empty($id) || empty($table)) {
			$this->response(["success" => false, "message" => "Select a record for delete"], 200);
		} else {
			$this->init_admin_model();
			if ($table == table_cabs_under_service_type) {
				$deleted = $this->Admin_model->delete_cab_type($id, $table);
			}
			if ($table == table_ride_service_type) {
				$deleted = $this->Admin_model->delete_ride_type($id, $table);
			}
			if ($table == table_services) {
				$deleted = $this->Admin_model->delete_service_type($id, $table);

				$rides = $this->Admin_model->get_ride_id_by_service_id($id);
				if (!empty($rides)) {
					foreach ($rides as  $ride) {
						$ride_id = $ride->uid;
						$this->Admin_model->delete_ride_type($ride_id, table_ride_service_type);
					}
				}
			}

			if ($deleted) {
				$this->response(["success" => true, "message" => "Data deleted successfully"], 200);
			} else {
				$this->response(["success" => false, "message" => "Something went wrong"], 200);
			}
		}
	}

	public function get_specific_id()
	{
		$table = $this->session->userdata(session_table);
		$user_id = $this->session->userdata(field_user_id);
		$this->init_admin_model();
		$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, $table);  // administrator || admin (uid)
		if (!empty($specific_id)) {
			$this->response(["success" => true, "message" => "found", "data" => $specific_id], 200);
		} else {
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}


	public function manage_helpline_number()
	{
		$this->init_admin_model();
		$data['sarathi'] = $this->Admin_model->get_sarathi_help_number();
		$data['driver'] = $this->Admin_model->get_driver_help_number();
		$data['customer'] = $this->Admin_model->get_customer_help_number();
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

	public function edit_helpline_number()
	{
		$this->init_admin_model();
		$specific_id = $this->get_specific_user_id();
		$type = $this->input->post('type');
		$number = $this->input->post('number');
		$update = $this->Admin_model->edit_helpline_number($type, $number, $specific_id);
		if ($update) {
			$this->response(["success" => true, "message" => "Help Line Number Update Successfully.. "], 200);
		} else {
			$this->response(["success" => true, "message" => "Somthing went wrong !!"], 200);
		}
	}

	public function display_help_list()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_help_model();
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Somthing went wrong !!"], 200);
		}
	}

	public function resolve_help()
	{

		$table = $this->session->userdata(session_table);
		$user_id = $this->session->userdata(field_user_id);
		$this->init_admin_model();
		$modified_by = $this->Admin_model->get_specific_id_by_uid($user_id, $table);  // administrator || admin (uid)

		$uid = $this->input->post('uid');
		$specific_id = $this->input->post('specific_id');
		$comment = $this->input->post('comment');

		$this->init_admin_model();
		$update = $this->Admin_model->resolve_help($uid, $specific_id, $comment, $modified_by);
		if ($update) {
			$this->response(["success" => true, "message" => "Reply send successfully"], 200);
		} else {
			$this->response(["success" => false, "message" => "Somthing went wrong !!"], 200);
		}
	}

	private function get_specific_user_id()
	{
		$table = $this->session->userdata(session_table);
		$user_id = $this->session->userdata(field_user_id);
		$this->init_admin_model();
		$specific_id = $this->Admin_model->get_specific_id_by_uid($user_id, $table);
		return $specific_id;
	}

	public function save_delivery_guideline()
	{

		$specific_id = $this->get_specific_user_id();
		$this->init_admin_model();
		$guide = $this->input->post('guide');
		$added = $this->Admin_model->save_delivery_guideline($guide, $specific_id);
		if ($added) {
			$this->response(["success" => true, "message" => "Guide line save successfully.."], 200);
		} else {
			$this->response(["success" => false, "message" => "Somthing went wrong !!"], 200);
		}
	}

	public function display_delivery_guideline()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_delivery_guideline();
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Guide line save successfully..", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Somthing went wrong !!"], 200);
		}
	}

	// public function generate_ride_history_pdf(){
	// 	// require_once(APPATH.'third_party/vendor/autoload.php');
	// 	$mpdf = new \Mpdf\Mpdf();

	// 	$this->load->view(view_ride_history);

	// 	$data=$this->load->view('ride_history',[],true);
	// 	$mpdf->WriteHTML($data);
	//     $mpdf->Output();
	// }

	public function display_incentives_scheme()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->get_incentives_scheme();
		if (!empty($data)) {
			$this->response([key_success => true, key_message => "Found..", "data" => $data], 200);
		} else {
			$this->response([key_success => false, key_message => "Not Found"], 200);
		}
	}

	public function display_incentives_time_list()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_incentives_time_list();
		if (!empty($data)) {
			$this->response([key_success => true, key_message => "Found..", "data" => $data], 200);
		} else {
			$this->response([key_success => false, key_message => "Not Found"], 200);
		}
	}

	public function update_incentive_scheme_details()
	{

		$scheme_id = $this->input->post('id');
		$value = $this->input->post('value');
		$time = $this->input->post('time');
		$amount = $this->input->post('amount');

		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		if (!empty($specific_id)) {
			$this->init_admin_model();
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$update = $this->Admin_model->update_incentive_scheme_details($scheme_id, $value, $time, $amount, $specific_id);
				if ($update) {
					$this->response([key_success => true, key_message => "Scheme Details Updated Successfully.."], 200);
				} else {
					$this->response([key_success => false, key_message => "No changes deducted"], 200);
				}
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$this->init_admin_model();
			$specific_id = $this->session->userdata(session_admin_specific_id);
			$update = $this->Admin_model->update_incentive_scheme_details($scheme_id, $value, $time, $amount, $specific_id);
			if ($update) {
				$this->response([key_success => true, key_message => "Scheme Details Updated Successfully.."], 200);
			} else {
				$this->response([key_success => false, key_message => "No changes deducted"], 200);
			}
		}
	}

	public function active_incentive_scheme()
	{
		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');
		$scheme_id = $this->input->post('id');
		if (!empty($specific_id)) {
			$this->init_admin_model();
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$update = $this->Admin_model->active_incentive_scheme($scheme_id, $specific_id);
				if ($update) {
					$this->response([key_success => true, key_message => "Scheme Activated Successfully.."], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to Activate Scheme"], 200);
				}
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$specific_id = $this->get_specific_user_id();
			$this->init_admin_model();
			$update = $this->Admin_model->active_incentive_scheme($scheme_id, $specific_id);
			if ($update) {
				$this->response([key_success => true, key_message => "Scheme Activated Successfully.."], 200);
			} else {
				$this->response([key_success => false, key_message => "Failed to Activate Scheme"], 200);
			}
		}
	}

	public function deactive_incentive_scheme()
	{

		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		$scheme_id = $this->input->post('id');
		if (!empty($specific_id)) {
			$this->init_admin_model();
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				$update = $this->Admin_model->deactive_incentive_scheme($scheme_id, $specific_id);
				if ($update) {
					$this->response([key_success => true, key_message => "Scheme Deactivated Successfully.."], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to Deactivate Scheme"], 200);
				}
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {
			$specific_id = $this->get_specific_user_id();
			$this->init_admin_model();
			$update = $this->Admin_model->deactive_incentive_scheme($scheme_id, $specific_id);
			if ($update) {
				$this->response([key_success => true, key_message => "Scheme Deactivated Successfully.."], 200);
			} else {
				$this->response([key_success => false, key_message => "Failed to Deactivate Scheme"], 200);
			}
		}
	}

	public function add_incentives_scheme()
	{
		$name = $this->input->post('name');
		$value = $this->input->Post('value');
		$timespan = $this->input->post('time');
		$amount = $this->input->post('amount');

		$specific_id = $this->input->post('specific_id');
		$table = $this->input->post('table');

		if (!empty($specific_id)) {
			$this->init_login_model();
			$status = $this->Login_model->get_user_status_by_specific_id($specific_id, $table);
			if ($status == const_active) {
				if (!empty($name) && !empty($value) && !empty($timespan) && $amount) {
					$this->init_uid_server_model();
					$scheme_id = $this->Uid_server_model->generate_uid(KEY_SCHEME);
					$this->init_admin_model();
					$insert = $this->Admin_model->add_incentives_scheme($scheme_id, $name, $value, $timespan, $amount, $specific_id);
					if ($insert) {
						$this->response([key_success => true, key_message => "Scheme Added Successfully.."], 200);
					} else {
						$this->response([key_success => false, key_message => "Failed to Add Scheme"], 200);
					}
				} else {
					$this->response([key_success => false, key_message => "Fill all credentials"], 200);
				}
			} else {
				$this->response([key_success => false, key_message => text_account_not_active], 200);
			}
		} else {

			$specific_id = $this->get_specific_user_id();
			if (!empty($name) && !empty($value) && !empty($timespan) && $amount) {
				$this->init_uid_server_model();
				$scheme_id = $this->Uid_server_model->generate_uid(KEY_SCHEME);
				$this->init_admin_model();
				$insert = $this->Admin_model->add_incentives_scheme($scheme_id, $name, $value, $timespan, $amount, $specific_id);
				if ($insert) {
					$this->response([key_success => true, key_message => "Scheme Added Successfully.."], 200);
				} else {
					$this->response([key_success => false, key_message => "Failed to Add Scheme"], 200);
				}
			} else {
				$this->response([key_success => false, key_message => "Fill all credentials"], 200);
			}
		}
	}

	public function delete_incentives_scheme()
	{
		$specific_id = $this->get_specific_user_id();
		$scheme_id = $this->input->post('id');
		$this->init_admin_model();
		$deleted = $this->Admin_model->delete_incentives_scheme($scheme_id, $specific_id);
		if ($deleted) {
			$this->response([key_success => true, key_message => "Incentive Scheme Deleted Successfully.."], 200);
		} else {
			$this->response([key_success => false, key_message => "Failed to delete Incentive Scheme.."], 200);
		}
	}

	public function display_driver_details($user_id)
	{
		if ($this->is_user_logged_in()) {
			$this->init_driver_model();
			$data['data'] = $this->Driver_model->display_driver_details($user_id);
			$this->load_header();
			$this->load_sidebar();
			$this->load->view('driver_details', $data);
			$this->load_footer();
		} else {
			redirect(base_url());
		}
	}

	public function active_incentive_permission()
	{

		$user_id = $this->input->post(param_id);
		$this->init_admin_model();
		$admin_id = $this->Admin_model->get_admin_id_by_user_id();
		if ($user_id) {
			$status = $this->Admin_model->active_incentive_permission($user_id);
			if ($status) {
				$this->response(['success' => true, 'message' => 'Incentive Permission Activated Successfully..'], 200);
			} else {
				$this->response(['success' => false, 'message' => 'Something went wrong'], 200);
			}
		}
	}

	public function deactive_incentive_permission()
	{
		$this->init_admin_model();
		$user_id = $this->input->post(param_id);
		$admin_id = $this->Admin_model->get_admin_id_by_user_id();
		$status = $this->Admin_model->deactive_incentive_permission($admin_id, $user_id);
		if ($status) {
			$this->response(['success' => true, 'message' => 'Incentive Permission Deactivated Successfully..'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Something went wrong'], 200);
		}
	}

	public function get_permission_list()
	{

		$user_type = $this->input->post('user_type');
		$this->init_admin_model();

		if ($user_type == user_type_franchise) {
			$data = $this->Admin_model->get_permission_list_franchise();
		} else {
			if ($user_type == 'sub_franchise') {
				$data = $this->Admin_model->get_permission_list_subfranchise();
			} else {
				if ($user_type == user_type_sarathi) {
					$data = $this->Admin_model->get_permission_list_sarathi();
				} else {
					$data = $this->Admin_model->get_permission_list();
				}
			}
		}

		if (!empty($data)) {
			$this->response(['success' => true, 'message' => $user_type, "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Not found'], 200);
		}
	}

	public function send_permission_request()
	{
		$this->init_uid_server_model();
		$uid = $this->Uid_server_model->generate_uid('PERMISSION');
		$permission_id = $this->input->post('id');

		// $admin_id = $this->session->userdata(session_admin_specific_id);
		// $user_id = $this->session->userdata(field_user_id);

		$specific_id = $this->input->post(param_specific_id);
		$user_id = $this->input->post(param_user_id);

		$this->init_admin_model();
		$exist = $this->Admin_model->is_user_request_exist($specific_id, $permission_id);
		if (!$exist) {
			$insert = $this->Admin_model->send_permission_request($uid, $permission_id, $user_id, $specific_id);
			if ($insert) {
				$this->response(['success' => true, 'message' => 'Request send successfully..'], 200);
			} else {
				$this->response(['success' => false, 'message' => 'Failed to send request'], 200);
			}
		} else {
			$this->response(['success' => false, 'message' => 'Request already present'], 200);
		}
	}

	public function get_permission_request_of_user()
	{
		// $admin_id = $this->session->userdata(session_admin_specific_id);
		$specific_id = $this->input->post('specific_id');
		$this->init_admin_model();
		$data = $this->Admin_model->get_permission_request_of_user($specific_id);
		if ($data) {
			$this->response(['success' => true, 'message' => 'found', "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'not found'], 200);
		}
	}

	public function get_user_request_permission()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->get_user_request_permission();
		if ($data) {
			$this->response(['success' => true, 'message' => 'found', "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'not found'], 200);
		}
	}

	public function allow_permission_request()
	{
		$user_id = $this->input->post('user_id');
		$request_id = $this->input->post('request_id');
		$this->init_admin_model();
		$data = $this->Admin_model->allow_permission_request($user_id, $request_id);
		if ($data) {
			$this->response(['success' => true, 'message' => 'Permission Granted'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Something went wrong'], 200);
		}
	}

	public function deny_permission_request()
	{
		$user_id = $this->input->post('user_id');
		$request_id = $this->input->post('request_id');
		$this->init_admin_model();
		$data = $this->Admin_model->deny_permission_request($user_id, $request_id);
		if ($data) {
			$this->response(['success' => true, 'message' => 'Permission Denied'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Something went wrong'], 200);
		}
	}

	public function display_rental_slabs()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_rental_slabs();
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'found', "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'not found'], 200);
		}
	}

	public function add_rental_slabs()
	{
		$hour = $this->input->post('hour');
		$km = $this->input->post('km');
		$this->init_uid_server_model();
		$uid = $this->Uid_server_model->generate_uid(KEY_RENTAL_SLAB);
		$this->init_admin_model();
		$insert = $this->Admin_model->add_rental_slabs($uid, $km, $hour);
		if ($insert) {
			$this->response(['success' => true, 'message' => 'Rental Slabs Added Successfully'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to add rental slab'], 200);
		}
	}

	public function active_slab_status()
	{
		$slab_id = $this->input->post('id');
		$this->init_admin_model();
		$update = $this->Admin_model->active_slab_status($slab_id);
		if ($update) {
			$this->response(['success' => true, 'message' => 'Activate Rental Slab Successfully'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to active rental slab'], 200);
		}
	}

	public function deactive_slab_status()
	{
		$slab_id = $this->input->post('id');
		$this->init_admin_model();
		$update = $this->Admin_model->deactive_slab_status($slab_id);
		if ($update) {
			$this->response(['success' => true, 'message' => 'Deactivate Rental Slab Successfully'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to deactive rental slab'], 200);
		}
	}

	public function delete_slab_status()
	{
		$slab_id = $this->input->post('id');
		$this->init_admin_model();
		$deleted = $this->Admin_model->delete_slab_status($slab_id);
		if ($deleted) {
			$this->response(['success' => true, 'message' => 'Delete Rental Slab Successfully'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to delete rental slab'], 200);
		}
	}

	public function update_rental_slab()
	{
		$slab_id = $this->input->post('id');
		$hour = $this->input->post('hour');
		$km = $this->input->post('km');
		$this->init_admin_model();
		$update = $this->Admin_model->update_rental_slab($slab_id, $hour, $km);
		if ($update) {
			$this->response(['success' => true, 'message' => 'Rental Slab Update Successfully'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to update rental slab'], 200);
		}
	}

	public function display_rental_features()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_rental_features();
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'found', "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'not found'], 200);
		}
	}

	public function get_cab_types_for_retail_details()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->get_cab_types_for_retail_details();
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'found', "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'not found'], 200);
		}
	}

	public function get_rental_features_for_retail_details()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->get_rental_features_for_retail_details();
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'found', "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'not found'], 200);
		}
	}

	public function delete_rental_features()
	{
		$id = $this->input->post(field_id);
		$this->init_admin_model();
		$data = $this->Admin_model->delete_rental_features($id);
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'Feature Deleted Successfully'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to delete feature'], 200);
		}
	}

	public function display_rental_details()
	{
		$ride_service_type_id = $this->input->post('ride_id');
		$this->init_admin_model();
		$data = $this->Admin_model->display_rental_details($ride_service_type_id);
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'found', "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'not found'], 200);
		}
	}

	public function get_rental_details()
	{
		$slab_id = $this->input->post('id');
		$ride_id = $this->input->post('ride_id');
		$this->init_admin_model();
		$data = $this->Admin_model->get_rental_details($slab_id, $ride_id);
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'found', "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'not found'], 200);
		}
	}

	public function save_rental_details()
	{
		$slab_id = $this->input->post('id');
		$ride_id = $this->input->post('ride_id');
		$amount = $this->input->post('amount');
		$km_fare = $this->input->post('km_fare');
		$time_fare = $this->input->post('time_fare');

		if (!empty($amount) && !empty($km_fare) && !empty($time_fare)) {
			$this->init_uid_server_model();
			$uid = $this->Uid_server_model->generate_uid('RM');
			$this->init_admin_model();
			$data = $this->Admin_model->save_rental_details($uid, $ride_id, $slab_id, $amount, $km_fare, $time_fare);
			if ($data) {
				$this->response(['success' => true, 'message' => 'Rental Details Added Successfully..'], 200);
			} else {
				$this->response(['success' => false, 'message' => 'Failed to add rental details'], 200);
			}
		} else {
			$this->response(['success' => false, 'message' => 'Fill all credentials'], 200);
		}
	}

	public function save_ride_features()
	{
		$feature_id = $this->input->post('id');
		$ride_id = $this->input->post('ride_id');

		$this->init_admin_model();
		$old_feature = $this->Admin_model->get_old_feature_data($ride_id);
		$new_feature = $feature_id . ',' . $old_feature;
		$data = $this->Admin_model->save_ride_features($new_feature, $ride_id);
		if ($data) {
			$this->response(['success' => true, 'message' => 'Features Added Successfully..'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to add features details'], 200);
		}
	}

	public function display_ride_feature_data()
	{
		$ride_id = $this->input->post('id');
		$this->init_admin_model();

		$feature = $this->Admin_model->get_old_feature_data($ride_id);

		$data = explode(",", $feature);
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'Features Added Successfully..', "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to add features details'], 200);
		}
	}

	public function delete_ride_features()
	{
		$feature_id = $this->input->post('id');
		$ride_id = $this->input->post('ride_id');
		$this->init_admin_model();

		$feature = $this->Admin_model->get_old_feature_data($ride_id);

		$data = explode(",", $feature);

		if (in_array($feature_id, $data)) {
			$index = array_search($feature_id, $data);
			unset($data[$index]);
		}

		$feature_data = implode(',', $data);

		$update = $this->Admin_model->save_ride_features($feature_data, $ride_id);
		if ($update) {
			$this->response(['success' => true, 'message' => 'Features Remove Successfully..'], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to remove features details'], 200);
		}
	}

	public function get_checked_slabs()
	{
		$ride_id = $this->input->post('id');
		$this->init_admin_model();
		$data = $this->Admin_model->get_checked_slabs($ride_id);
		if ($data) {
			$this->response(['success' => true, 'message' => 'Features Remove Successfully..', "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to remove features details'], 200);
		}
	}

	//// Compliments List Start //////

	public function display_compliments_list()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_compliments_list();
		if ($data) {
			$this->response(['success' => true,  "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Not found'], 200);
		}
	}

	public function delete_compliments()
	{
		$id = $this->input->post('id');
		$this->init_admin_model();
		$data = $this->Admin_model->delete_compliments($id);
		if ($data) {
			$this->response(['success' => true,  "message" => "Compliments Deleted Successfully.."], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to delete compliments'], 200);
		}
	}

	public function display_achievement_list()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_achievement_list();
		if ($data) {
			$this->response(['success' => true,  "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Not found'], 200);
		}
	}

	public function delete_achivements()
	{
		$id = $this->input->post('id');
		$this->init_admin_model();
		$data = $this->Admin_model->delete_achivements($id);
		if ($data) {
			$this->response(['success' => true,  "message" => "Achivement Deleted Successfully.."], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Failed to delete achivement'], 200);
		}
	}

	public function get_user_permission_access_list()
	{
		$this->init_admin_model();
		$user_id = $this->input->post('id');
		$user_type = $this->input->post('user_type');
		if ($user_type == user_type_franchise) {
			$data = $this->Admin_model->get_user_permission_access_list_franchise($user_id);
		} else {
			if ($user_type == 'sub_franchise') {
				$data = $this->Admin_model->get_user_permission_access_list_subfranchise($user_id);
			} else {
				if ($user_type == user_type_sarathi) {
					$data = $this->Admin_model->get_user_permission_access_list_sarathi($user_id);
				} else {
					$data = $this->Admin_model->get_user_permission_access_list($user_id);
				}
			}
		}
		if (!empty($data)) {
			$this->response(['success' => true,  "message" => $user_type, "data" => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Not Found'], 200);
		}
	}

	public function display_driver_location()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_driver_location();
		if (!empty($data)) {
			$this->response(['success' => true, 'message' => 'found', 'data' => $data], 200);
		} else {
			$this->response(['success' => false, 'message' => 'Driver Locations Not Found'], 200);
		}
	}

	public function add_coupon_data()
	{
		$specific_id = $this->session->userdata(session_admin_specific_id);

		$coupon_type = $this->input->post('coupon_type');
		$user_type = $this->input->post('user_type');
		$expired_at = $this->input->post('expired_at');
		$value = $this->input->post('value');
		$this->init_uid_server_model();

		$coupon_id = $this->Uid_server_model->generate_uid('COUPON');
		$coupon_code = $this->Uid_server_model->generate_coupon_code(10);


		$this->init_admin_model();
		$insert = $this->Admin_model->add_coupon_data($coupon_id, $coupon_code, $coupon_type, $value, $user_type, $expired_at, $specific_id);
		if ($insert) {
			$this->response(["success" => true, "message" => "Coupon Created SuccessFully"], 200);
		} else {
			$this->response(["success" => false, "message" => "Failed"], 200);
		}
	}

	public function get_coupon_details()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->get_coupon_details();
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

	public function active_coupon()
	{
		$uid = $this->input->post(param_id);
		$specific_id = $this->input->post(param_specific_id);
		$this->init_admin_model();
		$update = $this->Admin_model->active_coupon($uid, $specific_id);
		if ($update) {
			$this->response(["success" => true, "message" => "Coupon Activated Successfully"], 200);
		} else {
			$this->response(["success" => false, "message" => "Something went wrong"], 200);
		}
	}

	public function deactive_coupon()
	{
		$uid = $this->input->post(param_id);
		$specific_id = $this->input->post(param_specific_id);
		$this->init_admin_model();
		$update = $this->Admin_model->deactive_coupon($uid, $specific_id);
		if ($update) {
			$this->response(["success" => true, "message" => "Coupon Deactivated Successfully"], 200);
		} else {
			$this->response(["success" => false, "message" => "Something went wrong"], 200);
		}
	}
	public function delete_coupons()
	{
		$uid = $this->input->post(param_id);
		$this->init_admin_model();
		$update = $this->Admin_model->delete_coupons($uid);
		if ($update) {
			$this->response(["success" => true, "message" => "Coupon Deleted Successfully "], 200);
		} else {
			$this->response(["success" => false, "message" => "Something went wrong"], 200);
		}
	}

	public function update_coupon_details()
	{
		$specific_id = $this->input->post(param_specific_id);
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$for_user = $this->input->post('for_user');
		$value = $this->input->post('value');
		$expired_at = $this->input->post('expired_at');

		if (!empty($type) && !empty($for_user) && !empty($value) && !empty($expired_at)) {
			$this->init_admin_model();
			$update = $this->Admin_model->update_coupon_details($id, $type, $for_user, $value, $expired_at, $specific_id);
			if ($update) {
				$this->response(["success" => true, "message" => "Coupon Details Updated Successfully"], 200);
			} else {
				$this->response(["success" => false, "message" => "Something went wrong"], 200);
			}
		} else {
			$this->response(["success" => false, "message" => "Fill All Credentials"], 200);
		}
	}

	public function save_bank_details()
	{
		$account_number = $this->input->post("account_number");
		$ifsc = $this->input->post("ifsc");
		$bank_name = $this->input->post("bank_name");
		$branch = $this->input->post("branch");
		$user_id = $this->input->post("user_id");
		$this->init_uid_server_model();
		$uid = $this->Uid_server_model->generate_uid('BANK_DETAILS');
		$this->init_admin_model();
		if (!empty($account_number) && !empty($ifsc) && !empty($bank_name)) {
			$gid = $this->Admin_model->get_gid_by_user_id($user_id);
			$account_holder = $this->Admin_model->get_name_by_user_id($user_id);
			$user_exist = $this->Admin_model->check_gid_exists($gid);
			if (!$user_exist) {
				$insert = $this->Admin_model->insert_bank_details($uid, $gid, $account_holder, $account_number, $ifsc, $bank_name, $branch);
				if ($insert) {
					$this->response(["success" => true, "message" => "Bank Details Save successfully.."], 200);
				} else {
					$this->response(["success" => false, "message" => "Something went wrong"], 200);
				}
			} else {
				$update = $this->Admin_model->update_bank_details($gid, $account_number, $ifsc, $bank_name, $branch);
				if ($update) {
					$this->response(["success" => true, "message" => "Bank Details Save successfully.."], 200);
				} else {
					$this->response(["success" => false, "message" => "Something went wrong"], 200);
				}
			}
		} else {
			$this->response(["success" => false, "message" => "Fill all credentials"], 200);
		}
	}

	public function get_key_details()
	{
		$this->init_admin_model();
		$key = $this->input->post(param_key);
		$data = $this->Admin_model->get_key_details($key);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "found", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

	public function save_key_details()
	{
		$key = $this->input->post(param_key);
		$name = $this->input->post(param_name);
		$specific_id = $this->session->userdata(session_admin_specific_id);
		$this->init_admin_model();
		$update = $this->Admin_model->save_key_details($key, $name, $specific_id);
		if ($update) {
			$this->response(["success" => true, "message" => "Key Save successfully.."], 200);
		} else {
			$this->response(["success" => false, "message" => "Something went wrong"], 200);
		}
	}

	// panel access list

	public function get_panel_access_list()
	{
		$this->init_common_model();
		$user_id = $this->session->userdata(field_user_id);
		$data = $this->Common_model->get_panel_access_list($user_id);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found..", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found.."], 200);
		}
	}

	public function display_panel_access_list()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_panel_access_list();
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found..", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found.."], 200);
		}
	}


	//// ADD PLACES /////////////////

	public function display_country_name()
	{
		$this->init_admin_model();
		$data = $this->Admin_model->display_country_name();
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found..", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found.."], 200);
		}
	}

	public function display_state_names()
	{
		$country_id = $this->input->post(param_id);
		$this->init_admin_model();
		$data = $this->Admin_model->display_state_names($country_id);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found..", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found.."], 200);
		}
	}

	public function display_district_names()
	{
		$state_id = $this->input->post(param_id);
		$this->init_admin_model();
		$data = $this->Admin_model->display_district_names($state_id);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found..", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found.."], 200);
		}
	}

	public function display_city_names()
	{
		$district_id = $this->input->post(param_id);
		$this->init_admin_model();
		$data = $this->Admin_model->display_city_names($district_id);
		if (!empty($data)) {
			$this->response(["success" => true, "message" => "Found..", "data" => $data], 200);
		} else {
			$this->response(["success" => false, "message" => "Not Found.."], 200);
		}
	}

	public function add_place_name()
	{
		$name = $this->input->post(param_name);
		$parent_id = $this->input->post(param_id);
		$this->init_uid_server_model();
		$place = $this->input->post('place');
		if ($place == 'state') $uid = $this->Uid_server_model->generate_uid('STATE');
		if ($place == 'district') $uid = $this->Uid_server_model->generate_uid('DISTRICT');
		if ($place == 'city') $uid = $this->Uid_server_model->generate_uid('CITY');

		$this->init_admin_model();
		$insert = $this->Admin_model->add_state_name($uid, $name, $place, $parent_id);
		if (!empty($name)) {
			$exist = $this->Admin_model->check_if_name_exist($parent_id, $name);
			if ($exist) {
				if (($insert)) {
					$this->response(["success" => true, "message" => "Place Added Successfully.."], 200);
				} else {
					$this->response(["success" => false, "message" => "Soumthing went wrong"], 200);
				}
			} else {
				$this->response(["success" => false, "message" => "Place Already Exist"], 200);
			}
		} else {
			$this->response(["success" => false, "message" => "Enter Place Name"], 200);
		}
	}

	public function delete_place_names()
	{
		$place_id = $this->input->post(param_id);
		$this->init_admin_model();
		$delete = $this->Admin_model->delete_place_names($place_id);
		if ($delete) {
			$this->response(["success" => true, "message" => "Place Deleted Successfully.."], 200);
		} else {
			$this->response(["success" => false, "message" => "Something went wrong"], 200);
		}
	}

	public function get_place_name_by_id(){
		$id=$this->input->post(param_id);
		$this->init_admin_model();
		$data=$this->Admin_model->get_place_name_by_id($id);
		if(!empty($data)){
			$this->response(["success" => true, "message" => "found", "data"=>$data], 200);
		}
		else{
			$this->response(["success" => false, "message" => "not found"], 200);
		}

	}

	public function get_user_panel_access(){
		$user_id=$this->input->post(param_id);
		$this->init_common_model();
		$data=$this->Common_model->get_user_panel_access($user_id);
		if(!empty($data)){
			$this->response(["success" => true, "message" => "found", "data"=>$data], 200);
		}
		else{
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

	public function get_hotel_details(){
		$this->init_admin_model();
		$data=$this->Admin_model->get_hotel_details();
		if(!empty($data)){
			$this->response(["success" => true, "message" => "found", "data"=>$data], 200);
		}
		else{
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

	public function active_hotel(){
		$uid=$this->input->post(param_id);
		$this->init_admin_model();
		$status=$this->Admin_model->active_hotel($uid);
		if($status){
			$this->response(["success" => true, "message" => "Activated Successfully"], 200);
		}
		else{
			$this->response(["success" => false, "message" => "Something went wrong"], 200);
		}
	}

	public function deactive_hotel(){
		$uid=$this->input->post(param_id);
		$this->init_admin_model();
		$status=$this->Admin_model->deactive_hotel($uid);
		if($status){
			$this->response(["success" => true, "message" => "Deactivated Successfully"], 200);
		}
		else{
			$this->response(["success" => false, "message" => "Something went wrong"], 200);
		}
	}

	public function delete_hotel(){
		$uid=$this->input->post(param_id);
		$this->init_admin_model();
		$status=$this->Admin_model->delete_hotel($uid);
		if($status){
			$this->response(["success" => true, "message" => "Hotel Data Deleted Successfully"], 200);
		}
		else{
			$this->response(["success" => false, "message" => "Something went wrong"], 200);
		}
	}

	public function get_sarathi_ids(){
		$subfranchise_id=$this->input->post(param_id);
		$this->init_sarathi_model();
		$data=$this->Sarathi_model->get_sarathi_ids($subfranchise_id);
		if(!empty($data)){
			$this->response(["success" => true, "message" => "found", "data"=>$data], 200);
		}
		else{
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

	public function get_sarathi_details_by_user_id(){
		$user_id = $this->input->post(param_id);
		$this->init_sarathi_model();
		$data=$this->Sarathi_model->get_sarathi_details_by_user_id($user_id);
		if(!empty($data)){
			$this->response(["success" => true, "message" => "found", "data"=>$data], 200);
		}
		else{
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

	public function get_driver_ids_by_sarathi_id(){
		$sarathi_id=$this->input->post(param_id);
		$this->init_driver_model();
		$data=$this->Driver_model->get_driver_ids_by_sarathi_id($sarathi_id);
		if(!empty($data)){
			$this->response(["success" => true, "message" => "found", "data"=>$data], 200);
		}
		else{
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

	public function get_driver_details_by_user_id(){
		$user_id=$this->input->post(param_id);
		$this->init_driver_model();
		$data=$this->Driver_model->get_driver_details_by_user_id($user_id);
		if(!empty($data)){
			$this->response(["success" => true, "message" => "found", "data"=>$data], 200);
		}
		else{
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

	public function get_ride_type_details(){
		$ride_id=$this->input->post(param_id);
		$this->init_admin_model();
		$data=$this->Admin_model->get_ride_type_details($ride_id);
		if(!empty($data)){
			$this->response(["success" => true, "message" => "found", "data"=>$data], 200);
		}
		else{
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

	public function update_ride_details(){
		$ride_id=$this->input->post(param_id);
		$short_desc=$this->input->post('short');
		$long_desc=$this->input->post('long');
		$specific_id = $this->input->post(param_specific_id);
		$this->init_admin_model();
		$update=$this->Admin_model->update_ride_details($ride_id, $short_desc, $long_desc, $specific_id);
		if($update){
			$this->response(["success" => true, "message" => "Ride Description Updated Successfully"], 200);
		}
		else{
			$this->response(["success" => false, "message" => "Something went wrong"], 200);
		}
	}

	public function get_dormant_account_details(){
		$this->init_admin_model();
		$data=$this->Admin_model->get_dormant_account_details();
		if(!empty($data)){
			$this->response(["success" => true, "message" => "found", "data"=>$data], 200);
		}
		else{
			$this->response(["success" => false, "message" => "not found"], 200);
		}
	}

}
