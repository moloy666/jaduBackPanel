<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sarathi extends CI_Controller
{
    private function load_header($header_data = [], $header_link_data = [])
    {
        $this->load->view(sarathi_page_header_link, $header_link_data);
        $this->load->view(sarathi_page_header, $header_data);
    }

    private function load_sidebar($sidebar_data = [])
    {
        $this->load->view(sarathi_page_sidebar, $sidebar_data);
    }

    private function load_footer($footer_data = [], $footer_link_data = [])
    {
        $this->load->view(sarathi_page_footer, $footer_data);
        $this->load->view(sarathi_page_footer_link, $footer_link_data);
    }


    private function is_sarathi_logged_in()
    {
        // $user_id = $this->session->userdata(session_sarathi_user_id);
        // $this->init_login_model();
        // $status = $this->Login_model->get_sarathi_status_by_user_id($user_id);

        $logged_in = (!empty($this->session->userdata(session_sarathi_name))) ? true : false;
        return $logged_in;
    }

    private function is_sarathi_active()
    {
        $user_id = $this->session->userdata(session_sarathi_user_id);
        $this->init_login_model();
        $status = $this->Login_model->get_sarathi_status_by_user_id($user_id);

        $logged_in = (!empty($this->session->userdata(session_sarathi_name)) && $status == const_active) ? true : false;
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


    private function init_sarathi_model()
    {
        $this->load->model(model_sarathi);
    }

    // private function init_sub_Sarathi_model()
    // {
    //     $this->load->model(model_sub_Sarathi_model);
    // }

    // private function init_sarathi_model()
    // {
    //     $this->load->model('Sarathi/Sarathi_model');
    // }

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

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);
    }

    public function index()
    {
        if ($this->is_sarathi_logged_in()) {
            redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
        } else {
            $this->load->view(sarathi_page_header_link);
            $this->load->view(view_sarathi_login);
            $this->load->view(sarathi_page_footer_link);
        }
    }

    public function authenticate_sarathi()
    {

        $email = $this->input->post(param_email);
        $mobile = $this->input->post(param_mobile);

        $this->init_login_model();

        if (!empty($email) && !empty($mobile)) {

            $user_details = $this->Login_model->get_sarathi_details_on_condition($email, $mobile);

            if (!empty($user_details)) {


                $this->session->set_userdata(session_sarathi_name, $user_details->name);
                $this->session->set_userdata(session_sarathi_type_id, $user_details->type_id);
                $this->session->set_userdata(session_sarathi_user_id, $user_details->uid);
                $this->session->set_userdata(session_sarathi_profile_image, $user_details->profile_image);
                $this->session->set_userdata(session_sarathi_status, $user_details->status);

                $this->response([key_success => true, key_message => "User authentication successfull", key_redirect_to => base_url(WEB_PORTAL_SARATHI . '/dashboard')], 200);
            } else {
                $this->response([key_success => false, key_message => 'Invalid Login Details'], 200);
            }
        } else {
            $this->response([key_success => false, key_message => "Email or Password is not given!"], 400);
        }
    }

    public function logout()
    {

        $this->session->unset_userdata(session_sarathi_name);
        $this->session->unset_userdata(session_sarathi_type_id);
        $this->session->unset_userdata(session_sarathi_user_id);
        $this->session->unset_userdata(session_sarathi_profile_image);
        $this->session->unset_userdata(session_sarathi_status);

        $this->session->unset_userdata(sarathi_session_incentive);
        $this->session->unset_userdata(sarathi_session_call_booking);
        $this->session->unset_userdata(sarathi_session_ride_rental);
        $this->session->unset_userdata(sarathi_session_fare_list);
        $this->session->unset_userdata(sarathi_session_service_ride);
        $this->session->unset_userdata(sarathi_session_compliments);
        $this->session->unset_userdata(sarathi_session_achivements);
        $this->session->unset_userdata(sarathi_session_help);
        $this->session->unset_userdata(sarathi_session_feedback);
        $this->session->unset_userdata(sarathi_session_reports);

        redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
    }

    public function dashboard()
    {
        if ($this->is_sarathi_logged_in()) {
            $this->init_sarathi_model();
            $this->init_common_model();
            $user_id = $this->session->userdata(session_sarathi_user_id);
            // $this->session->set_userdata(sarathi_session_driver_data, $this->Admin_model->get_access_permission($user_id, access_driver_data));

            $this->session->set_userdata(sarathi_session_incentive, $this->Sarathi_model->get_access_permission($user_id, access_incentives_scheme));
            $this->session->set_userdata(sarathi_session_call_booking, $this->Sarathi_model->get_access_permission($user_id, access_call_booking));
            $this->session->set_userdata(sarathi_session_ride_rental, $this->Sarathi_model->get_access_permission($user_id, access_ride_rental));
            $this->session->set_userdata(sarathi_session_fare_list, $this->Sarathi_model->get_access_permission($user_id, access_fare_management));
            $this->session->set_userdata(sarathi_session_service_ride, $this->Sarathi_model->get_access_permission($user_id, access_service_ride));
            $this->session->set_userdata(sarathi_session_compliments, $this->Sarathi_model->get_access_permission($user_id, access_compliments));
            $this->session->set_userdata(sarathi_session_achivements, $this->Sarathi_model->get_access_permission($user_id, access_achivements));
            $this->session->set_userdata(sarathi_session_help, $this->Sarathi_model->get_access_permission($user_id, access_help));
            $this->session->set_userdata(sarathi_session_feedback, $this->Sarathi_model->get_access_permission($user_id, access_feedback));
            $this->session->set_userdata(sarathi_session_reports, $this->Sarathi_model->get_access_permission($user_id, access_reports));

            $this->session->set_userdata(sarathi_session_places, $this->Sarathi_model->get_access_permission($user_id, access_places));
            $this->session->set_userdata(sarathi_session_coupon, $this->Sarathi_model->get_access_permission($user_id, access_coupon));

            $this->session->set_userdata(session_sarathi_status, $this->Common_model->get_status_by_user_id($user_id));


            $this->init_sarathi_details_model();
            $data['sarathi_data'] = $this->Sarathi_details_model->get_all_sarathi_details($user_id);

            $this->load_header();
            $this->load_sidebar();
            $this->load->view(view_sarathi_dashboard, $data);
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/dashboard_js');
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function recharge()
    {
        if ($this->is_sarathi_logged_in()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_details_model();
            $data['sarathi_data'] = $this->Sarathi_details_model->get_all_sarathi_details($user_id);

            $this->load_header();
            $this->load_sidebar();
            $this->load->view(view_sarathi_recharge_history, $data);
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/recharge_js');
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }


    public function sarathi_details()
    {  //  sarathi/driver

        if ($this->is_sarathi_logged_in()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_details_model();
            $data['sarathi_data'] = $this->Sarathi_details_model->get_all_sarathi_details($user_id);
            $sarathi_id = $this->Sarathi_details_model->get_sarathi_id_by_user_id($user_id);
            $data['driver_pending'] = $this->Sarathi_details_model->get_pending_driver_number($sarathi_id);
            $data['total_km_purchased'] = $this->Sarathi_details_model->get_total_km_purchased($sarathi_id);

            $this->load_header();
            $this->load_sidebar();
            $this->load->view(view_sarathi_driver_details, $data);
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/driver_js');
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function show_pending_drivers($user_id)
    {   // open pending driver document page
        $this->init_sarathi_details_model();

        $user['user_id'] = $user_id;
        $user['info'] = $this->Sarathi_details_model->get_name_by_user_id($user_id);
        $gid = $this->Sarathi_details_model->get_gid_by_user_id($user_id);
        $user['documents'] = $this->Sarathi_details_model->get_pending_driver_details($gid);

        if ($this->is_sarathi_logged_in()) {
            $this->load_header();
            $this->load_sidebar();
            $this->load->view('sarathi/pending_drivers', $user);
            $this->load_footer();
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function driver_document($user_id)
    {
        $this->show_pending_drivers($user_id);
    }

    public function sarathi_profile()
    {
        if ($this->is_sarathi_logged_in()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $data['sarathi_id'] = $this->Sarathi_model->get_sarathi_id_by_user_id($user_id);
            $this->load_header();
            $this->load_sidebar();
            $this->load->view(view_sarathi_profile, $data);
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/sarathi_profile_js');
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function update_user_profile()
    {

        // $user_id = $this->input->post(param_id);
        $user_id = $this->session->userdata(session_sarathi_user_id);

        $name = $this->input->post(param_name);
        $dob = $this->input->post(param_dob);
        $gender = $this->input->post(param_gender);
        // $mobile = $this->input->post(param_mobile);
        // $email = $this->input->post(param_email);

        // !empty($mobile) && !empty($email) && 

        if (!empty($name) && !empty($dob) && !empty($gender)) {


            $this->init_sarathi_details_model();
            $update = $this->Sarathi_details_model->update_user_profile_details($user_id, $name, $dob, $gender);
            if ($update) {
                $this->response(["success" => true, "message" => "Update Successful"], 200);

                $this->session->set_userdata(session_sarathi_name, $name);
            } else {
                $this->response(["success" => false, "message" => "No changes detucted"], 200);
            }
        } else {
            $this->response(["success" => false, "message" => "Input All Fields"], 200);
        }
    }


    //	sarathi profile manage

    public function manage_sarathi_profile()
    {
        $user_id = $this->session->userdata(session_sarathi_user_id);
        $this->init_sarathi_details_model();
        $data = $this->Sarathi_details_model->get_sarathi_profile($user_id);
        if (!empty($data)) {
            $this->response(["success" => true, "message" => "sarathi details found", "data" => $data], 200);
        } else {
            $this->response(["success" => false, "message" => "sarathi details not found"], 200);
        }
    }

    public function view_sarathi_documents()
    {
        if ($this->is_sarathi_logged_in()) {
            $this->load_header();
            $this->load_sidebar();
            $this->load->view('sarathi/sarathi_documents');
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/sarathi_documents_js');
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));            //  sarathi_login
        }
    }

    public function display_sarathi_documents()
    {

        $user_id = $this->session->userdata(session_sarathi_user_id);
        $this->init_sarathi_details_model();
        $gid = $this->Sarathi_details_model->get_gid_by_user_id($user_id);
        $data = $this->Sarathi_details_model->get_pending_driver_details($gid);
        if (!empty($data)) {
            $this->response(["success" => true, "message" => "found", "user_id" => $user_id, "data" => $data], 200);
        } else {
            $this->response(["success" => false, "message" => "not found"], 200);
        }
    }

    public function driver_location()
    {
        if ($this->is_sarathi_logged_in()) {
            $this->load_header();
            $this->load_sidebar();
            $this->load->view('sarathi/driver_location');
            $this->load_footer();
            // $this->load->view('sarathi/inc/sarathi_custom_js/sarathi_documents_js');

        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));  //  sarathi_login
        }
    }

    public function display_driver_location()
    {
        $user_id = $this->session->userdata(session_sarathi_user_id);
        $this->init_sarathi_details_model();
        $sarathi_id = $this->Sarathi_details_model->get_sarathi_id_by_user_id($user_id);
        $location = $this->Sarathi_details_model->display_driver_location($sarathi_id);
        if (!empty($location)) {
            $this->response(["success" => true, "message" => "location found", "data" => $location], 200);
        } else {
            $this->response(["success" => false, "message" => "location not found"], 200);
        }
    }

    public function get_specific_id()
    {
        $user_id = $this->input->post('user_id');
        $this->init_sarathi_details_model();
        $data = $this->Sarathi_details_model->get_specific_id($user_id);
        if (!empty($data)) {
            $this->response(["success" => true, "message" => " found", "data" => $data], 200);
        } else {
            $this->response(["success" => false, "message" => " not found"], 200);
        }
    }

    public function get_sarathi_km_purchased()
    {
        $sarathi_id = $this->input->post('sarathi_id');
        $this->init_sarathi_details_model();
        $data = $this->Sarathi_details_model->get_total_km_purchased($sarathi_id);
        if (!empty($data)) {
            $this->response(["success" => true, "message" => " found", "data" => $data], 200);
        } else {
            $this->response(["success" => false, "message" => " not found"], 200);
        }
    }

    public function change_image_session()
    {
        $new_path = $this->input->post('path');
        $this->session->set_userdata(session_sarathi_profile_image, $new_path);
    }

    ///////////////////// SIDE PANEL ACCESS //////////////////////////////

    // public function view_customers()
    // {
    //     if ($this->is_sarathi_logged_in()) {
    //         $this->init_sarathi_model();
    //         $user_id = $this->session->userdata(session_sarathi_user_id);
    //         $sarathi_id = $this->Sarathi_model->get_sarathi_id_by_user_id($user_id);
    //         $driver_ids = $this->Sarathi_model->get_driver_ids($sarathi_id);
    //         foreach ($driver_ids as $i => $driver) {
    //             $driver_id = $driver[field_uid];
    //             $customer_ids_list = $this->Sarathi_model->get_customer_ids($driver_id);
    //             foreach ($customer_ids_list as $customer_id) {
    //                 $cid = $customer_id['customer_id'];
    //                 $customer[] = $this->Sarathi_model->get_customers_details($cid);
    //             }
    //         }
    //         $data['customer'] = $customer;

    //         // echo"<pre>";
    //         // print_r($data);die();

    //         $this->load_header();
    //         $this->load_sidebar();
    //         $this->load->view('sarathi/customers', $data);
    //         $this->load_footer();
    //     } else {
    //         redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
    //     }
    // }

    public function view_places()
    {
        if ($this->is_sarathi_active()) {

            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $this->init_sarathi_details_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_places);

            $data['specific_id'] = $this->Sarathi_model->get_sarathi_id_by_user_id($user_id);

            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/places', $data);
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/places_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }


    public function view_incentives()
    {
        if ($this->is_sarathi_active()) {

            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $this->init_sarathi_details_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_incentives_scheme);

            $data['specific_id'] = $this->Sarathi_model->get_sarathi_id_by_user_id($user_id);

            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/incentives', $data);
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/incentives_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_call_booking()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_call_booking);
            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/call_booking');
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/customer_call_booking_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_rental_slabs()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_ride_rental);
            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/rental_slabs');
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/rental_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_rental_features()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_ride_rental);
            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/rental_features');
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/rental_feature_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_rental_details()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_ride_rental);
            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/rental_details');
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/rental_details_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_fare_list()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_fare_management);
            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/fare_management');
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/fare_management_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_services()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_service_ride);
            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/services');
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/services_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_compliments()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_compliments);
            $data['specific_id'] = $this->Sarathi_model->get_sarathi_id_by_user_id($user_id);
            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/compliments', $data);
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/compliments_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_achivements()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_achivements);
            $data['specific_id'] = $this->Sarathi_model->get_sarathi_id_by_user_id($user_id);

            if ($status == const_active) {

                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/achievement', $data);
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/achievement_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_help()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_help);
            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/help');
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/help_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_feedback()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();

            $data['specific_id'] = $this->Sarathi_model->get_sarathi_id_by_user_id($user_id);

            $this->load_header();
            $this->load_sidebar();
            $this->load->view('sarathi/feedback', $data);
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/feedback_js');
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_resolve_reports()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_reports);
            $data['specific_id'] = $this->Sarathi_model->get_sarathi_id_by_user_id($user_id);

            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/reports', $data);
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/resolve_reports_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_unresolve_reports()
    {
        if ($this->is_sarathi_active()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_model();
            $status = $this->Sarathi_model->get_access_permission($user_id, access_reports);
            $data['specific_id'] = $this->Sarathi_model->get_sarathi_id_by_user_id($user_id);

            if ($status == const_active) {
                $this->load_header();
                $this->load_sidebar();
                $this->load->view('sarathi/unresolve_reports', $data);
                $this->load_footer();
                $this->load->view('sarathi/inc/sarathi_custom_js/unresolve_reports_js');
            } else {
                redirect(base_url(WEB_PORTAL_SARATHI . '/dashboard'));
            }
        } else {
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function view_driver_details($user_id)
    {
        if ($this->is_sarathi_active()) {
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
            redirect(base_url(WEB_PORTAL_SARATHI . '/index'));
        }
    }

    public function get_driver_data()
    {
        $sarathi_id = $this->input->post(param_id);
        $this->init_customer_model();
        $data = $this->Customers_model->get_driver_id_sarathi_id($sarathi_id);

        if (!empty($data)) {
            $this->response(["success" => true, "message" => "found", "data" => $data], 200);
        } else {
            $this->response(["success" => false, "message" => "not found", "data" => $data], 200);
        }
    }

    public function get_customer_data()
    {
        $driver_id = $this->input->post(param_id);
        $this->init_customer_model();
        $data = $this->Customers_model->get_customer_id_by_driver_id($driver_id);

        if (!empty($data)) {
            $this->response(["success" => true, "message" => "found", "data" => $data], 200);
        } else {
            $this->response(["success" => false, "message" => "not found"], 200);
        }
    }

    public function get_customer_details()
    {
        $customer_id = $this->input->post(param_id);
        $this->init_customer_model();
        $data = $this->Customers_model->get_customer_details($customer_id);
        if (!empty($data)) {
            $this->response(["success" => true, "message" => "found", "data" => $data], 200);
        } else {
            $this->response(["success" => false, "message" => "not found"], 200);
        }
    }

    public function get_panel_access_list()
    {
        $this->init_common_model();
        $user_id = $this->session->userdata(session_sarathi_user_id);
        $data = $this->Common_model->get_panel_access_list($user_id);
        if (!empty($data)) {
            $this->response(["success" => true, "message" => "Found..", "data" => $data], 200);
        } else {
            $this->response(["success" => false, "message" => "Not Found.."], 200);
        }
    }

    public function download_recharge_history()
    {
        $user_id = $this->session->userdata(session_sarathi_user_id);
        $this->init_sarathi_model();
        $data['sarathi'] = $this->Sarathi_model->get_user_name_by_id($user_id);
        $data['sarathi_data'] = $this->Sarathi_model->get_recharge_histiry_of_sarathi($user_id);

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
}
