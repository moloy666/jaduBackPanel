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

    private function is_user_logged_in()
    {
        $logged_in = (!empty($this->session->userdata(session_sarathi_name))) ? true : false;
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

    private function init_sub_franchise_model()
    {
        $this->load->model(model_sub_franchise_model);
    }

    private function init_sarathi_model()
    {
        $this->load->model('Sarathi/Sarathi_model');
    }

    private function init_sarathi_details_model()
    {
        $this->load->model(model_sarathi_details);
    }

    private function init_driver_model()
    {
        $this->load->model(model_driver);
    }

    private function init_customer_model(){
        $this->load->model(model_customers_model);
    }


    private function response($data, $status){
        return $this->output->set_content_type("application/json")
            ->set_status_header($status)
            ->set_output(json_encode($data));
    }

    public function __construct(){
        parent::__construct();
        date_default_timezone_set(field_location);
    }

    public function index(){
        if ($this->is_user_logged_in()) {
            redirect(base_url(WEB_PORTAL_SARATHI.'/dashboard'));
        } else {
            $this->load->view(sarathi_page_header_link);
            $this->load->view(view_sarathi_login);
            $this->load->view(sarathi_page_footer_link);
        }
    }

    public function authenticate_sarathi(){

        $email = $this->input->post(param_email);
        $mobile =$this->input->post(param_mobile);

        $this->init_login_model();

        if (!empty($email) && !empty($mobile)) {

            $user_details = $this->Login_model->get_sarathi_details_on_condition($email, $mobile);

            if (!empty($user_details)) {

                $this->session->set_userdata(session_sarathi_login_status, 'sarathi_logged_in');

                $this->session->set_userdata(session_sarathi_name, $user_details->name);
                $this->session->set_userdata(session_sarathi_type_id, $user_details->type_id);
                $this->session->set_userdata(session_sarathi_user_id, $user_details->uid);
                $this->session->set_userdata(session_sarathi_profile_image, $user_details->profile_image);

                $this->response([key_success => true, key_message => "User authentication successfull", key_redirect_to => base_url(WEB_PORTAL_SARATHI.'/dashboard')], 200);
            } else {
                $this->response([key_success => false, key_message => 'Invalid Login Details'], 200);
            }
        } else {
            $this->response([key_success => false, key_message => "Email or Password is not given!"], 400);
        }
    }

    public function logout(){
        			
        $this->session->unset_userdata(session_sarathi_name);
		$this->session->unset_userdata(session_sarathi_type_id);
        $this->session->unset_userdata(session_sarathi_user_id);
		$this->session->unset_userdata(session_sarathi_profile_image);

		$this->session->unset_userdata(session_sarathi_login_status);

		redirect(base_url(WEB_PORTAL_SARATHI.'/index'));
	}

    public function dashboard(){
        if ($this->is_user_logged_in()) {
            $user_id=$this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_details_model();
            $data['sarathi_data'] = $this->Sarathi_details_model->get_all_sarathi_details($user_id);
           
  
            $this->load_header();
            $this->load_sidebar();
            $this->load->view(view_sarathi_dashboard, $data);
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/dashboard_js');
        } else {
            redirect(base_url());
        }
    }

    public function recharge(){
        if ($this->is_user_logged_in()) {
            $user_id=$this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_details_model();
            $data['sarathi_data'] = $this->Sarathi_details_model->get_all_sarathi_details($user_id);
           
            $this->load_header();
            $this->load_sidebar();
            $this->load->view(view_sarathi_recharge_history, $data);
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/recharge_js');
        } else {
            redirect(base_url());
        }
    }


    public function sarathi_details(){  //  sarathi/driver
        if ($this->is_user_logged_in()) {
            $user_id = $this->session->userdata(session_sarathi_user_id);
            $this->init_sarathi_details_model();
            $data['sarathi_data'] = $this->Sarathi_details_model->get_all_sarathi_details($user_id);
            $sarathi_id=$this->Sarathi_details_model->get_sarathi_id_by_user_id($user_id);
            $data['driver_pending']=$this->Sarathi_details_model->get_pending_driver_number($sarathi_id);
            $data['total_km_purchased']=$this->Sarathi_details_model->get_total_km_purchased($sarathi_id);

            $this->load_header();
            $this->load_sidebar();
            $this->load->view(view_sarathi_driver_details, $data);
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/driver_js');
        } else {
            redirect(base_url());
        }
    }

    public function show_pending_drivers($user_id){   // open pending driver document page
		$this->init_sarathi_details_model();
		$user['user_id'] = $user_id;
        $user['info']=$this->Sarathi_details_model->get_name_by_user_id($user_id);
		$gid = $this->Sarathi_details_model->get_gid_by_user_id($user_id);
		$user['documents'] = $this->Sarathi_details_model->get_pending_driver_details($gid);

        // echo"<pre>";
		// print_r($user);

		if ($this->is_user_logged_in()) {
			$this->load_header();
			$this->load_sidebar();
			$this->load->view('sarathi/pending_drivers', $user);
			$this->load_footer();
		} else {
			redirect(base_url());
		}

	}

    public function driver_document($user_id){
		$this->show_pending_drivers($user_id);
	}

    public function sarathi_profile(){
        if ($this->is_user_logged_in()) {


            $this->load_header();
			$this->load_sidebar();
			$this->load->view(view_sarathi_profile);
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/sarathi_profile_js');
			
		} else {
			redirect(base_url());   //  sarathi_login
		}
    }

    public function update_user_profile(){

		// $user_id = $this->input->post(param_id);
		$user_id = $this->session->userdata(session_sarathi_user_id);

		$name = $this->input->post(param_name);
		$mobile = $this->input->post(param_mobile);
		$email = $this->input->post(param_email);
		$dob = $this->input->post(param_dob);
		$gender = $this->input->post(param_gender);

		if(!empty($name) && !empty($mobile) && !empty($email) && !empty($dob) && !empty($gender)){

			
			$this->init_sarathi_details_model();
			$update = $this->Sarathi_details_model->update_user_profile_details($user_id, $name, $email, $mobile, $dob, $gender);
			if($update){
				$this->response(["success"=>true, "message"=>"Update Successful"], 200);
				
				$this->session->set_userdata(session_sarathi_name, $name);
				
			}
			else{
				$this->response(["success"=>false, "message"=>"No changes detucted"], 200);
			}
		}
		else{
			$this->response(["success"=>false, "message"=>"Input All Fields"], 200);
		}
	}


    //	sarathi profile manage

	public function manage_sarathi_profile(){
        $user_id=$this->session->userdata(session_sarathi_user_id);
        $this->init_sarathi_details_model();
        $data = $this->Sarathi_details_model->get_sarathi_profile($user_id);
        if(!empty($data)){
            $this->response(["success"=>true, "message"=>"sarathi details found", "data"=> $data], 200);
        }
        else{
            $this->response(["success"=>false, "message"=>"sarathi details not found"], 200);
        }
    }
     
    public function view_sarathi_documents(){
        if ($this->is_user_logged_in()) {
            $this->load_header();
			$this->load_sidebar();
			$this->load->view('sarathi/sarathi_documents');
            $this->load_footer();
            $this->load->view('sarathi/inc/sarathi_custom_js/sarathi_documents_js');
			
		} else {
			redirect(base_url());   //  sarathi_login
		}
    }

    public function display_sarathi_documents(){

        $user_id=$this->session->userdata(session_sarathi_user_id);
        $this->init_sarathi_details_model();
        $gid = $this->Sarathi_details_model->get_gid_by_user_id($user_id);
        $data = $this->Sarathi_details_model->get_pending_driver_details($gid);
        if(!empty($data)){
            $this->response(["success"=>true, "message"=>"found", "user_id"=>$user_id, "data"=>$data], 200);
        }
        else{
            $this->response(["success"=>false, "message"=>"not found"], 200);
        }
    }

    public function driver_location(){
        if ($this->is_user_logged_in()) {
            $this->load_header();
			$this->load_sidebar();
			$this->load->view('sarathi/driver_location');
            $this->load_footer();
            // $this->load->view('sarathi/inc/sarathi_custom_js/sarathi_documents_js');
			
		} else {
			redirect(base_url());   //  sarathi_login
		}
    }

    public function display_driver_location(){
        $user_id=$this->session->userdata(session_sarathi_user_id);
        $this->init_sarathi_details_model();
        $sarathi_id=$this->Sarathi_details_model->get_sarathi_id_by_user_id($user_id);
        $location=$this->Sarathi_details_model->display_driver_location($sarathi_id);
        if(!empty($location)){
            $this->response(["success"=>true, "message"=> "location found", "data"=>$location], 200);
        }
        else{
            $this->response(["success"=>false, "message"=> "location not found"], 200);
        }
    }

    public function get_specific_id(){
        $user_id=$this->input->post('user_id');
        $this->init_sarathi_details_model();
        $data=$this->Sarathi_details_model->get_specific_id($user_id);
        if(!empty($data)){
            $this->response(["success"=>true, "message"=> " found", "data"=>$data], 200);
        }
        else{
            $this->response(["success"=>false, "message"=> " not found"], 200);
        }
    }

    public function get_sarathi_km_purchased(){
        $sarathi_id=$this->input->post('sarathi_id');
        $this->init_sarathi_details_model();
        $data=$this->Sarathi_details_model->get_total_km_purchased($sarathi_id);
        if(!empty($data)){
            $this->response(["success"=>true, "message"=> " found", "data"=>$data], 200);
        }
        else{
            $this->response(["success"=>false, "message"=> " not found"], 200);
        }
    }

    public function change_image_session(){
        $new_path=$this->input->post('path');
        $update=$this->session->set_userdata(session_sarathi_profile_image, $new_path);
        if($update){
            $this->response(["success"=>true, "message"=> "path update"], 200);
        }
        else{
            $this->response(["success"=>false, "message"=> "Not update"], 200);
        }
    }

    


}
