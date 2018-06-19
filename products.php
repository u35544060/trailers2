<!DOCTYPE html>

<?php 

require 'scripts/php/dbConnect.php';

$pageSetup = "SELECT NULL FROM products";
                    $pagination = $con->prepare($pageSetup);
                    $pagination->execute();
                    $count = $pagination->rowCount();
                
                    if (!empty(GET['page'])) {
                        $page = (int)$_GET['page'];
                    } else {
                        $page = 1;
                    }
                
                if (!empty($_GET['per'])) {
                    $per = (int)$_GET['per'];
                } else {
                    $per = 150;
                }
                
                $lastPage = ceil($count / $per);
                
                if ($page < 1) {
                    $page = 1;
                } elseif ($page > $lastPage) {
                    $page = $lastPage;
                }
                
                $lNext = "";
                $lPrev = "";
                
                if($lastPage !=1) {
                    if($page != $lastPage) {
                        $next = $page + 1;
                        $lNext = '<a href="products.php?page='.$next.'&per='.$per.'"><span>></span></a>';
                    }
                    
                    if ($page != 1) {
                        $prev = $page - 1;
                        $lPrev = '<a href="products.php?page='.$prev.'&per='.$per.'"><span><</span></a>';
                    }
                }
                
                $startPaging = ($page > 1) ? ($page * $per) - $per : 0;
                
                $productSQL = "SELECT * FROM products LIMIT {$startPaging}";
                $getProds = $con->prepare($productSQL);
                $getProds->execute();
                $prods = $getProds->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">          
        <title>Home - Commonwealth Trailer Parts</title>
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
    </head>
    <body>
        <!-- create the naviagation for the page -->
        <nav class="navbar navbar-expand-md navbar-light noPad justify-content-center">
            <div class="container noPad">
                <a class="navbar-brand" href="index.html"><img src="images/cmwtrlparts.png"></a>
                <button class="navbar-toggler mr-4" type="button" data-toggle="collapse" data-target="#subMenu" aria-controls="subMenu" aria-expanded="false" aria-label="Toggle Navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse align-self-end" id="subMenu">
                    <ul class="navbar-nav nav-tabs">
                        <li class="nav-item active">
                            <a class="nav-link" href="about.html" style="color:#212121;">ABOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html" style="color:#212121">CONTACT</a>
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
        
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-2">
                test
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="container">
                            <?php echo $lPrev;
                            for($i=1; $i <= $lastPage; $i++) : ?>
                            <a href="products.php?page=<?php echo $i ?>&per=<?php echo $per; ?>"><?php echo $i ?></a>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 offset-md-1">
                        test
                        </div>
                        <div class="col-md-2">
                        test
                        </div>
                        <div class="col-md-2">
                        test
                        </div>
                        <div class="col-md-2">
                        test
                        </div>
                        <div class="col-md-2">
                        test
                        </div>
                    </div>
                </div>
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
</html>