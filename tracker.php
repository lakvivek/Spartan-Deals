<?php
session_start();
$getId = $_GET['id'];
$id = $getId[0];
$store = array(
    1 => "mtv",
    2 => "kadart",
    3 => "ice",
    4 => "cold",
    5 => "home",
    6 => "fashion"
);
$key = $store[$id];
function get_data($url)
{
    $curl = curl_init();
    $timeout = 5;
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

if(isset($getId)) {
    if($getId == 1) {
        $content = get_data('http://deowanshi.me/prod_market_place.php');
    } else if($getId == 2) {
        $content = get_data('http://kadart.kademane.com/prod_market_place.php');
    } else if($getId == 3) {
        $content = get_data('http://www.icemodders.biz/prod_market_place.php');
    } else if($getId == 4) {
        $content = get_data('http://renup.org/product_marketplace.php');
    } else if($getId == 5) {
        $content = get_data('http://smithavenkatesh.com/product_marketplace.php');
    } else if($getId == 6) {
        $content = get_data('http://www.lvivek.com/prod_market_place.php');
    }
}
$rows = json_decode($content, true);

?>


<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Spartan Deals</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id"
          content="199118433992-ln3nj31q0u10h01egspqdccit655jhhb.apps.googleusercontent.com">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,400italic,600' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/social-likes_classic.css">
    <link rel="stylesheet" href="css/venobox.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <link rel="stylesheet" href="lib/css/nivo-slider.css" type="text/css"/>
    <link rel="stylesheet" href="lib/css/preview.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/meanmenu.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet"
          type="text/css"/>
    <script type="text/javascript">
        (function () {
            var po = document.createElement('script');
            po.type = 'text/javascript';
            po.async = true;
            po.src = 'https://plus.google.com/js/client:plusone.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(po, s);
        })();
    </script>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1689593654679841',
                cookie     : true,
                xfbml      : true,
                version    : 'v2.8'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script>
        function myFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
            if (input.value == '') {
                ul.style.display = 'none';
            } else {
                ul.style.display = 'inline-block';
            }

        }
    </script>
</head>

<body class="home">
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
                                    echo '<li class="menu-item  first"><a href="my-account.html?uid=' . $_SESSION['session_id'] . '">My Account</a></li>
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
                                                                <li class="menu-item active">
                                                                    <a class="item_link" href="tracker.php?id=4">
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
                                                                <li class="menu-item">
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
<div class="clear"></div>
<div class="shop-header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="shop-header-title">
                    <h2>User Tracking</h2>
                    <div class="shop-menu">
                        <ul>
                            <li><a <?php if(isset($getId) && $getId == 4)  echo 'class="active"';?>href="?id=4">Cold Stone</a></li>
                            <li><a <?php if(isset($getId) && $getId == 6)  echo 'class="active"';?>href="?id=6">Fashionista</a></li>
                            <li><a <?php if(isset($getId) && $getId == 5)  echo 'class="active"';?>href="?id=5">Home Decors</a></li>
                            <li><a <?php if(isset($getId) && $getId == 3)  echo 'class="active"';?>href="?id=3">Ice Modders</a></li>
                            <li><a <?php if(isset($getId) && $getId == 2)  echo 'class="active"';?>href="?id=2">kadart</a></li>
                            <li><a <?php if(isset($getId) && $getId == 1)  echo 'class="active"';?>href="?id=1">MTV Connect</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-container">
    <div class="container">
        <div class="all-product-sidebar-area">
            <div class="row">
                <div class="col-md-9 fix">
                    <div class="all-product-list-grid-area">
                        <div class="row">
                            <!-- Tab panes -->
                            <div class="tab-content text-center">
                                <div role="tabpanel" class="tab-pane active" id="grid">
                                    <div class="ma-bestsellerproductslider-container">
                                        <?php
                                        // output data of each row
                                        if(!isset($_COOKIE[$key + "-tracker"])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE[$key + '-tracker'])) {
                                            $prod = $_COOKIE[$key + '-tracker'];
                                            $prod = stripslashes($prod);    // string is stored with escape double quotes
                                            $prod = json_decode($prod, true);
                                        }
                                        foreach ($prod as $prod_id) {


                                            foreach ($rows as $row ) {
                                                $productId = $row["ProductId"];
                                                $productTag = $row["ProductTag"];
                                                $productName = $row["ProductName"];
                                                $productPrice = $row["ProductPrice"];
                                                $productDesc = $row["ProductDesc"];
                                                $MRP = (int)$productPrice + 2;
                                                if ($prod_id == $productId) {
                                                    echo '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <div class="single-item">
                                            <div class="s-product-img">
                                                <a href="product.html?pid='.$productId .'">
                                                    <img alt="" src="img/product/' .  $productId . '.jpg" class="primary-image">
                                                </a>
                                                <div class="price-rate">
                                                    <!-- Single product hover view-->
                                                    <div class="global-table">
                                                        <div class="global-row">
                                                            <div class="global-cell">
                                                                <div class="hover-view-content">
                                                                    <a href="shop-category.html#" class="modal-view detail-link quickview" data-toggle="modal" data-target="#productModal' . $productId . '">Quick View</a>
                                                                    <div class="ratings">
                                                                        <ul>
                                                                            <li>
                                                                                <div class="star">
                                                                                    <span class="yes"><i class="fa fa-star-o"></i></span>
                                                                                    <span class="yes"><i class="fa fa-star-o"></i></span>
                                                                                    <span class="yes"><i class="fa fa-star-o"></i></span>
                                                                                    <span class="yes"><i class="fa fa-star-o"></i></span>
                                                                                    <span><i class="fa fa-star-o"></i></span>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="price-box">
                                                                        <p class="special-price"><span class="price">$' . $productPrice . '</span></p>
                                                                        <p class="old-price"> <span class="price"><del>$'. $MRP . '</del></span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/ Single product hover view-->
                                                </div>
                                                <div class="pro-action">
                                                    <div class="product-cart-area-list">
                                                        <div class="cart-btn btn-add-to-cart"><a href="shop-category.html#"><i class="fa fa-shopping-cart"></i>ADD TO CART
                                                        </a></div>
                                                        <div class="cart-btn right link-compare"><a href="shop-category.html#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist" ><i class="fa fa-heart-o"></i>
                                                        </a></div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-title">
                                                <a href="product.html?pid='.$productId .'">' . $productName . '</a>
                                            </div>
                                        </div>
                                    </div>';
                                                }
                                            }
                                        }
                                        ?>
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


<div class="footer">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 col-xs-12 fix">
                    <div class="bottom_menu">
                        <div class="menu-customer-care-container">
                            <nav>
                                <ul class="nav_menu">
                                    <li class="menu-item"><a href="index.html">Home</a></li>
                                    <li class="menu-item"><a href="shop.html">Shop </a></li>
                                    <li class="menu-item"><a href="about.html">About</a></li>
                                    <li class="menu-item"><a href="news.html">News</a></li>
                                    <li class="menu-item"><a href="contact.html">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="copyright-info"> Copyright &copy; 2017 <a href="http://lvivek.com/">Lakshmanan
                            Vivek </a> All Rights Reserved
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="login-modal" class="modal fade login" aria-labelledby="myModalLabel" tabindex="-1" role="dialog">
    <div class="modal-dialog login animated">
        <form id="login-form" action="index.html" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onClick="window.location.reload()" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title">Login with</h4>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div>
                                <fb:login-button scope="public_profile,email" onlogin="fbLogin();">
                                </fb:login-button>

                            </div>
                            <hr style="clear:both;">
                            <div class="g-signin2"  data-onsuccess="onSignIn">
                            </div>

                            <div class="division">
                                <div class="line l"></div>
                                <span>or</span>
                                <div class="line r"></div>
                            </div>

                            <script type="text/javascript">
                                function onSignIn(googleUser) {
                                    var profile = googleUser.getBasicProfile();
                                    var email = profile.getEmail();
                                    var name = profile.getName();
                                    name = name.split(" ");
                                    signOut();
                                    $.post('socialauth.php', {
                                        email: email,
                                        firstName: name[0],
                                        lastName: name[1]
                                    }).done(function (data) {
                                        window.location.reload();
                                    });
                                    closeModal();
                                }

                                function signOut() {
                                    var auth2 = gapi.auth2.getAuthInstance();
                                    auth2.signOut().then(function () {
                                        console.log('User signed out.');
                                    });
                                }

                                function fbLogin() {
                                    FB.login(function (response) {
                                        if (response.status === 'connected') {
                                            console.log("connected");
                                            // Logged into your app and Facebook.
                                            FB.api('/me', {
                                                fields: 'email,first_name,last_name'
                                            }, function (response) {
                                                $.post('socialauth.php', {
                                                    email: response.email,
                                                    firstName: response.first_name,
                                                    lastName: response.last_name
                                                }).done(function (data) {
                                                    window.location.reload();
                                                });
                                            });
                                        } else {
                                            // The person is not logged into this app or we are unable to tell.
                                            console.log("failed");
                                        }
                                    }, {
                                        scope: 'public_profile,email'
                                    });
                                }

                            </script>

                            <h2>Login Account </h2>
                            <div id="err-msg"></div>

                            <div class="form-group">
                                <input type="text" id="email" name="email" placeholder="email"
                                       class="form-control input-lg"/>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="password" placeholder="Password"
                                       class="form-control input-lg"/>
                            </div>
                            <div class="form-group">
                                <div id="captcha"></div>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="login" name="login" value="login"
                                       class="btn btn-primary btn-block btn-lg"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        Don't have an account? <a href="#sign-modal" data-dismiss="modal" data-toggle="modal">Register
                            Here</a>
                    </div>
                </div>
        </form>
    </div>

</div>
</div>

<div id="sign-modal" class="modal fade login" aria-labelledby="myModalLabel" tabindex="-1" role="dialog">
    <div class="modal-dialog login animated">
        <form id="sign-form" action="index.html" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onClick="window.location.reload()" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title">Register with</h4>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div>
                                <fb:login-button scope="public_profile,email" onlogin="fbLogin();">
                                </fb:login-button>

                            </div>
                            <hr style="clear:both;">


                            <div class="g-signin2" data-onsuccess="onSignIn">
                            </div>

                            <div class="division">
                                <div class="line l"></div>
                                <span>or</span>
                                <div class="line r"></div>
                            </div>


                            <h2>Sign Up to Create Account </h2>
                            <div id="err-msg"></div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Enter Full Name" required
                                       value="<?php if($error) echo $name; ?>" class="form-control"/>
                                <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" name="email" placeholder="Email" required
                                       value="<?php if($error) echo $email; ?>" class="form-control"/>
                                <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" placeholder="Password" required
                                       class="form-control"/>
                                <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Confirm Password</label>
                                <input type="password" name="cpassword" placeholder="Confirm Password" required
                                       class="form-control"/>
                                <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                            </div>
                            <div class="form-group">
                                <div id="captcha"></div>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="signup" class="btn btn-primary " value="signup">
                                </input>

                            </div>
                        </div>
        </form>
        <div class="modal-footer">
            <div class="col-md-4 col-md-offset-4 text-center">
                Already Registered? <a href="#login-modal" data-dismiss="modal" data-toggle="modal">Login Here</a>
            </div>
        </div>
    </div>
</div>

<script src="js/vendor/jquery-1.11.3.min.js"></script>
<script src="lib/js/jquery.nivo.slider.js" type="text/javascript"></script>
<script src="lib/home.js" type="text/javascript"></script>
</body>
</html>
