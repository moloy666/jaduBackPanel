<?php
class NotificationManager extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);

    }

    public function sendNotification($specific_id, $title, $message, $image){

        $token_id = $this->get_token_id_of_specific_user($specific_id);

        // return true;

        $status = $this->setNotificationToDb($specific_id, $title, $message, $image);
        return $status;
    }

    private function  setNotificationToDb($specific_id, $title, $body, $image){
        $data=[
            field_uid =>$this->Uid_server_model->generate_uid(KEY_NOTIFICATION),
            field_specific_level_user_id=>$specific_id,
            field_title=>$title,
            field_body=> $body,
            field_image=>$image,
            field_large_icon=>$image,
            field_action=>$image,
            field_created_at=>date(field_date)
        ];
        $this->db->insert(table_notification, $data);
        return ($this->db->affected_rows() == 1)?true:false;
    }

    private function get_token_id_of_specific_user($specific_id){
        $query = $this->db->select(field_token)->where(field_specific_level_user_id, $specific_id)->get(table_device_notification_data_firebase);
        $query = $query->result_array();
        return (!empty($query))?$query[0][field_token]:null;
    }

}