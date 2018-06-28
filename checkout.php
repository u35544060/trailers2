<!DOCTYPE html>

<?php
require 'scripts/php/dbConnect.php';

//start session to store cart items array
session_start();

//if the session variable cartCount is not set, set it to 0
if(!isset($_SESSION['cartCount'])) {
    $_SESSION['cartCount'] = 0;
}

//if the cart is empty get out of here
if(!isset($_SESSION['cartItems'])) {
    echo '<script type="text/javascript">alert("You need products in your cart to checkout. Please add something to your cart before proceeding.");
    window.location.replace("products.php");
    </script>';
}

?>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">          
        <title>Home - Commonwealth Trailer Parts</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
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
        <link rel="stylesheet" type="text/css" href="css/checkOut.css">
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
        
        <!-- create the main content for the page here -->
        <!-- create the checkout form -->
        <div class="container-fluid">
            <div class="row mt-3 mb-5">
                <div class="col-sm-10 offset-sm-1">
                    <form>
                        <div class="row">
                            <div class="col-7 col-md-9">
                                <form>
                                    <div class="form-group">
                                        <label class="inLabels" for="name">full name</label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="inLabels" for="email">email</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="inLabels" for="phone">phone number</label>
                                        <input type="phone" class="form-control" id="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label>preferred contact method</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="email" id="radEmail" value="email" checked>
                                            <label class="form-check-label radLbl" for="radEmail">email</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="phone" id="radPhone" value="phone">
                                            <label class="form-check-label radLbl" for="radPhone">phone</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-5 col-md-3 smCWrap">
                                <ul id="smallCart">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="text-center mt-3">your cart</h5>
                                        </div>
                                    </div>
                                    <?php
                                    foreach($_SESSION['cartItems'] as $item) {
                                        echo '<li class="smCart">';
                                        echo '<div class="itemWrap">';
                                        echo '<div class="row mb-0">';
                                        echo '<div class="col-12 m-0 p-0">';
                                        echo '<p class="float-left ml-2 mt-0 mb-0 p-0 smP">' . $item['sku'] . '</p>';
                                        echo '<p class="float-right mt-0 mb-0 p-0 mr-2">x' . $item['quantity'] . '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '<div class="row mt-0 mb-0">';
                                        echo '<p class="float-left ml-2 boldIt">' . $item['description'] . '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</li>';
                                    }
                                    
                                    echo '<button class="btn btnUpdate align-self-end" name="btnCheckOut" value="GET QUOTE">GET QUOTE</button>';
                                ?>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- end container-fluid -->
        <!-- end checkout form -->
        
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