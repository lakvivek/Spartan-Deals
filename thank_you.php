<?php
session_start();
$counter_session = count($_SESSION["cart_products"]);
if(isset($_POST['Confirm']) && $counter_session != 0) {
    $to = $_POST['email'];
    $from = "spartandeals6@gmail.com";
     
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "Order Placed";
    $message = "Thanks for placing the order.";
    

    $headers = "From: "  . $from;
    
    $emailResult = mail($to,$subject,$message,$headers);
    print $emailResult;
    if($emailResult)
    {

        $no_of_cart_products = count($_SESSION["cart_products"]);
        foreach ( $_SESSION["cart_products"] as $key => $value)
        {
            unset($_SESSION["cart_products"][$key]);
        }
       

    }
    }
    ?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Spartan Deals</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- favicon
    ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <!-- Google Fonts
    ============================================ -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,400italic,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="css/reaction.css" />
    <link rel="stylesheet" type="text/css" href="css/reaction_style.css" />
        

    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- font awesome CSS
    ============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
    ============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- nivo slider CSS
    ============================================ -->
    <link rel="stylesheet" href="lib/css/nivo-slider.css" type="text/css" />
    <link rel="stylesheet" href="lib/css/preview.css" type="text/css" media="screen" />
    <!-- animate CSS
    ============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
    ============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- venobox CSS
    ============================================ -->
    <link rel="stylesheet" href="css/venobox.css">
    <!-- jquery-ui CSS
    ============================================ -->
    <link rel="stylesheet" href="css/jquery-ui.css">
    <!-- meanmenu CSS
    ============================================ -->
    <link rel="stylesheet" href="css/meanmenu.css">
    <!-- main CSS
    ============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- style CSS
    ============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
    ============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <script type="text/javascript" src="js/jreactmin.js"></script>
        <!-- jQuery for Reaction system -->
    <script type="text/javascript" src="js/reaction.js"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Add your site or application content here -->
<header>
    <div class="header-container">
        <div class="container">
            <div class="top-bar">
                <div class="topbar-content">
                    <div class="header-email widget">
                        <i class="fa fa-envelope"></i><strong>Email:</strong> <a
                                href="mailto:viveklakshmanan@live.com ">spartandeals6@gmail.com </a>
                    </div>
                    <div class="header-phone widget"><i class="fa  fa-phone"></i><strong>Phone:</strong><a
                                href="tel:+16692924707"> (669) 272-4707</a></div>
                    <div class="top-menu widget">
                        <div class="menu-top-menu-container">
                            <ul class="nav_menu" id="menu-top-menu">
                                <?php
                                if(isset($_SESSION['session_user'])) {
                                    echo '<li class="menu-item  first"><a href="my-account.html">My Account</a></li>
                                <li class="menu-item"><a href="wishlist.php">My Wishlist</a></li>
                                <li class="menu-item"><a href="shopping-cart.php">Shopping Cart</a></li>
                                <li class="menu-item"><a href="checkout.php">Checkout</a></li>
                                <li class="menu-item"><a href="logout.php">Logout</a></li>
                                ';
                                } else {
                                    echo '
                                <li class="menu-item"><a href="#" data-toggle="modal" data-target="#sign-modal">Sign
                                    up</a></li>
                                <li class="menu-item"><a href="#" data-toggle="modal"
                                                         data-target="#login-modal">Login</a></li>
                                ';
                                }

                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="global-table">
                            <div class="global-row">
                                <div class="global-cell">
                                    <div class="logo">
                                        <a href="index.html" title="Market-Place"><img src="img/logo/logo-1.png"
                                                                                       alt="logo image"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-9 hidden-sm hidden-xs">
                        <div class="horizontal-menu">
                            <div class="global-table">
                                <div class="global-row">
                                    <div class="global-cell">
                                        <div class="visible-large">
                                            <div class="mega_main mega_main_menu" id="mega_main_menu_first">
                                                <div class="menu_holder">
                                                    <div class="menu_inner">
                                                        <nav>
                                                            <ul class="mega_main_menu_ul" id="mega_main_menu_ul_first">
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="index.html">
															<span class="link_content">
																<span class="link_text">Home</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="shop.html?id=4">
															<span class="link_content">
																<span class="link_text">Shop</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="tracker.php">
															<span class="link_content">
																<span class="link_text">Tracker</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="about.html">
															<span class="link_content">
																<span class="link_text">About</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item active">
                                                                    <a class="item_link" href="contact.html">
															<span class="link_content">
																<span class="link_text">Contact Us</span>
															</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 hidden-md hidden-lg">
                        <div class='mobile-menu-area'>
                            <nav id="mobile-menu">
                                <ul>
                                    <li><a href="index.html">Home</a>
                                    </li>
                                    <li><a href="shop.html?id=4">Shop</a>

                                    </li>
                                    <li><a href="#">Tracker</a>

                                    </li>
                                    <li><a href="#">About</a>

                                    </li>
                                    <li><a href="#">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!--/ Header -->
<div class="clear"></div>
<!-- main-container full-width -->
<!-- shop-header-area start -->
<div class="shop-header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="shop-header-title">
                    <h1>Shop All Products</h1>
                    <div class="shop-menu">
                        <ul>
                            <li><a <?php if(isset($getId) && $getId == 4)  echo 'class="active"';?>href="shop.html?id=4">Cold Stone</a></li>
                            <li><a <?php if(isset($getId) && $getId == 6)  echo 'class="active"';?>href="shop.html?id=6">Fashionista</a></li>
                            <li><a <?php if(isset($getId) && $getId == 5)  echo 'class="active"';?>href="shop.html?id=5">Home Decors</a></li>
                            <li><a <?php if(isset($getId) && $getId == 3)  echo 'class="active"';?>href="shop.html?id=3">Ice Modders</a></li>
                            <li><a <?php if(isset($getId) && $getId == 2)  echo 'class="active"';?>href="shop.html?id=2">kadart</a></li>
                            <li><a <?php if(isset($getId) && $getId == 1)  echo 'class="active"';?>href="shop.html?id=1">MTV Connect</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if($counter_session != 0) {
    echo '<h4 align="center">Email Sent. Thank you for placing the order. We will deliver the items to you shortly</h4>';

} else {
    echo '<h4> You have to have product in your cart. :(</h4>';
}
?>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=424901717865586";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  <!-- Your like button code -->
  <h4>Please like and share with facebook for your friends to know your amazing experience with us!</h4>
  <div class="fb-like" data-href="http://lvivek.com/Spartan-Deals/index.html" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
  

  <a href="http://lvivek.com/Spartan-Deals/reaction_fb.html"> Please give your overall review about us here! Click on it!</a>        
          
                <!-- Reaction system end -->
           
    
<!-- shop-header-area end -->
<!-- main-container full-width end -->


<!-- Footer area-->
<div class="footer" style="margin-top: 140px;">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 col-xs-12 fix">
                    <div class="bottom_menu">
                        <div class="menu-customer-care-container">
                            <nav>
                                <ul class="nav_menu">
                                    <li class="menu-item"> <a href="index.html">Home</a> </li>
                                    <li class="menu-item"> <a href="shop.html">Shop </a> </li>
                                    <li class="menu-item"> <a href="#">About</a> </li>
                                    <li class="menu-item"> <a href="#">News</a> </li>
                                    <li class="menu-item"> <a href="#">Contact</a> </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="copyright-info"> Copyright &copy; 2017 <a href="http://lvivek.com/">Spartan Deals </a>
                        All Rights Reserved
                    </div>
                    <div class="copyright-info"> This is for Educational Purpose only. Images and Products are taken
                        from internet
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer area-->


<!-- jquery
============================================ -->
<script src="js/vendor/jquery-1.11.3.min.js"></script>
<!-- bootstrap JS
============================================ -->
<script src="js/bootstrap.min.js"></script>
<!-- wow JS
============================================ -->
<script src="js/wow.min.js"></script>
<!-- price-slider JS
============================================ -->
<script src="js/jquery-price-slider.js"></script>
<!-- collapse JS
============================================ -->
<script src="js/jquery.collapse.js"></script>
<!-- mixitup JS
============================================ -->
<script src="js/jquery.mixitup.js"></script>
<!-- meanmenu JS
============================================ -->
<script src="js/jquery.meanmenu.js"></script>
<!-- owl.carousel JS
============================================ -->
<script src="js/owl.carousel.min.js"></script>
<!-- scrollUp JS
============================================ -->
<script src="js/jquery.scrollUp.min.js"></script>
<!-- social-likes JS
============================================ -->
<script src="js/social-likes.min.js"></script>
<!-- venobox JS
============================================ -->
<script src="js/venobox.js"></script>

<!-- Nivo slider js
============================================ -->
<script src="lib/js/jquery.nivo.slider.js" type="text/javascript"></script>
<script src="lib/home.js" type="text/javascript"></script>
<!-- plugins JS
============================================ -->
<script src="js/plugins.js"></script>
<!-- main JS
============================================ -->
<script src="js/main.js"></script>
</body>
</html>
