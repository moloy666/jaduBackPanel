<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Hotel extends CI_Controller
{
    private function load_header($header_data = [], $header_link_data = [])
    {
        $this->load->view(hotel_page_header_link, $header_link_data);
        $this->load->view(hotel_page_header, $header_data);
    }
    private function load_sidebar($sidebar_data = [])
    {
        $this->load->view(hotel_page_sidebar, $sidebar_data);
    }
    private function load_footer($footer_data = [], $footer_link_data = [])
    {
        $this->load->view(hotel_page_footer, $footer_data);
        $this->load->view(hotel_page_footer_link, $footer_link_data);
    }

    private function init_login_model()
    {
        $this->load->model(model_login);
    }

    private function init_uid_server_model()
    {
        $this->load->model(model_uid_server);
    }

    private function init_hotel_model()
    {
        $this->load->model(model_hotel);
    }

    private function response($data, $status)
    {
        return $this->output->set_content_type("application/json")
            ->set_status_header($status)
            ->set_output(json_encode($data));
    }


    private function is_user_logged_in()
    {
        $logged_in = (!empty($this->session->userdata(session_hotel_name))) ? true : false;
        return $logged_in;
    }


    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);
    }

    /////////////// VIEW STARTS //////////////////////////

    public function index(){

        if ($this->is_user_logged_in()) {
            redirect(base_url('hotel/dashboard'));
        } else {
            $this->load->view(hotel_page_header_link);
            $this->load->view('hotel/login');
            $this->load->view(hotel_page_footer_link);
        }
    }

    public function view_register(){

        if ($this->is_user_logged_in()) {
            redirect(base_url('hotel/dashboard'));
        } else {
            $this->load->view(hotel_page_header_link);
            $this->load->view('hotel/register');
            $this->load->view(hotel_page_footer_link);
            $this->load->view('hotel/inc/hotel_custom_js/register_js');
        }
    }

    public function view_dashboard(){

        if($this->is_user_logged_in()){
            $this->load_header();
            $this->load_sidebar();
            $this->load->view('hotel/dashboard');
            $this->load_footer();
        }
        else{
            redirect(base_url('hotel'));
        }
    }

    public function view_customer_booking(){

        if($this->is_user_logged_in()){
            $this->load_header();
            $this->load_sidebar();
            $this->load->view('hotel/call_booking');
            $this->load_footer();
            $this->load->view('hotel/inc/hotel_custom_js/customer_call_booking_js');
        }
        else{
            redirect(base_url('hotel'));
        }
    }

    public function view_profile(){

        if($this->is_user_logged_in()){
            $this->load_header();
            $this->load_sidebar();
            $this->load->view('hotel/profile');
            $this->load_footer();
            $this->load->view('hotel/inc/hotel_custom_js/profile_js');
        }
        else{
            redirect(base_url('hotel'));
        }
    }

    /////////// View End //////////////////////////

    public function register_details(){

        $name = $this->input->post(param_name);
        $email = $this->input->post(param_email);
        $mobile = $this->input->post(param_mobile);
        $pincode = $this->input->post('pincode');
        $location = $this->input->post('location');
        $district = $this->input->post('district');
        $state = $this->input->post('state');
        $password = md5($this->input->post(param_mobile));

        if (!empty($name) && !empty($email) && !empty($mobile) && !empty($location) && !empty($pincode) && !empty($district) && !empty($state)) {
           
            if(strlen($name) < 3){
                $this->response(["success" => false, "message" => "Name Atleast Contain 3 Letters"], 200);
                return;
            }

            if(strlen($mobile) != 10){
                $this->response(["success" => false, "message" => "Mobile Number Must Contain 10 Digits"], 200);
                return;
            }

            if(strlen($pincode) != 6){
                $this->response(["success" => false, "message" => "Pincode Must Contain 6 Digits"], 200);
                return;
            }
 
            $this->init_hotel_model();
            $email_exist=$this->Hotel_model->check_value_exist($email, field_email);
            $mobile_exist=$this->Hotel_model->check_value_exist($mobile, field_mobile);

            if($email_exist){
                $this->response(["success" => false, "message" => "This Email Is Already Present With Another Hotel"], 200);
                return;
            }

            if($mobile_exist){
                $this->response(["success" => false, "message" => "This Mobile Is Already Present With Another Hotel"], 200);
                return;
            }
            
            $this->init_uid_server_model();
            $uid = $this->Uid_server_model->generate_uid(KEY_HOTEL);
            $insert = $this->Hotel_model->register_basic_details($uid, $name, $email, $mobile, $location, $district, $state, $pincode, $password);
            if ($insert) {
                $this->response(["success" => true, "message" => "Hotel Details Saved Successfully", "redirect" => base_url('hotel')], 200);
            } else {
                $this->response(["success" => false, "message" => "Failed to register details"], 200);
            }
        } else {
            $this->response(["success" => false, "message" => "Fill all credentials"], 200);
        }
    }

    public function authenticate_hotel(){

        $email = $this->input->post(param_email);
        $password = md5($this->input->post(param_password));

        $this->init_hotel_model();
        if (!empty($email) && !empty($password)) {
            $data = $this->Hotel_model->get_hotel_details_on_condition($email, $password);

            if (!empty($data)) {
                $this->session->set_userdata(session_hotel_name, $data['name']);
                $this->session->set_userdata(session_hotel_image, $data['image_path']);
                $this->session->set_userdata(session_hotel_id, $data['uid']);
                $this->session->set_userdata(session_hotel_mobile, $data['mobile']);

                $this->response([key_success => true, key_message => "authentication successfull", key_redirect_to => base_url('hotel/dashboard')], 200);
            } else {
                $this->response([key_success => false, key_message => "Invaild Email or Password!"], 200);
            }
        } else {
            $this->response([key_success => false, key_message => "Email or Password is not given!"], 200);
        }
    }

    public function logout(){

        $this->session->unset_userdata(session_hotel_name);
        $this->session->unset_userdata(session_hotel_image);
        $this->session->unset_userdata(session_hotel_id);
        $this->session->unset_userdata(session_hotel_mobile);

        redirect(base_url('hotel'));
    }

    public function get_profile_details(){
        $this->init_hotel_model();
        $hotel_id=$this->session->userdata(session_hotel_id);
        $data=$this->Hotel_model->get_profile_details($hotel_id);
        if(!empty($data)){
            $this->response(["success" => true, "message" => "found", "data"=>$data], 200);
        }
        else{
            $this->response(["success" => true, "message" => "Not Found"], 200);
        }
    }

  
}
