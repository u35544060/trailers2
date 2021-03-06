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
        <title>Contact - Commonwealth Trailer Parts</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/contact.css">
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
                        <li class="nav-item active">
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
        <div class="container-fluid">
            <div class="row text-center pt-5">
                <div class="col-md-6">
                    <h2>VISIT US</h2>
                    <div class="underline3"></div><!-- end underline -->
                    <div class="text-left pl-3">
                        <h6>ADDRESS:</h6>
                        <a href="https://www.google.com/maps/place/106+W+Crone+Rd,+York,+PA+17406/@40.0296171,-76.7482725,17z/data=!3m1!4b1!4m5!3m4!1s0x89c88df0bb010b21:0x8bfc2d2ce916e5d0!8m2!3d40.0296171!4d-76.7460838"><p>106 West Crone Rd.</p><p>York PA, 17406</p></a>
                    </div><!-- end left text -->
                    <div id="map" class="mt-3"></div><!-- end map -->
                    <script src="scripts/js/map.js"></script>
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCa00eL-Pm3uSm6lW8UBqSi05qBS4crMb8&callback=initMap"></script>
                    <h2 class="mt-5">HOURS</h2>
                    <div class="underline3"></div><!-- end underline -->
                    <div id="tbWrap" class="mb-5">
                        <table>
                            <tr>
                                <th>Monday</th>
                                <td>8AM - 5PM</td>
                            </tr>
                            <tr>
                                <th>Tuesday</th>
                                <td>8AM - 5PM</td>
                            </tr>
                            <tr>
                                <th>Wednesday</th>
                                <td>8AM - 5PM</td>
                            </tr>
                            <tr>
                                <th>Thursday</th>
                                <td>8AM - 5PM</td>
                            </tr>
                            <tr>
                                <th>Friday</th>
                                <td>8AM - 5PM</td>
                            </tr>
                            <tr>
                                <th>Saturday</th>
                                <td>9AM - 4PM</td>
                            </tr>
                            <tr>
                                <th>Sunday</th>
                                <td>Closed</td>
                            </tr>
                        </table>
                    </div>
                </div><!-- end visitUs -->
                <div class="col-md-6">
                    <h2>CONTACT US</h2>
                    <div class="underline2"></div><!-- end underline -->
                    <div class="text-left pl-3">
                        <h6>PHONE:</h6>
                        <a href="tel:7179384603">(717)-938-4603</a>
                        <h6 class="mt-3">EMAIL:</h6>
                        <a href="mailto:fillthisin@dontforget.com">FillThisIn@dontforget.com</a>
                        
                        <form name="frmContact" method="POST" action="scripts/php/contact.php" enctype="multipart/form-data" class="pt-3 mt-3 mb-4">
                            <h6 class="text-center">Or use the form below to send us a message.</h6>
                            <label for="fname">FIRST NAME</label>
                            <input type="text" name="fname" required />
                            <label for="lname" class="mt-3">LAST NAME</label>
                            <input type="text" name="lname" required />
                            <label for="email" class="mt-3">EMAIL ADDRESS</label>
                            <input type="email" name="email" required />
                            <label for="num" class="mt-3">PHONE NUMBER</label>
                            <input type="text" name="num" id="num" required/>
                            <label for="message" class="mt-3">YOUR MESSAGE</label>
                            <textarea  name="message" required></textarea>
                            <div class="captcha">
                                <div class="g-recaptcha text-center mb-3 mt-3" data-sitekey="6Le6B18UAAAAAMMrMfGqZ9F3uF-YDI266WcUN3h1" align="center"></div><!-- end g-recaptcha -->
                            </div><!-- end captcha -->
                            <input type="submit" value="SUBMIT" class="mb-3">
                        </form>
                    </div>
                </div><!-- end contactUs -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
        
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
    
    <script type="text/javascript">
        
            $('#num').keyup(function() {
                $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'));
            });
        
    </script>
    
</html>