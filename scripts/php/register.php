<?php

require 'dbConnect.php';

$user = $_POST['uname'];
$regkey = $_POST['regkey'];
$pass = $_POST['pass'];
$vPass = $_POST['vPass'];

$verifyRegkeySQL = "SELECT regkey FROM users WHERE uname = :user";
$verifyRegkey = $con->prepare($verifyRegkeySQL);
$verifyRegkey->bindParam(':user', $user);
$verifyRegkey->execute();
$vRegkey = $verifyRegkey->fetch(PDO::FETCH_ASSOC);

if (empty($vRegkey['regkey'])) {
    echo '<script type="text/javascript">alert("The user does not exist. Please try again.");
    history.back();
    </script>';
} else {
    if ($regkey != $vRegkey['regkey']) {
        echo '<script type="text/javascript">alert("The registration key is incorrect. Please try again.");
        history.back();
        </script>';
    } else {
        if ($pass != $vPass) {
            echo '<script type="text/javascript">alert("The passwords you entered do not match. Please try again.");
            history.back();
            </script>';
        }  elseif (!preg_match('/^(?=.*[a-z]).*$/', $pass)) {
            echo '<script type="text/javascript">alert("Your password must contain at least one lower case letter. Please try again.");
            history.back();
            </script>';
        } elseif (!preg_match('/^(?=.*[A-Z]).*$/', $pass)) {
            echo '<script type="text/javascript">alert("Your password must contain at least one upper case letter. Please try again.");
            history.back();
            </script>';
        } elseif (!preg_match('/^(?=.*[0-9]).*$/', $pass)) {
            echo '<script type="text/javascript">alert("Your password must contain at least one number. Please try again.");
            history.back();
            </script>';
        } elseif (!preg_match('/^.*[\W].*$/', $pass)) {
            echo '<script type="text/javascript">alert("Your password must contain at least one special character. Please try again.");
            history.back();
            </script>';
        } elseif (strlen($pass) <= 7) {
            echo '<script type="text/javascript">alert("Your password must be at least eight characters. Please try again.");
            history.back();
            </script>';
        } else {
            $hashed = password_hash($pass, PASSWORD_DEFAULT);
            
            $registerSQL = "UPDATE users SET pass = :pass WHERE uname = :user";
            $register = $con->prepare($registerSQL);
            $register->bindParam(':user', $user);
            $register->bindParam(':pass', $hashed);
            $register->execute();
            
            echo '<script type="text/javascript">alert("Registration Successful.");
            window.location.replace("../../login.html");
            </script>';
        }
    }
}

?>