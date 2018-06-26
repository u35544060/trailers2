<!DOCTYPE html>

<?php

require 'scripts/php/dbConnect.php';

//start session to store cart items array
session_start();

//if quantiy is changed make the changes to the proper session array element
if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $arrayID = (int)$_POST['arrayID'];
    $_SESSION['cartItems'][$arrayID]['quantity'] = $qty;
}

//if an item is removed from the cart remove it from session array and reindex the array
if (isset($_GET['remove'])) {
    $index = (int)$_GET['arrayID'];
    unset($_SESSION['cartItems'][$index]);
    $_SESSION['cartItems'] = array_values($_SESSION['cartItems']);
    $_SESSION['cartCount'] = count($_SESSION['cartItems']);
    header("Location: cart.php");
}

//if user clears cart unset the session variable
if (isset($_GET['reset'])) {
    unset($_SESSION['cartItems']);
    $_SESSION['cartCount'] = count($_SESSION['cartItems']);
    header("Location: cart.php");
}

//if the session variable cartCount is not set, set it to 0
if(!isset($_SESSION['cartCount'])) {
    $_SESSION['cartCount'] = 0;
}

?>



<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">          
        <title>Cart - Commonwealth Trailer Parts</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js" integrity="sha384-u/bQvRA/1bobcXlcEYpsEdFVK/vJs3+T+nXLsBYJthmdBuavHvAW6UsmqO2Gd/F9" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/cart.css">
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
                
                <div class="headerPhone align-self-end center mr-5">
                    <h6 class="align-self-end">Call Now: <a href="tel:7179384603">(717)-938-4603</a></h6>
                </div><!-- end headerPhone -->
                <div class="align-self-end justify-content-end cartWrap text-right" id="cartWrap">
                <a href="cart.php" class="clearLink justify-content-end text-right">
                    <span id="cartIconSpan"><img class="cartIcon" src="images/cart.png" id="cartIcon"></span>
                    <span class="cartCount" id="cartCount">CART <span class="circle">( <?php echo $_SESSION['cartCount']; ?> )</span></span>
                </a>
            </div><!-- end cartIcon -->
            </div><!-- end container -->
        </nav> <!-- end nav section -->
        
        <!-- create the bar beneath the nav -->
        <div class="filler">
        
        </div><!-- end filler -->
        
        <!-- create the main content for the page here -->        
        <!-- begin the cart section -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 offset-2 text-right p-0">
                    <a href="products.php" class="btn btnUpdate mt-3" role="button">continue shopping</a>
                </div>
            </div>
            <!-- cart header -->
            <div class="row">
                <div class="col-8 offset-2 brdOrange mt-3 mb-3">
                <h2>MY CART</h2>
                </div>
            </div><!-- end row-->
            <!-- end cart header -->
            
            <!-- begin cart items -->
            <div class="row">
                <div class="col-8 offset-2 p-0">
                    <?php
                        if($_SESSION['cartCount'] < 1) {
                            echo '<h5 class="text-center">Your shopping cart is empty. Please add some products and come back when you are finished.</h5>';
                        } else {
                            $count = 0;
                            foreach($_SESSION['cartItems'] as $item) {
                                $prodID = $item['id'];
                                $getProdInfoSQL = "SELECT * FROM products WHERE id = :id";
                                $getProdInfo = $con->prepare($getProdInfoSQL);
                                $getProdInfo->bindParam(':id', $prodID);
                                $getProdInfo->execute();

                                $prodInfo = $getProdInfo->fetch(PDO::FETCH_ASSOC);

                                if (empty($prodInfo['pic'])) {
                                    $picLoc = 'images/unavailable.png';
                                } else {
                                    $picLoc = 'images/thumbs/' . $prodInfo['pic'];
                                }
                                
                                echo '<div class="row p-0 m-0 brdBottom">';
                                echo '<div class="col-md-3 p-0">';
                                echo '<img src="' . $picLoc . '" alt="NO IMAGE FOUND"/>';
                                if($prodInfo['inventory'] > 1) {
                                    echo '<p class="inStock">in stock</p>';
                                }
                                echo '</div>'; //end image wrapper
                                echo '<div class="col-md-9 p-0">';
                                echo '<div class="align-middle largeMarg mb-3">';
                                echo '<p class="itemSku mt-2">' . $item['sku'] . '</p>';
                                echo '<h5>' . $item['description'] . '</h5>';
                                echo '<form class="form-inline mt-1" name="frmUpdate" method="POST" action="cart.php">';
                                echo '<div class="row m-0 p-0">';
                                echo '<label for="qty" class="col-form-label mr-2">QUANTITY</label>';
                                echo '<input class="form-control qty" type="number" name="qty" value="' . $item['quantity'] . '">';
                                echo '<input type="hidden" name="arrayID" value="' . $count . '">';
                                echo '<input class="btn btn-link btnLink" type="submit" value="UPDATE">';
                                echo '<span class="remove"><a class="tt" href="cart.php?remove=true&arrayID=' . $count . '"><span class="fa fa-trash" aria-hidden="true"></span></a></span>';
                                echo '</div>'; //end quantity wrapper
                                echo '</form>';
                                echo '</div>'; //end description wrapper 
                                echo '</div>'; // end col-md-9 wrapper
                                echo '</div>'; // end row
                                
                                $count += 1;
                            }//end foreach
                            
                            echo '<div class="row">';
                            echo '<div class="col-12 text-right">';
                            echo '<a href="cart.php?reset=true" class="btn btnUpdate chnColor" role="button">CLEAR CART</a>';
                            echo '<a href="products.php" class="btn btnUpdate bl-1" role="button">proceed</a>';
                            echo '</div>';
                            echo '</div>';
                        }//end if/else statement
                    ?>
                </div>
            </div>
            
        </div><!-- end container-fluid-->
        <!-- end cart section -->
        
        <script type="text/javascript">
            $('.tt').tooltip({
                title: "Remove Product",
                placement: 'top'
            });
        </script>
        
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