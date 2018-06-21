<?php

require 'dbConnect.php';

$id = $_POST['id'];

$removeUserSQL = "DELETE FROM users WHERE id = :id";
$removeUser = $con->prepare($removeUserSQL);
$removeUser->bindParam(':id', $id);
$removeUser->execute();

echo '<script type="text/javascript">alert("The user has been deleted.");
history.back();
</script>';

?>