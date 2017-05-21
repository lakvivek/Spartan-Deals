<?php
session_start();
$servername = "iamvivek.ipagemysql.com";
$username = "vivek";
$password = "vivek123";
$dbname = "marketplace";


if(isset($_SESSION['session_user'])) {
echo 'hello';

echo 'session value is-->' . $_SESSION['session_user'];
}

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

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$email = stripcslashes($email);
$password = stripcslashes($password);
$sql = "SELECT * FROM User where UserEmail = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$sql_username = $row['UserEmail'];
$sql_password = $row['UserPassword'];
if ($sql_username == $email && $sql_password == $password ){
$_SESSION['session_user'] = $sql_username;
$_SESSION['session_id'] = $row['UserId'];
echo '
<script type="text/javascript"> alert("Successfully, logged in."); </script>';
}
else {
echo '
<script type="text/javascript"> alert("Failed to login. Give proper credentials."); </script>';
}
}
}
}

$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

//name can contain only alpha characters and space
if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
$error = true;
$name_error = "Name must contain only alphabets and space";
}
if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
$error = true;
$email_error = "Please Enter Valid Email ID";
}
if(strlen($password) < 6) {
$error = true;
$password_error = "Password must be minimum of 6 characters";
}
if($password != $cpassword) {
$error = true;
$cpassword_error = "Password and Confirm Password doesn't match";
}
if (!$error){
$sql = "INSERT INTO User (UserName, UserPassword, UserEmail)
VALUES ('$name', '$password', '$email')";

if ($conn->query($sql) === TRUE) {
echo '
<script type="text/javascript"> alert("Successfully, Registered"); </script>';
} else {
echo '
<script type="text/javascript"> alert("Failed to register, give proper details."); </script>';
}
}
}

unset($_POST);
?>
<!doctype html>
<html class="no-js" lang="">
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
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<header>
    <div class="header-container">
        <div class="container">
            <div class="top-bar">
                <div class="topbar-content">
                    <div class="header-email widget">
                        <i class="fa fa-envelope"></i><strong>Email:</strong> <a
                            href="mailto:viveklakshmanan@live.com ">spartan-deals@live.com </a>
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
                                <li class="menu-item"><a href="shop.html">Shopping Cart</a></li>
                                <li class="menu-item"><a href="checkout.php">Checkout</a></li>
                                <li class="menu-item"><a href="logout.php" onclick="closeModal()">Logout</a></li>
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
                                                                <li class="menu-item active">
                                                                    <a class="item_link" href="index.html">
															<span class="link_content">
																<span class="link_text">Home</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item megamenu_list">
                                                                    <a class="item_link" href="shop.html?id=4">
															<span class="link_content">
																<span class="link_text">Shop</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="tracker.php?id=4">
															<span class="link_content">
																<span class="link_text">Tracker</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="#">
															<span class="link_content">
																<span class="link_text">About</span>
															</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item">
                                                                    <a class="item_link" href="#">
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
            <div class="nav-container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="left-category-menu hidden-sm hidden-xs">
                                <div class="left-product-cat">
                                    <div class="category-heading">
                                        <h2>categories</h2>
                                    </div>
                                    <div class="category-menu-list" style="display: none;">
                                        <ul>
                                            <li class="arrow-plus">
                                                <a href="shop.html?id=4"><span class="cat-thumb "><i
                                                        class="fa fa-laptop"></i></span>Cold stone</a>
                                            </li>
                                            <li class="arrow-plus">
                                                <a href="shop.html?id=6"><span class="cat-thumb "><i
                                                        class="fa fa-laptop"></i></span>Fashionista</a>
                                            </li>
                                            <li class="arrow-plus">
                                                <a href="shop.html?id=5"><span class="cat-thumb "><i
                                                        class="fa fa-laptop"></i></span>Home-Decors</a>
                                            </li>
                                            <li class="arrow-plus">
                                                <a href="shop.html?id=3"><span class="cat-thumb "><i
                                                        class="fa fa-laptop"></i></span>Ice-Modders</a>
                                            </li>
                                            <li class="arrow-plus">
                                                <a href="shop.html?id=2"><span class="cat-thumb "><i
                                                        class="fa fa-laptop"></i></span>Kadart</a>
                                            </li>
                                            <li class="arrow-plus">
                                                <a href="shop.html?id=1"><span class="cat-thumb "><i
                                                        class="fa fa-laptop"></i></span>MTV Connect</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="search-cart-list">
                                <div class="header-search">
                                    <div class="cate-toggler">
                                        <input type="text" placeholder="search for products" id="myInput"
                                               onkeyup="myFunction()">
                                        <button>
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                    <div class="product-category">
                                        <ul id="myUL">
                                            <li><a href="shop.html?id=4"><b>ColdStone</b></a></li>
                                            <li><a href="shop.html?id=4">Caramel Machiato</a></li>
                                            <li><a href="shop.html?id=4">Cafe Misto</a></li>
                                            <li><a href="shop.html?id=4">Vanilla Sweet Cream Cold Brew</a></li>
                                            <li><a href="shop.html?id=4">Nitro Cold Brew</a></li>
                                            <li><a href="shop.html?id=4">Iced Coffee</a></li>
                                            <li><a href="shop.html?id=4">Coconut Mocha Machiato</a></li>
                                            <li><a href="shop.html?id=4">Iced Cinnamon Almond Milk Machiato</a></li>
                                            <li><a href="shop.html?id=4">Vanilla Sweet Cream Cold Brew</a></li>
                                            <li><a href="shop.html?id=4">Chocolate Smoothie</a></li>
                                            <li><a href="shop.html?id=4">Java Chip Frappuchino</a></li>
                                            <li><a href="shop.html?id=4">Cafe Bean Creme Mocha</a></li>
                                            <li><a href="shop.html?id=4">Latte Machiato</a></li>
                                            <li><a href="shop.html?id=6"><b>Fashionista</b></a></li>
                                            <li><a href="shop.html?id=6">Long Jacket</a></li>
                                            <li><a href="shop.html?id=6">Black Coat</a></li>
                                            <li><a href="shop.html?id=6">Layered Tees</a></li>
                                            <li><a href="shop.html?id=6">Layered T-shirt</a></li>
                                            <li><a href="shop.html?id=6">Imported T-shirt</a></li>
                                            <li><a href="shop.html?id=6">Silk Tops</a></li>
                                            <li><a href="shop.html?id=6">Layered Shirt</a></li>
                                            <li><a href="shop.html?id=6">Blue Shirt</a></li>
                                            <li><a href="shop.html?id=6">Shirt & Belt</a></li>
                                            <li><a href="shop.html?id=6">Leather Jacket</a></li>
                                            <li><a href="shop.html?id=6">White Tops & Brown Jacket</a></li>
                                            <li><a href="shop.html?id=5"><b>Home Decors</b></a></li>
                                            <li><a href="shop.html?id=5">San Francicso Skyline</a></li>
                                            <li><a href="shop.html?id=5">Blue Rich Painting</a></li>
                                            <li><a href="shop.html?id=5">National Park Alaska</a></li>
                                            <li><a href="shop.html?id=5">Wall Art Oil Painting</a></li>
                                            <li><a href="shop.html?id=5">Canvas Wild Animal Print</a></li>
                                            <li><a href="shop.html?id=5">Abstract Hand Canvas Painting</a></li>
                                            <li><a href="shop.html?id=5">World Map On Wood</a></li>
                                            <li><a href="shop.html?id=5">Venice Canal Wrapped Canvas</a></li>
                                            <li><a href="shop.html?id=5">Brownstone Framed Art</a></li>
                                            <li><a href="shop.html?id=5">Palm Leaves Wood Flushmount</a></li>
                                            <li><a href="shop.html?id=5">Framed Hanging Vase</a></li>
                                            <li><a href="shop.html?id=5">Abstract Framed Canvas Wall Art</a></li>
                                            <li><a href="shop.html?id=3"><b>Ice Modders</b></a></li>
                                            <li><a href="shop.html?id=3">Amplifiers</a></li>
                                            <li><a href="shop.html?id=3">Speakers</a></li>
                                            <li><a href="shop.html?id=3">Seat Covers</a></li>
                                            <li><a href="shop.html?id=3">Display Screen</a></li>
                                            <li><a href="shop.html?id=3">Sub Woofers</a></li>
                                            <li><a href="shop.html?id=3">Stero</a></li>
                                            <li><a href="shop.html?id=3">Lights</a></li>
                                            <li><a href="shop.html?id=3">Perfume</a></li>
                                            <li><a href="shop.html?id=3">Maintanence Kit</a></li>
                                            <li><a href="shop.html?id=3">Installation</a></li>
                                            <li><a href="shop.html?id=3">Wheels</a></li>
                                            <li><a href="shop.html?id=3">Tyre</a></li>
                                            <li><a href="shop.html?id=2"><b>Kadart</b></a></li>
                                            <li><a href="shop.html?id=2">Avatar Eye</a></li>
                                            <li><a href="shop.html?id=2">Beautiful Sunset</a></li>
                                            <li><a href="shop.html?id=2">Might Brains Steve Jobs</a></li>
                                            <li><a href="shop.html?id=2">Mother</a></li>
                                            <li><a href="shop.html?id=2">Crayonic Sunset</a></li>
                                            <li><a href="shop.html?id=2">Thalaiva</a></li>
                                            <li><a href="shop.html?id=2">Smile</a></li>
                                            <li><a href="shop.html?id=2">Hobbit Home</a></li>
                                            <li><a href="shop.html?id=2">Mother's Love</a></li>
                                            <li><a href="shop.html?id=2">Eye Art</a></li>
                                            <li><a href="shop.html?id=2">Silence</a></li>
                                            <li><a href="shop.html?id=2">Thinking of him</a></li>
                                            <li><a href="shop.html?id=1"><b>Gift Curiosly</b></a></li>
                                            <li><a href="shop.html?id=1">Men's Health Book</a></li>
                                            <li><a href="shop.html?id=1">Lure Retirement</a></li>
                                            <li><a href="shop.html?id=1">The Tao of Dating</a></li>
                                            <li><a href="shop.html?id=1">Dating Advice for Men</a></li>
                                            <li><a href="shop.html?id=1">Happer Mug</a></li>
                                            <li><a href="shop.html?id=1">Large Red Bouquet</a></li>
                                            <li><a href="shop.html?id=1">Large Purple Bouquet</a></li>
                                            <li><a href="shop.html?id=1">Small Rose Bouquet</a></li>
                                            <li><a href="shop.html?id=1">White Mug</a></li>
                                            <li><a href="shop.html?id=1">Panda Mug</a></li>
                                            <li><a href="shop.html?id=1">Huffle Puf Mug</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="cart-total">
                                    <ul>
                                        <li>
                                            <a href="shopping-cart.php" class="cart-toggler">
												<span class="cart-no"><i class="fa fa-shopping-cart"></i> My cart : <?php if(isset($_SESSION["cart_products"]))
												{ print count($_SESSION["cart_products"]); }?> items</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="mini_cart_inner">
                                        <ul class="cart_list">
                                            <?php if(isset($_SESSION["cart_products"]) && isset($_SESSION['session_user']))
										{
											foreach ( $_SESSION["cart_products"] as $key => $value) {
                                            $productId = (string)$key;
                                            $content="";
                                            if($productId[0]==1){
                                            $content = get_data('http://deowanshi.me/prod_market_place.php');
                                            } else if($productId[0] == 2) {
                                            $content = get_data('http://kadart.kademane.com/prod_market_place.php');
                                            } else if($productId[0]== 3) {
                                            $content = get_data('http://www.icemodders.biz/prod_market_place.php');
                                            } else if($productId[0] == 4) {
                                            $content = get_data('http://renup.org/product_marketplace.php');
                                            } else if($productId[0] == 5) {
                                            $content = get_data('http://smithavenkatesh.com/product_marketplace.php');
                                            } else if($productId[0] == 6) {
                                            $content = get_data('http://www.lvivek.com/prod_market_place.php');
                                            }
                                            $rows = json_decode($content, true);

                                            foreach ($rows as $row ) {
                                            if($row["ProductId"]==$productId)
                                            {
                                            $productId = $row["ProductId"];
                                            $productName = $row["ProductName"];
                                            $productPrice = $row["ProductPrice"];
                                            echo '
                                            <li>
                                                <a class="product-image" href="#">
                                                    <img alt="" src="img/product/' .  $productId . '.jpg"
                                                         class="primary-image">
                                                </a>
                                                <div class="product-details">
                                                    <a class="product-name" href="index.html#">'.$productName.'</a>
                                                    <span class="cart-price-box">
																<span class="amount">$'.$productPrice.'</span>
															</span>
                                                </div>
                                            </li>
                                            ';

                                            }

                                            }
                                            }
                                            }
                                            ?>
                                        </ul>
                                        <p class="buttons">
                                            <a href="checkout.php#" class="button checkout wc-forward">Checkout</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="slider-area">
    <div>
        <div id="ensign-nivoslider" class="slides"><img src="img/sliders/slider-1/bg-1.png" alt=""
                                                        title="#slider-direction-1"/></div>
        <div id="slider-direction-1" class="t-cn slider-direction slider-one">
            <div class="layer-1-1"><img style="margin-left: 60px;" src="img/sliders/slider-1/lily.png" alt=""/></div>
            <div class="layer-1-2">
                <h5 class="title2">The spring collection 2017</h5>
            </div>
            <div class="layer-1-3">
                <h3 class="title3">Exclusive</h3>
            </div>
            <div class="layer-1-4 hidden-sm hidden-xs"><img src="img/sliders/slider-1/3.png" alt=""/></div>
            <div class="layer-1-5">
                <h3 class="title5">Deals</h3>
            </div>
            <div class="layer-1-6"><img src="img/sliders/slider-1/4.png" alt=""/></div>
            <div class="layer-1-7">
                <h5 class="title7">Sale up to 70% on featured products</h5>
            </div>
        </div>
    </div>
</section>
<div class="main-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-6">
                <div class="banner-content-padding">
                    <div class="banner-img"><a href="#"><img src="img/banners/shoes-collection.jpg"
                                                             alt="banner picture"/></a></div>
                </div>
            </div>
            <div class="col-md-7 col-sm-6">
                <div class="banner-content-padding">
                    <div class="banner-content">
                        <h2>discounts upto <strong style="color:hsla(116,54%,54%,1.00)">70%</strong></h2>
                        <h1>Great Deals</h1>
                        <p><a href="shop.html" class="button">VIEW COLLECTION</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="new-product-area">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <div class="col-md-12">
                    <h3><span>TOP PRODUCTS</span>
                        <i class="cross-icon"><i></i></i>
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="new-product-list">
                <div class="col-md-12 text-center fix">
                    <div class="tab-menu">
                        <!-- Nav tabs -->
                        <ul id="store" class="nav nav-tabs" role="tablist">
                            <li data-input="0" role="presentation" class="active">
                                <a href="index.html#all" aria-controls="all" role="tab" data-toggle="tab">All</a>
                            </li>
                            <li data-input="4" role="presentation">
                                <a href="index.html#cold" aria-controls="cold" role="tab" data-toggle="tab">COLD
                                    STONE</a>
                            </li>
                            <li data-input="6" role="presentation">
                                <a href="index.html#fashion" aria-controls="fashion" role="tab" data-toggle="tab">FASHIONISTA</a>
                            </li>
                            <li data-input="5" role="presentation">
                                <a href="index.html#home" aria-controls="home" role="tab" data-toggle="tab">HOME
                                    DECORS</a>
                            </li>
                            <li data-input="3" role="presentation">
                                <a href="index.html#ice" aria-controls="ice" role="tab" data-toggle="tab">ICE
                                    MODDERS</a>
                            </li>
                            <li data-input="2" role="presentation">
                                <a href="index.html#kadart" aria-controls="kadart" role="tab"
                                   data-toggle="tab">KADART</a>
                            </li>
                            <li data-input="1" role="presentation">
                                <a href="index.html#mtv" aria-controls="mtv" role="tab" data-toggle="tab">MTV
                                    CONNECT</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="clear"></div>
                <div class="tab-content product-list">
                    <div class="tab-pane fade active in" id="all">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.html#all1" aria-controls="all1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#all2" aria-controls="all2" role="tab"
                                       data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#all3" aria-controls="all3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#all4" aria-controls="all4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="all1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $sql = "SELECT * FROM `Product` LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="all2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['all'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['all'])) {
                                        $prod = $_COOKIE['all'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="all3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId group by A.ProductId order by AVG(Rating) desc Limit 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="all4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId group by A.ProductId order by count(*) desc  LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="cold">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.html#cold1" aria-controls="cold1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#cold2" aria-controls="cold2" role="tab"
                                       data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#cold3" aria-controls="cold3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#cold4" aria-controls="cold4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="cold1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 4;
                                        $sql = "SELECT * FROM `Product` WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . " LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="cold2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['cold'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['cold'])) {
                                        $prod = $_COOKIE['cold'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="cold3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 4;
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by AVG(Rating) desc Limit 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in " id="cold4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 4;
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by count(*) desc LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="fashion">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.html#fashion1" aria-controls="fashion1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#fashion2" aria-controls="fashion2" role="tab" data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#fashion3" aria-controls="fashion3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#fashion4" aria-controls="fashion4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="fashion1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 6;
                                        $sql = "SELECT * FROM `Product` WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . " LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ fashioninsta item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="fashion2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['fashion'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['fashion'])) {
                                        $prod = $_COOKIE['fashion'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ fashioninsta item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="fashion3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 6;
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by AVG(Rating) desc Limit 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ fashioninsta item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="fashion4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 6;
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by count(*) desc LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ fashioninsta item End -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="home">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.html#home1" aria-controls="home1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#home2" aria-controls="home2" role="tab"
                                       data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#home3" aria-controls="home3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#home4" aria-controls="home4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 5;
                                        $sql = "SELECT * FROM `Product` WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . " LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ home decor item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="home2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['home'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['home'])) {
                                        $prod = $_COOKIE['home'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ home decor item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="home3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 5;
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by AVG(Rating) desc Limit 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ home decor item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="home4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 5;
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by count(*) desc LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ home decor item End -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ice">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.html#ice1" aria-controls="ice1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#ice2" aria-controls="ice2" role="tab"
                                       data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#ice3" aria-controls="ice3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#ice4" aria-controls="ice4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="ice1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 3;
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by AVG(Rating) desc Limit 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ ice modder item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="ice2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['ice'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['ice'])) {
                                        $prod = $_COOKIE['ice'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ ice modder item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="ice3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 3;
                                        $sql = "SELECT * FROM `Product` WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . " LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ ice modder item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="ice4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 3;
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by count(*) desc LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ ice modder item End -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kadart">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.html#kadart1" aria-controls="kadart1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#kadart2" aria-controls="kadart2" role="tab" data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#kadart3" aria-controls="kadart3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#kadart4" aria-controls="kadart4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="kadart1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 2;
                                        $sql = "SELECT * FROM `Product` WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . " LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ kadart item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="kadart2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['kadart'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['kadart'])) {
                                        $prod = $_COOKIE['kadart'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ kadart item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="kadart3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 2;
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by AVG(Rating) desc Limit 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ kadart item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="kadart4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 2;
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by count(*) desc LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ kadart item End -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="mtv">
                        <div class="tabbable">
                            <ul class="nav nav-tabs text-center fix">
                                <li role="presentation" class="active">
                                    <a href="index.html#mtv1" aria-controls="mtv1" role="tab" data-toggle="tab">Most
                                        Visited</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#mtv2" aria-controls="mtv2" role="tab"
                                       data-toggle="tab">Recent</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#mtv3" aria-controls="mtv3" role="tab" data-toggle="tab">Top
                                        Rated</a>
                                </li>
                                <li role="presentation">
                                    <a href="index.html#mtv4" aria-controls="mtv4" role="tab" data-toggle="tab">Top
                                        Commented</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="mtv1">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 1;
                                        $sql = "SELECT * FROM `Product` WHERE ProductId > " . $id*1000 . " and ProductId
                                        < ". ($id + 1)*1000 . " LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ mtv item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="mtv2">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        if(!isset($_COOKIE['mtv'])) {
                                            echo "<p class='text-center'> No Data to display</p>";
                                        }
                                        if(isset($_COOKIE['mtv'])) {
                                        $prod = $_COOKIE['mtv'];
                                        $prod = stripslashes($prod); // string is stored with escape double quotes
                                        $prod = json_decode($prod, true);
                                        $first = $prod['1st'];
                                        $second = $prod['2nd'];
                                        $third = $prod['3rd'];
                                        $fourth = $prod['4th'];
                                        $fifth = $prod['5th'];

                                        $sql = "SELECT * FROM `Product` where Productid IN ('" . $first . "','" .
                                        $second . "','" . $third . "','" . $fourth . "','" . $fifth . "') LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ mtv item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="mtv3">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 1;
                                        $sql = "SELECT avg(Rating) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by AVG(Rating) desc Limit 5";

                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ mtv item End -->
                                <div role="tabpanel" class="tab-pane fade in " id="mtv4">
                                    <div class="product-owl-active  indicator-style">
                                        <?php
                                        $id = 1;
                                        $sql = "Select count(*) , B.* from Review A , Product B WHERE A.ProductId = B.ProductId and B.ProductId >
                                        " . $id*1000 . " and B.ProductId < ". ($id + 1)*1000 . " group by A.ProductId
                                        order by count(*) desc LIMIT 5";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                        $productId = $row["ProductId"];
                                        $productTag = $row["ProductTag"];
                                        $productName = $row["ProductName"];
                                        $productPrice = $row["ProductPrice"];
                                        $productDesc = $row["ProductDesc"];
                                        $MRP = (int)$productPrice + 2;
                                        echo '<!-- single group start -->
                                        <div class="product-group">
                                            <!-- single item start -->
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="single-item">
                                                        <div class="s-product-img">
                                                            <!-- sale - new  -->
                                                            <div class="sticker-icon">
                                                                <span class="sticker-bg"></span>
                                                                <span class="sale sticker-text">sale</span>
                                                            </div>
                                                            <!--/ sale - new -->
                                                            <a href="index.html#">
                                                                <img alt="" src="img/product/' . $productId . '.jpg"
                                                                     class="primary-image">
                                                            </a>
                                                            <div class="price-rate">
                                                                <!-- Single product hover view-->
                                                                <div class="global-table">
                                                                    <div class="global-row">
                                                                        <div class="global-cell">
                                                                            <div class="hover-view-content">
                                                                                <a href="index.html#"
                                                                                   class="modal-view detail-link quickview"
                                                                                   data-toggle="modal"
                                                                                   data-target="#productModal">Quick
                                                                                    View</a>
                                                                                <div class="ratings">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <div class="star">
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span class="yes"><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                                <span><i
                                                                                                        class="fa fa-star-o"></i></span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="price-box">
                                                                                    <p class="special-price"><span
                                                                                            class="price">$' . $productPrice . '</span>
                                                                                    </p>
                                                                                    <p class="old-price"><span
                                                                                            class="price"><del>$' . $MRP . '</del></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/ Single product hover view-->
                                                            </div>
                                                            <div class="pro-action">
                                                                <div class="product-cart-area-list">
                                                                    <div class="cart-btn btn-add-to-cart"><a
                                                                            href="index.html#"><i
                                                                            class="fa fa-shopping-cart"></i>ADD TO CART
                                                                    </a></div>
                                                                    <div class="cart-btn right link-compare"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                            class="fa fa-heart-o"></i>
                                                                    </a></div>
                                                                    <div class="cart-btn right link-wishlist"><a
                                                                            href="index.html#" data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Add To Compare"><i
                                                                            class="fa fa-retweet"></i>
                                                                    </a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-title">
                                                            <a href="index.html#">' . $productName . '</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- single item end -->
                                        </div>
                                        ';
                                        }
                                        }
                                        ?>
                                        <!-- single group end -->
                                    </div>
                                </div>
                                <!--/ mtv item End -->
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
                                    <li class="menu-item"><a href="shop.html?id=4">Shop </a></li>
                                    <li class="menu-item"><a href="about.php">About</a></li>
                                    <li class="menu-item"><a href="news.php">News</a></li>
                                    <li class="menu-item"><a href="contact.php">Contact</a></li>
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
                                <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                                </fb:login-button> 

                            </div>
                            <hr style="clear:both;">


                                <div class="g-signin2" href="" data-onsuccess="onSignIn">
                                </div>

                            <div class="division">
                                <div class="line l"></div>
                                <span>or</span>
                                <div class="line r"></div>
                            </div>

                            <script type="text/javascript">
                                function onSignIn(googleUser) {
                                    var profile = googleUser.getBasicProfile();

                                    var data = [];
                                    data.push(profile.getName());
                                    data.push(profile.getEmail());

                                    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
                                    console.log('Name: ' + profile.getName());
                                    console.log('Image URL: ' + profile.getImageUrl());
                                    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
                                    console.log(profile);
                                    closeModal();

                                }

                                function closeModal() {
                                    <?php
                                    $_SESSION['session_user'] = "google";
                                    $_SESSION['session_id'] = "google";
                                    ?>
                                    signOut();
                                    window.location.reload();
                                }

                                function signOut() {
                                    var auth2 = gapi.auth2.getAuthInstance();
                                    auth2.signOut().then(function () {
                                        console.log('User signed out.');
                                    });
                                }

                                function checkLoginState() {
                                      FB.getLoginStatus(function(response) {
                                        statusChangeCallback(response);
                                      });
                                    }
                                        function statusChangeCallback(response) {
                                        FB.login(function(response) {
                                                                                    console.log(response);

                                            if (response.authResponse) {
                                                // connected
                                            console.log("checking");

                                            testAPI();
                                            } else {
                                                // cancelled
                                                console.log("cancelled");
                                            }
                                        }, { scope: 'email' });
                                        }

                                  function testAPI() {

                                    console.log('Welcome!  Fetching your information.... ');
                                    FB.api(  '/me?fields=id,email,first_name,last_name', function(response) { console.log('Successful login for: ' + response.name); console.log(JSON.stringify(response)); });
                                 <?php
                                     $_SESSION['session_user'] = "fb";
                                     $_SESSION['session_id'] = "fb";
                                 ?>
                                    window.location.reload();
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
                                <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                                </fb:login-button> 

                            </div>
                            <hr style="clear:both;">


                                <div class="g-signin2" href="">
                                    <i class="fa fa-github fa-fw" data-onsuccess="onSignIn"></i>
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
<script src="js/bootstrap.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery-price-slider.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.mixitup.js"></script>
<script src="js/jquery.meanmenu.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/social-likes.min.js"></script>
<script src="js/venobox.js"></script>
<script src="lib/js/jquery.nivo.slider.js" type="text/javascript"></script>
<script src="lib/home.js" type="text/javascript"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

</body>
</html>