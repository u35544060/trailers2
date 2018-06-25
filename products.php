<!DOCTYPE html>

<?php 

require 'scripts/php/dbConnect.php';

//start session to store cart items array
session_start();

//if no items are already in cart set the session variable equal to an empty array
if(!isset($_SESSION['cartItems'])) {
    $_SESSION['cartItems'] = array();
}

if(!isset($_SESSION['cartCount'])) {
    $_SESSION['cartCount'] = 0;
}

//if someone tries to add something to the cart do the following
if(isset($_POST['sku'])) {
    //set a temporary array for the product being added
    $newProd['id'] = $_POST['id'];
    $newProd['sku'] = $_POST['sku'];
    
    //if the product is already in the array do nothing, if it isn't add it to the session array also adjust count in cart
    if(in_array($newProd, $_SESSION['cartItems'])) {
        $_SESSION['cartItems'] = $_SESSION['cartItems'];
    } else {
        array_push($_SESSION['cartItems'], $newProd);
        $_SESSION['cartCount'] = count($_SESSION['cartItems']);
    }
    
}

//find out how many rows are in the table
$countSQL = 'SELECT NULL FROM products';
$countProds = $con->prepare($countSQL);
$countProds->execute();
$numrows = $countProds->rowCount();

//set the number of rows to show per page
if(isset($_GET['per']) && !empty($_GET['per'])) {
    $per = $_GET['per'];
} else {
    $per = 60;
}

$rowsperpage = $per;
//find out total pages
$totalpages = ceil($numrows / $rowsperpage);

//get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
    //cast var as int
    $currentpage = (int) $_GET['currentpage'];
} else {
    //default page num
    $currentpage = 1;
}

//if current page is greater than total pages...
if ($currentpage > $totalpages) {
    //set current page to last page;
    $currentpage = $totalpages;
}

//if current page is less than first page...
if ($currentpage < 1) {
    $currentpage = 1;
}
//the offset of the list, based on current page
$offset = ($currentpage - 1) * $rowsperpage;

$getProdsSQL = "SELECT id, sku, inventory, description, pic FROM products LIMIT $offset, $rowsperpage";
$getProds = $con->prepare($getProdsSQL);
$getProds->execute();
$prods = $getProds->fetchALl(PDO::FETCH_ASSOC);

?>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">          
        <title>Products - Commonwealth Trailer Parts</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js" integrity="sha384-u/bQvRA/1bobcXlcEYpsEdFVK/vJs3+T+nXLsBYJthmdBuavHvAW6UsmqO2Gd/F9" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="scripts/js/cart.js"></script>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/products.css">
    </head>
    
    <style>
              
        @media screen and (max-width: 400px) {
            
            .smallSort {
                text-align: left !important;
                margin-top: 10px !important;
            }
            
            table {
                width: 100%;
            }
        }
        
         
    </style>
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
                        <li class="nav-item dropdown active">
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
        
        <!-- create the bar beneath the nav and the search bar -->
        <div class="filler vcenter">
            <div class="row justify-content-end p-2 smallSearch" style="height: 100%;">
                <div class="col-md-4 text-center align-self-center input-group">
                    <input class="form-control" type="search" placeholder="Search" id="inSearch">
                    <span class="input-group-append">
                        <button class="btn border-left-0" type="button" style="background-color:#f26722;">
                            <i class="fa fa-search" style="color:white;"></i>
                        </button>
                    </span>
                </div> 
            </div>
        </div><!-- end filler -->
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row text-center">
                        <div class="container-fluid">
                            <h3>Products</h3>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
            <div class="row">
                <div class="col-sm-8 offset-sm-2">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="dropdown align-self-center">
                                <span class="mr-1">SHOW</span>
                                <button class="btn btn-secondary dropdown-toggle btn-sm ddDark" type="button" id="ddShow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    60
                                </button>
                                <div class="dropdown-menu" id="smallMenu" aria-labelledby="ddShow">
                                    <a class="dropdown-item smallItem" href="products.php?page=1&per=60">60</a>
                                    <a class="dropdown-item smallItem" href="products.php?page=1&per=120">120</a>
                                    <a class="dropdown-item smallItem" href="products.php?page=1&per=180">180</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-10 text-right align-self-center smallSort">
                            <div class="dropdown">
                                <span class="mr-1">SORT BY</span>
                                <button class="btn btn-secondary dropdown-toggle btn-sm ddDark" type="button" id="ddSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   A-Z
                                </button> 
                                <div class="dropdown-menu ddDark" aria-labelledby="ddSort">
                                    <a class="dropdown-item white" href="products.php?page=1&per=<?php echo $rowsperpage ?>&sort=vend">By Vendor</a>
                                    <a class="dropdown-item white" href="products.php?page=1&per=<?php echo $rowsperpage ?>&sort=az">Alphabetically: A to Z</a>
                                    <a class="dropdown-item white" href="products.php?page=1&per=<?php echo $rowsperpage ?>&sort=za">Alphabetically: Z to A</a>
                                    <a class="dropdown-item white" href="products.php?page=1&per=<?php echo $rowsperpage ?>&sort=new">Newest Available</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
            <div class="row mt-3">
                <div class="col-md-8 offset-md-2">
                    <div class="row text-center">
                        <?php
                        $it = 0;
                            foreach($prods as $p) {
                                $it++;
                                
                                if(empty($p['pic'])) {
                                    $picLoc = 'images/unavailable.png';
                                } else {
                                    $picLoc = 'images/thumbs/' . $p['pic'];
                                }

                                echo '<div class="col-sm-8 col-md-3 col-lg-3 offset-md-0 offset-lg-0 offset-sm-2">';
                                echo '<table><tr"><td>';
                                echo '<img class="mt-1 w-100" src="' . $picLoc . '">';
                                echo '</td></tr>';
                                if (!empty($p['inventory'])) {
                                    echo '<tr><td class="stock">IN STOCK</td></tr>';
                                }
                                echo '<tr><td>';
                                echo '<p class="tiles mt-2">' . $p['sku'] . '</p>';
                                echo '</td</tr>';
                                echo '<tr><td>';
                                echo '<p class="tiles">' . $p['description'];
                                echo '</td></tr>';
                                echo '<tr><td>';
                                echo '<form name="frmAddToCart" method="POST" action="products.php?currentpage=' . $currentpage . '&per=' .$per . '">';
                                echo '<input type="hidden" name="id" value="' . $p['id'] . '">';
                                echo '<input type="hidden" name="sku" value="' . $p['sku'] . '">';
                                echo '<button type="btn" class="btnUpdate mt-2 mb-3" type="submit"><span class="fas fa-shopping-cart mr-1"></span>ADD TO CART</button>';
                                echo '</form></td></tr>';
                                echo '</table>';
                                echo '</div>';
                                
                                if ($it ==4) {
                                    $it = 0;
                                    echo '</div><div class="row text-center">';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    
        <!-- begin pagination section -->
        
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <nav aria-label="Paging">
                    <ul class="pagination justify-content-center">
                        <?php 
                            //set range
                            $range = 3;
                        
                            //check if page is greater than 1 and show appropriate first and previous links
                            if($currentpage > 1) {
                                echo '<li class="page-item btnPageWords">
                                <a class="page-link" href="products.php?currentpage=1&per=' . $per . '">
                                <span aria-hidden="true">First</span>
                                <span class="sr-only">First</span>
                                </a>
                                </li>';
                                
                                //set the previous page number
                                $prevpage = $currentpage -1;
                                
                                echo '<li class="page-item btnPageSym">
                                <a class="page-link" href="products.php?currentpage='. $prevpage . '&per=' . $per . '">
                                <span aria-hidden="true">&laquo</span>
                                <span class="sr-only">Previous</span>
                                </a>
                                </li>';
                                
                            }
                                
                            //loop to show print the range of numbers around current page
                            for($i = ($currentpage - $range); $i < ($currentpage + $range); $i++) {
                                //validate page number
                                if (($i > 0) && ($i <= $totalpages)) {
                                    //if current page make it active
                                    if ($i == $currentpage) {
                                        echo '<li class="page-item"><a class="page-link active" href="#">' . $i . '</a></li>';
                                    } else {
                                        echo '<li class="page-item"><a class="page-link" href="products.php?currentpage='. $i. '&per=' . $per . '">'. $i . '</a></li>';
                                    }
                                }
                            }
                        
                            //if not the last page show forward and last links
                            if ($currentpage != $totalpages) {
                                //set next page
                                $nextpage = $currentpage + 1;
                                
                                echo '<li class="page-item btnPageSym">
                                <a class="page-link" href="products.php?currentpage=' . $nextpage . '&per=' . $per . '">
                                <span aria-hidden="true">&raquo</span>
                                <span class="sr-only">Next</span>
                                </a>
                                </li>';
                                
                                echo '<li class="page-item btnPageWords">
                                <a class="page-link" href="products.php?currentpage=' . $totalpages . '&per=' . $per . '">
                                <span aria-hidden="true">Last</span>
                                <span class="sr-only">Last</span>
                                </a>
                                </li>';
                                
                            }
                        
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
        
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