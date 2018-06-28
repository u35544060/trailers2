<?php

require 'dbConnect.php';

$sku = $_POST['sku'];
$description = $_POST['description'];
$type = $_POST['type'];
$stock = $_POST['stock'];
$vendor = $_POST['vendor'];
$bc = $_POST['bc'];
$bcImage = $_POST['bcImage'];

if(!empty($_FILES['pid']['name'])) {
    $oImage = $_FILES['pid']['tmp_name'];
    $ext = strtolower($_FILES['pid']['type']);
    
    $path = '../../images/thumbs/';
    
    $oSizeArray = getimagesize($oImage);
    
    $oHeight = $oSizeArray[1];
    $oWidth = $oSizeArray[0];
    
    $maxWidth = 216;
    $wDiff = $maxWidth / $oWidth;
    
    $maxHeight = 236;
    $hDiff = $maxHeight / $oHeight;
    
    $newWidth = ceil($wDiff * $oWidth);
    
    $newHeight = ceil($hDiff * $oHeight);
    
    $nImage = imagecreatetruecolor($newWidth, $newHeight);
    
    switch($ext) {
        case 'image/png':
            $extension = '.png';
            $completePath = $path .  $sku . $extension;
            $oPngImage = imagecreatefrompng($oImage);
            imagecopyresampled($nImage, $oPngImage, 0, 0, 0, 0, $newWidth, $newHeight, $oWidth, $oHeight);
            imagepng($nImage, $completePath, 9);
            break;
        case 'image/jpeg':
            $extension = '.jpeg';
            $completePath = $path .  $sku . $extension;
            $oJpegImage = imagecreatefromjpeg($oImage);
            imagecopyresampled($nImage, $oJpegImage, 0, 0, 0, 0, $newWidth, $newHeight, $oWidth, $oHeight);
            imagejpeg($nImage, $completePath, 100);
            break;
        case 'image/gif':
            $extension = '.gif';
            $completePath = $path . $sku . $extension;
            $oGifImage = imagecreatefromgif($oImage);
            imagecopyresampled($nImage, $oGifImage, 0, 0, 0, 0, $newWidth, $newHeight, $oWidth, $oHeight);
            imagegif($nImage, $completePath);
            break;
        default:
            echo '<script type="text/javascript">alert("Filetype is not supported.");
            history.back();
            </script>';
    };    
    
    $addProdSQL = "INSERT INTO products (sku, description, type, inventory, vendor, bc, bcImage, pic) VALUES (:sku, :description, :type, :stock, :vendor, :bc, :bcImage, :image)";
    
    $image = $sku . $extension;
    
} else {
   $addProdSQL = "INSERT INTO products (sku, description, type, inventory, vendor, bc, bcImage) VALUES (:sku, :description, :type, :stock, :vendor, :bc, :bcImage)";
}


/*$addProdSQL = "INSERT INTO products (sku, description, type, inventory, vendor, bc, bcImage) VALUES (:sku, :description, :type, :stock, :vendor, :bc, :bcImage)";*/
$addProd = $con->prepare($addProdSQL);
$addProd->bindParam(':sku', $sku);
$addProd->bindParam(':description', $description);
$addProd->bindParam(':type', $type);
$addProd->bindParam(':stock', $stock);
$addProd->bindParam(':vendor', $vendor);
$addProd->bindParam(':bc', $bc);
$addProd->bindParam(':bcImage', $bcImage);
if(!empty($_FILES['pid']['name'])) {
    $addProd->bindParam(':image', $image);
}
$addProd->execute();

echo '<script type="text/javascript">alert("The product has been added.");
history.back();
</script>';

?>