<?php

require 'recaptcha-master/src/autoload.php';

$captcha = $_POST['g-recaptcha-response'];

$site = '6Le6B18UAAAAAMMrMfGqZ9F3uF-YDI266WcUN3h1';
$secret = '6Le6B18UAAAAAA1TPQwsvIp02eSuSZ5rs1pI2sBh';

$recaptcha = new \ReCaptcha\ReCaptcha($secret);

$userIP = $_SERVER['REMOTE_ADDR'];

$captchaErr = '';

$response = $recaptcha->verify($captcha, $userIP);
if ($response->isSuccess()) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $num = $_POST['num'];
    $message = $_POST['message'];
    
    //set the receiver email address
    $to = 'jhood4@gmail.com';
    
    //set the subject for email
    $subject ="User Contact Has Been Made";
    
    //set headers for email and set content to html
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "CC: sean.kirby@bonton.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    //create message body
    $mess = '<html><body style="font-family: sans-serif;color:#4d5a60;">';
    
    //create div to store company logo
    $mess .= '<div style="width: 100%;text-align:center">';
    $mess .= '<img src="../../images/cmwtrlparts.png">';
    $mess .= '</div>';
    
    //create div to store table with contact info
    $mess .= '<div style="width:100%;display:flex;justify-content:center;">';
    
    //create table to store contact data
    $mess .= '<table style="width:50%;align-self:center;border:solid #d9dde0 2px;box-shadow:0 0 10px #d9dde0;margin-top: 15px;padding: 10px">';
    
    //row for name
    $mess .= '<tr style="text-align:left;padding: 10px;">';
    $mess .= '<th style="width:15%;padding-left:5px;">Name:</th>';
    $mess .= '<td>' . $fname . ' ' . $lname . '</td>';
    $mess .= '</tr>';
    
    //row for email
    $mess .= '<tr style="text-align:left;padding: 10px;">';
    $mess .= '<th style="width:15%;padding-left:5px;">Email:</th>';
    $mess .= '<td>' . $email . '</td>';
    $mess .= '</tr>';
    
    //row for phone number
    $mess .= '<tr style="text-align:left;padding: 10px;">';
    $mess .= '<th style="width:15%;padding-left:5px;">Phone #:</th>';
    $mess .= '<td>' . $num . '</td>';
    $mess .= '</tr>';
    
    //row for message header
    
    $mess .= '<tr style="text-align:center">';
    $mess .= '<th colspan="2">Message:</th>';
    $mess .= '</tr>';
    
    //row for the emailers message
    $mess .= '<tr style="text-align:center;padding: 10px;">';
    $mess .= '<td colspan="2">' . $message . '</td>';
    $mess .= '</tr>';
    
    $mess .='</div>';
    $mess .= '</body></html>';
    
    mail($to, $subject, $message, $headers);
    
} else {
    echo '<script type="text/javascript">alert("It seems that your IP has been compromised and is registering as a bot. Please try again or reset your IP address.");
    history.back();
    </script>';
}


?>