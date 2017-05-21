<?php
session_start();

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

#remove cart
if(isset($_POST['Remove_from_Cart']))
{	
	unset($_SESSION["cart_products"][$_POST['Remove_from_Cart']]);
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

	<!-- favicon
    ============================================ -->
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

	<!-- Google Fonts
    ============================================ -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,400italic,600' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

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
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Add your site or application content here -->
<header>
	<div class="header-container">
		<!--header top start-->
		<div class="container">
			<div class="top-bar">
				<div class="topbar-content">
					<div class="header-email widget">
						<i class="fa fa-envelope"></i><strong>Email:</strong> <a href="mailto:viveklakshmanan@live.com ">viveklakshmanan@live.com </a>
					</div>
					<div class="header-phone widget"><i class="fa  fa-phone"></i><strong>Phone:</strong><a href="tel:+16692924707"> (669) 272-4707</a> </div>
					<div class="top-menu widget">
						<div class="menu-top-menu-container">
							<ul class="nav_menu" id="menu-top-menu">
								<li class="menu-item  first"><a href="my-account.html">My Account</a></li>
								<li class="menu-item"><a href="wishlist.php">My Wishlist</a></li>
								<li class="menu-item"><a href="shopping-cart.php">Shopping Cart</a></li>
								<li class="menu-item"><a href="checkout.php">Checkout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--header top end-->
		<div class="header">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<div class="global-table">
							<div class="global-row">
								<div class="global-cell">
									<div class="logo">
										<a href="index.php" title="Market-Place" ><img src="img/logo/logo-1.png" alt="logo image" ></a>
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
																<li >
																	<a class="item_link" href="index.php">
															<span class="link_content">
																<span class="link_text">Home</span>
															</span>
																	</a>
																</li>
																<li class="menu-item active">
																	<a class="item_link" href="shop.php?id=4">
															<span class="link_content">
																<span class="link_text">Shop</span>
															</span>
																	</a>
																</li>
																<li class="menu-item">
																	<a class="item_link" href="blog.php">
															<span class="link_content">
																<span class="link_text">Blog</span>
															</span>
																	</a>
																</li>
																<li class="menu-item">
																	<a class="item_link" href="index.php#">
															<span class="link_content">
																<span class="link_text">Portfolio</span>
															</span>
																	</a>
																</li>
																<li class="menu-item">
																	<a class="item_link" href="index.php#">
															<span class="link_content">
																<span class="link_text">Pages</span>
															</span>
																	</a>
																</li>
																<li class="menu-item">
																	<a class="item_link" href="contact-us.php">
															<span class="link_content">
																<span class="link_text">Contact Us</span>
															</span>
																	</a>
																</li>
															</ul>
														</nav>
													</div>
													<!-- /class="menu_inner" -->
												</div>
												<!-- /class="menu_holder" -->
											</div>
											<!-- /id="mega_main_menu" -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 hidden-md hidden-lg">
						<!-- Main Menu End -->
						<div class='mobile-menu-area'>
							<nav id="mobile-menu">
								<ul>
									<li><a href="index.html">Home</a>
									</li>
									<li><a href="shop.html">Shop</a>

									</li>
									<li><a href="blog.php">Blog</a>

									</li>
									<li><a href="portfolio-detailas.php">Portfolio</a>

									</li>
									<li><a href="index.html#">Pages</a>
									</li>
								</ul>
							</nav>
						</div>
						<!-- Main Menu End -->
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
<div class="main-container">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
			</div>
		</div>
		
		<div class="all-product-sidebar-area">
			<div class="row">
				
				<div class="col-md-9 fix">
					<div class="all-product-list-grid-area">
						<div class="row">
							<!-- Tab panes -->

							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="grid">
									<div class="ma-bestsellerproductslider-container">
									
										<?php
										$Total=0;
												foreach ( $_SESSION["cart_products"] as $key => $value) {
										$productId = (string)$key;
										$productQty = $value["ProductQty"];
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
												$totalPrice = $productPrice*$productQty;
												$Total = $totalPrice +$Total;
												#echo '<form action="shop.php?id=' . $getId .'" method="post">';
												echo '<div class="col-xs-8 col-sm-3 col-md-3 col-lg-3">
															<div class="single-item"><ul>
																<li>
																	<div class="product-details">
																		<a class="product-image" href="#">
																			<div class="hover-view-content">
																				<form class="cart" action="checkout.php" method="post">
																				<a href="#" class="remove" title="Remove this item"><button type="submit" name="Remove_from_Cart" value="' . $productId .'"><i class="fa fa-times-circle"></i></button></a>
																			</div>
																		<img alt="" src="img/product/' .  $productId . '.jpg" class="primary-image">
																		</a>
																		<a class="product-name" href="shop.php#"><strong><h3>'.$productName.'</strong></h3></a>
																		<span class="cart-price-box">
																			
																			<span class="amount"><h6>Quantity: '.$productQty.'</h6></span>
																			<span class="amount"><h6>Total Price: '.$totalPrice.'</h6></span>
																			
																		</span>
																	</div>
																</li>
																</ul>
															</div>
														</div>
														</form>';
												
													}
												}
											}
											echo '<span class="amount" align ="center"><h3>Total Amount Due: $ '.$Total.'</h3></span>';
										?>
										<!--</form>-->
										<br/>
										<p class="buttons" align=center>
										<a href="send_email.php" class="button checkout wc-forward"><button><h5>Submit</h5></button>
										</a>
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
	</div>

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
