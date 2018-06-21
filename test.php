<?php

require 'scripts/php/dbConnect.php';

$getSQL = "SELECT id, inventory from products where inventory IS NULL";
$get = $con->prepare($getSQL);
$get->execute();

$in = $get->fetchALL(PDO::FETCH_ASSOC);

foreach($in as $i) {
    $id = $i['id'];
    $inv = 0;
    $updateInventorySQL = "UPDATE products SET inventory = :i where id = :id";
    $updateInventory = $con->prepare($updateInventorySQL);
    $updateInventory->bindParam(":i", $inv);
    $updateInventory->bindParam(':id', $id);
    $updateInventory->execute();
}

?>

