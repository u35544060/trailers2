<!DOCTYPE html>

<?php
    require 'scripts/php/dbConnect.php';
    
    session_start();
    
    if (!isset($_SESSION['user'])) {
        header("Location: login.html");
    }
?>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">          
        <title>Admin - Commonwealth Trailer Parts</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/admin.css">
    </head>
    <body>
        <!-- create the naviagation for the page -->
        <nav class="navbar navbar-expand-md navbar-light noPad justify-content-center">
            <div class="container noPad">
                <a class="navbar-brand" href="index.php"><img src="images/cmwtrlparts.png"></a>
                <button class="navbar-toggler mr-4" type="button" data-toggle="collapse" data-target="#subMenu" aria-controls="subMenu" aria-expanded="false" aria-label="Toggle Navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse align-self-end" id="subMenu">
                    <ul class="navbar-nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="about.php" style="color:#212121;">ABOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php" style="color:#212121">CONTACT</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="prodDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#212121">PRODUCTS</a>
                            <div class="dropdown-menu" aria-labelledby="prodDrop">
                                <a class="dropdown-item" href="products.php?type=all">ALL PRODUCTS</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="products.php?type=cat">BY CATEGORY</a>
                                <a class="dropdown-item" href="products.php?type=brand">BY BRAND</a>
                                <a class="dropdown-item" href="products.php?type=dist">BY DISTRIBUTOR</a>
                            </div><!-- end dropdown menu -->
                        </li>
                    </ul>
                </div><!-- end subMenu -->
                
                <div class="headerPhone align-self-end center">
                    <h6 class="align-self-end">Call Now: <a href="tel:7179384603">(717)-938-4603</a></h6>
                </div><!-- end headerPhone -->
            </div><!-- end container -->
        </nav> <!-- end nav section -->
        
        <!-- create the bar beneath the nav -->
        <div class="filler">
        
        </div><!-- end filler -->
        
        <!-- create the main content for the page here -->
        <div class="container-fluid" id="productLookup">
            <div class="row text-center mt-3 mb-3">
                <div class="col-md-8 offset-md-2">
                    <h3>Admin Area</h3>
                    
                    <!-- create basic page navigation -->
                    <div class="container-fluid mb-3 links">
                        <a href="#productLookup">PRODUCT LOOKUP</a>
                        <a href="#addProduct" class="separate">ADD PRODUCT</a>
                        <a href="#userLookup" class="separate">USER LOOKUP</a> 
                        <a href="#userAdd" class="separate">ADD USER</a>
                    </div><!-- end basic page navigation -->
                    
                    <h5 class="text-left">PRODUCT LOOKUP</h5>
                    <form class="form-inline" method="POST" action="admin.php">
                        <select class="form-control orange mr-3 mb-3" name="selProduct">
                            <option name="sku">SKU</option>
                            <option name="bc">BARCODE</option>
                            <OPTION name="bcImage">BARCODE IMAGE</OPTION>
                        </select>
                        <input type="text" class="form-control orange mr-3 mb-3" name="txtProduct">
                        <button class="btn mb-3 btnPLookup" type="submit">LOOK UP</button> 
                    </form>
                </div>
            </div><!-- end row -->
        </div><!-- end container-fluid -->
        <!-- end the product lookup area -->
        
        <!-- display the product or display hint to use form to search for a product -->
        <div class="container-fluid mb-3">
            <div class="row text-center">
                <div class="col-md-8 offset-md-2">
                    <?php
                        if(empty($_POST['txtProduct'])) {
                           echo '<p>Please use the form above to search for and edit/delete a product.</p>';
                            echo '<hr class="hr">';
                        } else {
                            //if the user is searching for a product do the following
                            
                            //set the column to search on
                            $which = $_POST['selProduct'];
                            if ($which == 'SKU') {
                                $col = 'sku';
                            } elseif ($which == 'BARCODE') {
                                $col = 'bc';
                            } elseif ($which == 'BARCODE IMAGE') {
                                $col = 'bcImage';
                            }
                            
                            //set the data you are searching for
                            $searchFor = $_POST['txtProduct'];
                            
                            //execute the search and store it in the products array
                            $getProductSQL = "SELECT * FROM products WHERE $col = :searchFor";
                            $getProduct = $con->prepare($getProductSQL);
                            $getProduct->bindParam(':searchFor', $searchFor);
                            $getProduct->execute();
                            $product = $getProduct->fetch(PDO::FETCH_ASSOC);
                            
                            if(empty($product)) {
                                echo '<p>Product not found. Please try again.</p>';
                            } else {
                            //set the pic path
                                if(empty($product['pic'])) {
                                    $picLoc = 'images/unavailable.png';
                                } else {
                                    $picLoc = 'images/thumbs/' . $product['pic'];
                                }
                                
                                //set variables from the products array
                                $id = $product['id'];
                                $sku = $product['sku'];
                                $description = $product['description'];
                                $type = $product['type'];
                                $stock = $product['inventory'];
                                $vendor = $product['vendor'];
                                $bc = $product['bc'];
                                $bcImage = $product['bcImage'];

                                //echo the update form onto the page
                                echo '<div class="container-fluid text-left">';
                                echo '<form class="form" name="upProduct" method="POST" action="scripts/php/update.php" enctype="multipart/form-data">';
                                echo '<input type="hidden" name="id" value="' . $id . '">';
                                echo '<label>SKU</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="sku" value="' . $sku . '">';
                                echo '<label>DESCRIPTION</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="description" value="' . $description . '">';
                                echo '<label>TYPE</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="type" value="' . $type . '">';
                                echo '<label>QUANTITY ON HAND</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="stock" value="' . $stock . '">';
                                echo '<label>VENDOR</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="vendor" value="' . $vendor . '">';
                                echo '<label>BARCODE</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="bc" value="' . $bc . '">';
                                echo '<label>BARCODE IMAGE</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="bcImage" value="' .$bcImage . '">';
                                echo '<div class="container-fluid mb-3">';
                                echo '<table><tr>';
                                echo '<td class="align-top"><label>CURRENT IMAGE</label></td>';
                                echo '</tr><tr>';
                                echo '<td><img src="' . $picLoc . '"></td>';
                                echo '<tr><td><label class="mt-4">UPDATE IMAGE</label></td></tr>';
                                echo '<tr><td><input type="file" name="pid"></td>';
                                echo '</tr></table>';
                                echo '</div>';
                                echo '<div class="container-fluid text-right mb-3">';
                                echo '<input type="submit" value="UPDATE" class="btnUpdate mr-2">';
                                echo '<input type="submit" value="DELETE" formaction="scripts/php/delete.php" class="btnUpdate">';
                                echo '</div>';
                                echo '</form>';
                                echo '<hr class="hr">';
                                echo '</div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div><!--end container-fluid -->
        <!-- end the product update/delete section -->
        
        <!-- create the add product area -->
        <div class="container-fluid" id="addProduct">
            <div class="row text-center mt-3 mb-3">
                <div class="col-md-8 offset-md-2">
                    <h5 class="text-left">ADD PRODUCT</h5>
                    <form class="form text-left" method="POST" action="scripts/php/add.php" enctype="multipart/form-data">
                        <label>SKU</label>
                        <input type="text" name="sku" class="form-control orange mb-3" required>
                        <label>DESCRIPTION</label>
                        <input type="text" name="description" class="form-control orange mb-3">
                        <label>TYPE</label>
                        <input type="text" name="type" class="form-control orange mb-3">
                        <label>QUANTITY ON HAND</label>
                        <input type="text" name="stock" class="form-control orange mb-3">
                        <label>VENDOR</label>
                        <input type="text" name="vendor" class="form-control orange mb-3">
                        <label>BARCODE</label>
                        <input type="text" name="bc" class="form-control orange mb-3">
                        <label>BARCODE IMAGE</label>
                        <input type="text" name="bcImage" class="form-control orange mb-3">
                        <label>PHOTO</label>
                        <input type="file" class="form-control-file mb-3" name="pid">
                        <div class="container-fluid text-center">
                            <input type="submit" class="btn btnPLookup" value="ADD PRODUCT">
                        </div>
                    </form>
                    <hr class="hr mt-3">
                </div>
            </div><!-- end row -->
        </div><!-- end container-fluid -->
        <!-- end add product area -->
        
        <!-- create the user lookup area -->
        <div class="container-fluid" id="userLookup">
            <div class="row text-center mt-3 mb-3">
                <div class="col-md-8 offset-md-2">
                    <h5 class="text-left">USER LOOKUP</h5>
                    <form class="form-inline" method="POST" action="admin.php#userLookup">
                        <select class="form-control orange mr-3 mb-3" name="userType">
                            <option class="changeHover">USERNAME</option>
                            <option class="changeHover">EMAIL</option>
                        </select>
                        <input type="text" class="form-control orange mr-3 mb-3" name="userSearch">
                        <button class="btn mb-3 btnPLookup" type="submit">LOOK UP</button> 
                    </form>
                </div>
            </div><!-- end row -->
        </div><!-- end container-fluid -->
        <!-- end user lookup area -->
        
        <!-- display the user for update or delete area or give a hint to use form above to locate a user -->
        <div class="container-fluid mb-3">
            <div class="row text-center">
                <div class="col-md-8 offset-md-2">
                    <?php
                        //set search string variable based on the post data
                        if (isset($_POST['userSearch'])) {
                            $searchString = $_POST['userSearch'];
                        }
                    
                        //if search string is empty show hint to use form to lookup user otherwise begin //user lookup
                        if(empty($searchString)) {
                            echo '<p>Please use the form above to locate and update/delete a user.</p>';
                            echo '<hr class="hr">';
                        } else {
                            //set the column to search on
                            $userType = $_POST['userType'];
                            if ($userType == 'USERNAME') {
                                $col = 'uname';
                            } elseif ($userType == 'EMAIL') {
                                $col = 'email';
                            }
                            
                            //search for the user in the table
                            $getUserSQL = "SELECT id, uname, email, first, last FROM users WHERE $col = :user";
                            $getUser = $con->prepare($getUserSQL);
                            $getUser->bindParam(':user', $searchString);
                            $getUser->execute();
                            $userData = $getUser->fetch(PDO::FETCH_ASSOC);
                            
                            //if the user doesn't exist display user not found otherwise display user //details form with update/delete buttons.
                            if (empty($userData)) {
                                echo '<p>The user was not found. Please try again.</p>';
                                echo '<hr class="hr">';
                            } else {
                                //set user variables
                                $uid = $userData['id'];
                                $first = $userData['first'];
                                $last = $userData['last'];
                                $userName = $userData['uname'];
                                $email = $userData['email'];
                                
                                //echo the data to the screen in an updatable form
                                echo '<div class="container-fluid">';
                                echo '<form class="form text-left" name="updateUserFrm" method="POST" action="scripts/php/updateUser.php">';
                                echo '<input type="hidden" name="id" value="' . $uid . '">';
                                echo '<label>FIRST NAME</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="first" value="' . $first .'">';
                                echo '<label>LAST NAME</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="last" value="' . $last . '">';
                                echo '<label>USERNAME</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="uname" value="' . $userName . '" readonly>';
                                echo '<label>EMAIL</label>';
                                echo '<input class="form-control orange mb-3" type="text" name="email" value="' . $email . '">';
                                echo '<div class="container-fluid text-right">';
                                echo '<input type="submit" value="UPDATE" class="btnUpdate">';
                                echo '<input type="submit" value="DELETE" class="btnUpdate ml-3"  formaction="scripts/php/deleteUser.php">';
                                echo '</div>';
                                echo '</form>';
                                echo '<hr class="hr mt-3">';
                                echo '</div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div><!-- end container-fluid -->
        <!-- end user lookup area -->
        
        <!-- start user add area -->
        <div class="container-fluid" id="userAdd">
            <div class="row text-center mt-3 mb-3">
                <div class="col-md-8 offset-md-2">
                    <h5 class="text-left">ADD USER</h5>
                    <form class="form text-left" method="POST" action="scripts/php/addUser.php">
                        <label>FIRST NAME</label>
                        <input type="text" name="fname" class="form-control orange mb-3" required>
                        <label>LAST NAME</label>
                        <input type="text" name="lname" class="form-control orange mb-3" required>
                        <label>USERNAME</label>
                        <input type="text" name="uname" class="form-control orange mb-3" required>
                        <label>EMAIL</label>
                        <input type="text" name="email" class="form-control orange mb-3" required>
                        <div class="container-fluid text-center">
                            <input type="submit" class="btn btnPLookup" value="ADD USER">
                        </div>
                    </form>
                    <hr class="hr mt-3">
                </div>
            </div><!-- end row -->
        </div><!-- end container fluid -->
        <!-- end user add area -->
        
        <!-- create basic page navigation -->
        <div class="container-fluid mb-3 links text-center">
            <a href="#productLookup">PRODUCT LOOKUP</a>
            <a href="#addProduct" class="separate">ADD PRODUCT</a>
            <a href="#userLookup" class="separate">USER LOOKUP</a> 
            <a href="#userAdd" class="separate">ADD USER</a>
        </div><!-- end basic page navigation -->
        
        <div id="footer">
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h4>Find Us</h4>
                        <!-- create underline -->
                        <div class="underline"></div>
                        <a href="https://www.google.com/maps/place/106+W+Crone+Rd,+York,+PA+17406/@40.0296171,-76.7482725,17z/data=!3m1!4b1!4m5!3m4!1s0x89c88df0bb010b21:0x8bfc2d2ce916e5d0!8m2!3d40.0296171!4d-76.7460838"><p>106 Crone Rd.</p><p>York PA, 17406</p></a>
                        <p>Phone: <a href="tel:7179384603">(717)-938-4603</a></p>
                    </div><!-- end column -->
                    <div class="col-md-4">
                        <img src="images/logoLight.png" class="img-fluid mb-3">
                        <h6 class="mb-5">The parts to keep you moving</h6>
                        <p class="orangeP">&reg; 2018 COMMONWEALTH TRAILER PARTS</p>
                    </div><!-- end column -->
                    <div class="col-md-4">
                        <h4>Customer Service</h4>
                        <!-- create underline -->
                        <div class="underline2"></div>
                        <ul>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Payment</a></li>
                            <li><a href="FAQ">FAQ</a></li>
                        </ul>
                    </div><!-- end column -->
                </div><!-- end row -->
            </div><!-- end container fluid -->
        </div><!-- end footer -->
    </body>
</html>