<?php
class Mail_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(field_location);
    }

    public function send_mail($email, $password)
    {
        $usermail = $email;
        $emailsubject = "JaduRide Login Password : " . $password;
        $dataMessage = "<p>
                            Hi, User <br/>
                            Your JaduRide Login Password is $password. <br/>
                            <i>Note: Do not share this email with anyone.</i> <br/><br/>
                            Thanks <br/>
                            Regards <br/>
                            <a href='" . base_url() . "'>JaduRide</a>
                        </p>";

        $this->custom_email->sendMail($emailsubject, $dataMessage, $usermail);
    }
}
