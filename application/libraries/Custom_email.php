<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package     CodeIgniter
 * @author      Ankit
 * @copyright   Copyright (c) 2016, Ankit.
 * @license     
 * @link        http://
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Ankit email class
 *
 * @package     CodeIgniter
 * @subpackage          Libraries
 * @category           Ankit 
 * @author      Ankit
 * @link        http://
 */

class Custom_email
{

    var $CI;
    public function __construct()
    {

        $this->CI = &get_instance();
        $this->CI->load->helper('url');
        $this->CI->config->item('base_url');
        $this->CI->load->database();
    }

    public function sendMail($emailsubject, $dataMessage, $mailid)
    {

        // $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls')
        //     ->setUsername('moloy@v-xplore.com')
        //     ->setPassword('moloyPRADHAN20998');

        // $mailer = Swift_Mailer::newInstance($transport);
        // $messages = Swift_Message::newInstance('Subject')
        //     ->setFrom(array('moloy@v-xplore.com' => 'Subject'))
        //     ->setTo(array($mailid => 'Add Recipients'))
        //     ->setSubject($emailsubject)
        //     ->setBody($dataMessage, 'text/html');
        // $result = $mailer->send($messages);
        


        $transport = new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls');
        $transport->setUsername('moloy@v-xplore.com')->setPassword('moloyPRADHAN20998');
        $mailer = new Swift_Mailer($transport);
        $message = new Swift_Message('Subject');
        $message
            ->setFrom(['moloy@v-xplore.com' => 'JaduRide'])
            ->setTo([$mailid => 'Recipient'])
            ->setSubject($emailsubject)
            ->setBody($dataMessage, 'text/html');

        $result = $mailer->send($message);

        if ($result) {
            return "success";
        }
    }
}
