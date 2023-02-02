<?php
class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);

    }

    public function sendNotification($spcific_id, $title, $message, $image){

        // return true;

        $this->setNotificationToDb($spcific_id, $title, $message, $image);
        
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
        return ($this->db->affected_rows()==1)?true:false;
    }

}