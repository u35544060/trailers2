<?php

require 'dbConnect.php';

$user = $_POST['uname'];
$pass = $_POST['pass'];

$storedPassSQL = "SELECT pass FROM users where uname = :user";
$storedPass = $con->prepare($storedPassSQL);
$storedPass->bindParam(':user', $user);
$storedPass->execute();
$sPass = $storedPass->fetch(PDO::FETCH_ASSOC);

if (empty($sPass['pass'])) {
    echo '<script type="text/javascript">alert("There was a problem. Registration for the user has not been completed, or the user does not exist.");
    history.back();
    </script>';
} else {
    if (password_verify($pass, $sPass['pass'])) {
        session_start();
        
        $_SESSION['user'] = $user;
        
        echo '<script type="text/javascript">alert("Thank you!");
        window.location.replace("../../admin.php");
        </script>';
    } else {
        echo '<script type="text/javascript">alert("Your password is incorrect. Please try again.");
        history.back();
        </script>';
    }
}


?>