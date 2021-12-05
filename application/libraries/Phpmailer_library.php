<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Phpmailer_library
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        require_once APPPATH . 'libraries/PHPMailer/Exception.php';
        require_once APPPATH . 'libraries/PHPMailer/PHPMailer.php';
        require_once APPPATH . 'libraries/PHPMailer/SMTP.php';
        
        $mail = new PHPMailer();
        return $mail;
    }
}
?>