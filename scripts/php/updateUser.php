<?php

require 'dbConnect.php';

$id = $_POST['id'];
$fname = $_POST['first'];
$lname = $_POST['last'];
$email = $_POST['email'];

$updateUserSQL = "UPDATE users SET first = :first, last = :last, email = :email WHERE id = :id";
$updateUser = $con->prepare($updateUserSQL);
$updateUser->bindParam(':first', $fname);
$updateUser->bindParam(':last', $lname);
$updateUser->bindParam(':email', $email);
$updateUser->bindParam(':id', $id);
$updateUser->execute();

echo '<script type="text/javascript">alert("The user was updated.");
history.back();
</script>';


?>