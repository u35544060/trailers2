<!DOCTYPE html>

<?php 

require 'scripts/php/dbConnect.php';

//start session to store cart items array
session_start();

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
        <title>About - Commonwealth Trailer Parts</title>
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
        <link rel="stylesheet" type="text/css" href="css/about.css">
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
                        <li class="nav-item active">
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
        
        <!-- create the jumbotron to hold the main content of the page -->
        <div class="jumbotron noPad">
            <div class="container">
                <div class="row col-md-9">
                    <h2>WE ARE COMMONWEALTH TRAILER PARTS</h2>
                    <br />
                    <h3>The Parts To Keep You Moving</h3>
                    <p>Commonwealth Trailer Parts Inc was established in August of 1990 by Gary L. Saylor and Chris T. Glatfelter to provide a customer service based semi trailer parts store with competitive pricing. We became a Stoughton Distributor in 1995, Premier Manufacturing Distributor in 1992 and Aurora (Wabash/Fruehauf) distributor in 2006. Gary had 20 years with Warner Fruehauf Trailer Company in parts and service and is outside sales and delivery. Chris had 4 years in the automotive parts field and 9 years with Warner Fruehauf Trailer Company. He is inside sales, warehousing and Office. We will continue to try to provide the best service with competitive prices in the South Central Pennsylvania and North Western Maryland area.</p>
                    <p class="orangeP">If you have any questions, please call us at <a href="tel:7179384603">(717)-938-4603</a></p>
                </div><!-- end container -->
            </div><!-- end container -->
            <div class="container-fluid noPad bigMargTop">
                <div class="row text-center overflow">
                    <div class="col-md-4 hidden-sm">
                        <img src="images/truck1.jpg" class="img-fluid mb-3" alt="The first truck.">
                    </div><!-- end truck 1 -->
                    <div class="col-md-4">
                        <img src="images/truck2.jpeg" class="img-fluid mb-3" alt="The second truck.">
                    </div><!-- end truck 2 -->
                    <div class="col-md-4">
                        <img src="images/truck3.jpg" class="img-fluid mb-3" alt="The third truck.">
                    </div><!-- end truck 3 -->
                </div> <!-- end row -->
            </div><!-- end container-fluid -->
        </div><!-- end jumbotron -->
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