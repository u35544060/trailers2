<?php

require 'dbConnect.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$uname = $_POST['uname'];
$email = $_POST['email'];

$checkExistsSQL = "SELECT uname FROM users WHERE uname = :uname";
$checkExists = $con->prepare($checkExistsSQL);
$checkExists->bindParam(':uname', $uname);
$checkExists->execute();
$exists = $checkExists->fetchALL(PDO::FETCH_ASSOC);

if(!empty($exists)) {
    echo '<script type="text/javascript">alert("The username already exists. Please try again.");
    history.back();
    </script>';
} else {
    function random_string($length) {
        $base = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        return substr(str_shuffle($base), 0, $length);
    }

    $regCode = random_string(100);

    $addUserSQL = "INSERT INTO users (uname, email, first, last, regkey) VALUEs (:uname, :email, :first, :last, :regkey)";
    $addUser = $con->prepare($addUserSQL);
    $addUser->bindParam(':uname', $uname);
    $addUser->bindParam(':email', $email);
    $addUser->bindParam(':first', $fname);
    $addUser->bindParam(':last', $lname);
    $addUser->bindParam(':regkey', $regCode);
    $addUser->execute();

    $to = $email;

    $subject = "Commonwealth Trailer Parts Admin Registration Code";

    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "CC: sean.kirby@bonton.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $mess = '<html><body style="font-family: sans-serif;color:#4d5a60;">';

    $mess .= '<div style="width: 100%;text-align:center">';
    $mess .= '<img src="../../images/cmwtrlparts.png">';
    $mess .= '</div>';

    $mess .= '<div><p>Use the code below to register as an administrator at Commonwealth Trailer Parts.</p><p>' . $regCode . '</p></div>';

    mail($to, $subject, $mess, $headers);
    
    echo '<script type="text/javascript">alert("The user has been added.");
    history.back();
    </script>';
}

?>