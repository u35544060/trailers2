<?php

require 'vendor/autoload.php';
include 'scripts/php/dbConnect.php';

use \PhpOffice\PhpSpreadsheet\IOFactory;

$input = 'ItemListing.CSV';

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
$spreadsheet = $reader->load($input);

$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
$removeRow = array_shift($sheet);

foreach ($sheet as $s) {
    $sku = $s['A'];
    $description = $s['B'];
    $inventory = $s['D'];
    $vendor = $s['E'];
    $bc = $s['F'];
    $bcImage = $s['G'];
    
    $importSQL = "INSERT INTO products (sku, description, inventory, vendor, bc, bcImage) VALUES (:sku, :description, :inventory, :vendor, :bc, :bcImage)";
    $import = $con->prepare($importSQL);
    $import->bindParam(':sku', $sku);
    $import->bindParam(':description', $description);
    $import->bindParam(':inventory', $inventory);
    $import->bindParam(':vendor', $vendor);
    $import->bindParam(':bc', $bc);
    $import->bindParam(':bcImage', $bcImage);
    $import->execute();
}

echo '<script type="text/javascript">alert("Your data has been imported into the database successfully.");
    history.back(1);
    </script>';

?>