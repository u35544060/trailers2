<?php

require 'dbConnect.php';

$sku = $_POST['sku'];
$description = $_POST['description'];
$type = $_POST['type'];
$stock = $_POST['stock'];
$vendor = $_POST['vendor'];
$bc = $_POST['bc'];
$bcImage = $_POST['bcImage'];

$addProdSQL = "INSERT INTO products (sku, description, type, inventory, vendor, bc, bcImage) VALUES (:sku, :description, :type, :stock, :vendor, :bc, :bcImage)";
$addProd = $con->prepare($addProdSQL);
$addProd->bindParam(':sku', $sku);
$addProd->bindParam(':description', $description);
$addProd->bindParam(':type', $type);
$addProd->bindParam(':stock', $stock);
$addProd->bindParam(':vendor', $vendor);
$addProd->bindParam(':bc', $bc);
$addProd->bindParam(':bcImage', $bcImage);
$addProd->execute();

echo '<script type="text/javascript">alert("The product has been added.");
history.back();
</script>';

?>