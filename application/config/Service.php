<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . rest_controller_path;

use jaduride\RestServer\RestController;

class Service extends RestController
{

    public function __construct()
    {
        parent::__construct();
        Header(header_allow_origin); //for allow any domain, insecure
        Header(header_allow_headers); //for allow any headers, insecure
        Header(header_allow_methods); //method allowed

        $this->load->database();
        $this->load->helper(array(helper_form, helper_url));
        $this->lang->load(lang_app_message);

        date_default_timezone_set(field_location);
    }

    private function lang_message($str)
    {
        return ($this->lang->line($str));
    }

    private function init_service_model()
    {
        $this->load->model(model_service);
    }
    private function init_common_model()
    {
        $this->load->model(model_common);
    }


    private function add_ride()
    {
        $resp = function ($data) {
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_is_submitted => $data[2],

            ];
            return $data_final;
        };

        $this->init_common_model();
        $this->init_service_model();

        $path = 'assets/images/';

        $service_id = $this->input->post('service');
        $ride_name = $this->input->post('name');
        $specific_id = $this->input->post('specific_id');

        $ride_id = 'ride_' . strtolower(str_replace(" ", "_", $ride_name));    // **


        if (empty($service_id)) {
            $message = $this->lang_message(text_service_id_required);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
        if (empty($ride_name)) {
            $message = $this->lang_message(text_ride_name_required);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }

        if ($this->Common_model->do_upload($path, field_image_icon)) {
            $image_icon = $path . $this->upload->data(filename);
        } else {
            $message = $this->lang_message(text_ride_icon_required);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
        $isAdded = $this->Service_model->add_ride_type($ride_id, $service_id, $ride_name, $image_icon, $specific_id);
        if ($isAdded){
            $message = $this->lang_message(text_ride_added_successfully);
            $response = [true, $message, true];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        } else {
            $message = $this->lang_message(text_ride_already_exist);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
    }

    private function add_splashdata()
    {
        $resp = function ($data) {
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_is_submitted => $data[2],

            ];
            return $data_final;
        };

        $this->init_common_model();
        $this->init_service_model();

        $path = 'assets/images/';

        $heading = $this->input->post('heading');
        $body = $this->input->post('body');
        $for = $this->input->post('for');
        $specific_for = $this->input->post('specific_for');

        $uid = rand(111111,999999);

        if (empty($heading)) {
            $message = $this->lang_message(text_heading_required);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
        if (empty($body)) {
            $message = $this->lang_message(text_body_required);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }

        if ($this->Common_model->do_upload($path, 'splash_image')) {
            $image = $path . $this->upload->data(filename);
        } else {
            $message = $this->lang_message(text_splash_image_required);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
        $isAdded = $this->Service_model->add_splashdata($uid, $heading, $body, $for, $specific_for, $image);
        if ($isAdded){
            $message = $this->lang_message(text_splash_added_successfully);
            $response = [true, $message, true];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        } else {
            $message = $this->lang_message(text_splash_failed);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
    }

    private function edit_splashdata()
    {
        $resp = function ($data) {
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_is_submitted => $data[2],

            ];
            return $data_final;
        };

        $this->init_common_model();
        $this->init_service_model();

        $path = 'assets/images/';

        $heading = $this->input->post('heading');
        $body = $this->input->post('body');
        $for = $this->input->post('for');
        $uid=$this->input->post('id');


        if (empty($heading)) {
            $message = $this->lang_message(text_heading_required);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
        if (empty($body)) {
            $message = $this->lang_message(text_body_required);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }

        if ($this->Common_model->do_upload($path, 'splash_image')) {
            $image = $path . $this->upload->data(filename);
        } else {
            $image=$this->Service_model->get_image_path_by_uid($uid);
        }
        
        $isUpdated = $this->Service_model->edit_splashdata($uid, $heading, $body, $for, $image);
        if ($isUpdated){
            $message = $this->lang_message(text_splash_data_updated);
            $response = [true, $message, true];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        } else {
            $message = $this->lang_message(text_no_changes_deducted);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
    }

    private function update_profile_picture()   // sarathi back panel
    {
        $resp = function ($data) {
            $data_final = [
                key_status => $data[0],
                key_message => $data[1],
                key_is_submitted => $data[2],

            ];
            return $data_final;
        };

        $this->init_common_model();
        $this->init_service_model();

        $path = 'assets/images/profile_image/';

        if ($this->Common_model->do_upload($path, 'image')) {
            $image = $path . $this->upload->data(filename);
        } else {
            $message = "Select a profile image";
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
        $user_id=$this->input->post('user_id');
        
        $isUpdated = $this->Service_model->update_profile_image($user_id, $image);
        if ($isUpdated){
            $message = "Profile image update succesfully";
            $response = [true, $message, true];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        } else {
            $message = $this->lang_message(text_no_changes_deducted);
            $response = [false, $message, false];
            $final_response[DATA] = $resp($response);
            $final_response[HTTP_STATUS] = http_ok;
            return $final_response;
        }
    }



    public function addRide_post()
    {
        $response = $this->add_ride();
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function addSplashData_post()
    {
        $response = $this->add_splashdata();
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }

    public function editSplashData_post()
    {
        $response = $this->edit_splashdata();
        $this->response($response[DATA], $response[HTTP_STATUS]);
    } 

    public function updateProfilePicture_post(){    // sarathi back panel
        $response = $this->update_profile_picture();
        $this->response($response[DATA], $response[HTTP_STATUS]);
    }
  


    
}
