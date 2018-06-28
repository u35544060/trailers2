<?php

require 'dbConnect.php';

$id = $_POST['id'];

$removeProdSQL = "DELETE FROM products WHERE id = :id";
$removeProd = $con->prepare($removeProdSQL);
$removeProd->bindParam(':id', $id);
$removeProd->execute();

echo '<script type="text/javascript">alert("The product was removed.");
history.back();
</script>';

?>