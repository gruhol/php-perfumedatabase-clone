<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<base href="<?php echo base_url();?>">
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<meta name="description" content="">
	<meta name="author" content="Ahmed Saeed">
	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
	<!-- jquery ui css -->
	<link rel="stylesheet" href="css/jquery-ui-1.10.1.min.css">
	<link rel="stylesheet" href="css/customize.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- flexslider css-->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- fancybox -->
	<link rel="stylesheet" href="js/fancybox/jquery.fancybox.css">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<link rel="stylesheet" href="css/font-awesome-ie7.css">
	<![endif]-->
	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="../images/favicon.ico">
	<link rel="apple-touch-icon" href="../images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../images/apple-touch-icon-114x114.png">
</head>

<body>

	<div id="mainContainer" class="clearfix">

		<!--begain header-->
		<header>
			<div class="upperHeader">
				<div class="container">
					<ul class="pull-right inline">
						<li><a class="invarseColor" href="#">My Account</a></li>
						<li class="divider-vertical"></li>
						<li><a class="invarseColor" href="#">My Wish List (5)</a></li>
						<li class="divider-vertical"></li>
						<li><a class="invarseColor" href="#">Shoping Cart</a></li>
						<li class="divider-vertical"></li>
						<li><a class="invarseColor" href="#">Checkout</a></li>
					</ul>
					<?php echo $info_log ?>
				</div><!--end container-->
			</div><!--end upperHeader-->

			<div class="middleHeader">
				<div class="container">

					<div class="middleContainer clearfix">

					<div class="siteLogo pull-left">
						<h1><a href="index.html">ShopFine</a></h1>
					</div>

					<div class="pull-right">
						<form method="get" action="page" class="siteSearch">
							<div class="input-append">
								<input type="text" class="span2" id="appendedInputButton" placeholder="Search...">
								<button class="btn btn-primary" type="submit" name=""><i class="icon-search"></i></button>
							</div>
						</form>
					</div>

					<div class="pull-right">
						<div class="btn-group">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							    $ <span class="caret"></span>
							</a>
							<ul class="dropdown-menu currency">
								<li><a href="#">$</a></li>
								<li class="divider"></li>
								<li><a href="#">¥</a></li>
								<li class="divider"></li>
								<li><a href="#">£</a></li>
								<li class="divider"></li>
								<li><a href="#">€</a></li>
							</ul>
						</div>
						<div class="btn-group">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							    EN <span class="caret"></span>
							</a>
							<ul class="dropdown-menu language">
								<li><a href="#">FR</a></li>
								<li class="divider"></li>
								<li><a href="#">CH</a></li>
								<li class="divider"></li>
								<li><a href="#">AR</a></li>
							</ul>
						</div>

						<div class="btn-group">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							    <i class="icon-shopping-cart"></i> 3 Items
							    <span class="caret"></span>
							</a>
							<div class="dropdown-menu cart-content pull-right">
								<table class="table-cart">
									<tbody>
									<tr>
										<td class="cart-product-info">
											<a href="#"><img src="../img/72x72.jpg" alt="product image"></a>
											<div class="cart-product-desc">
												<p><a class="invarseColor" href="#">Foliomania the designer portfolio brochure</a></p>
												<ul class="unstyled">
													<li>Available: Yes</li>
													<li>Color: Black</li>
												</ul>
											</div>
										</td>
										<td class="cart-product-setting">
											<p><strong>1x-$500.00</strong></p>
											<a href="#" class="remove-pro" data-toggle="tooltip" data-title="Delete"><i class="icon-trash"></i></a>
										</td>
									</tr>
									<tr>
										<td class="cart-product-info">
											<a href="#"><img src="../img/72x72.jpg" alt="product image"></a>
											<div class="cart-product-desc">
												<p><a class="invarseColor" href="#">Foliomania the designer portfolio brochure</a></p>
												<ul class="unstyled">
													<li>Available: Yes</li>
													<li>Color: Black</li>
												</ul>
											</div>
										</td>
										<td class="cart-product-setting">
											<p><strong>2x-$450.00</strong></p>
											<a href="#" class="remove-pro" data-toggle="tooltip" data-title="Delete"><i class="icon-trash"></i></a>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td class="cart-product-info">
											<a href="#" class="btn btn-small">Vew cart</a>
											<a href="#" class="btn btn-small btn-primary">Checkout</a>
										</td>
										<td>
											<h3>TOTAL<br>$1,598.30</h3>
										</td>
									</tr>
								</tfoot>
								</table>
							</div>
						</div>
					</div><!--end pull-right-->

					</div><!--end middleCoontainer-->

				</div><!--end container-->
			</div><!--end middleHeader-->

			<div class="mainNav">
				<div class="container">
					<div class="navbar">
					      	
				      	<ul class="nav">
				      		<li class="active"><a href="#"><i class="icon-home"></i></a></li>
				      		<li>
				      			<a href="#">Wiadomości &nbsp;<i class="icon-caret-down"></i></a>
				      			<div>
					      			<ul>
					      				<li><a href="#"> <span>-</span> Dresses (2)</a></li>
					      				<li><a href="#"> <span>-</span> Jackets &amp; Coats (4)</a></li>
					      				<li>
					      					<a href="#"> <span>-</span> Skirts (0) <i class="icon-caret-right pull-right"></i></a>
					      					<div>
								      			<ul>
								      				<li><a href="#"> <span>-</span> Dresses (2)</a></li>
								      				<li><a href="#"> <span>-</span> Jackets &amp; Coats (4)</a></li>
								      				<li><a href="#"> <span>-</span> Skirts (0)</a></li>
								      				<li><a href="#"> <span>-</span> Suits &amp; Tailoring (82)</a></li>
								      				<li><a href="#"> <span>-</span> Tops (58)</a></li>
								      				<li><a href="#"> <span>-</span> Shoes (15)</a></li>
								      				<li><a href="#"> <span>-</span> Shorts (54) </a></li>
								      			</ul>
								      		</div>
					      				</li>
					      				<li><a href="#"> <span>-</span> Suits &amp; Tailoring (82)</a></li>
					      				<li><a href="#"> <span>-</span> Tops (58)</a></li>
					      				<li><a href="#"> <span>-</span> Shoes (15)</a></li>
					      				<li><a href="#"> <span>-</span> Shorts (54) </a></li>
					      			</ul>
					      		</div>
				      		</li>
				      		<li>
				      			<a href="#">Men &nbsp;<i class="icon-caret-down"></i></a>
				      			<div>
					      			<ul>
					      				<li><a href="#"> <span>-</span> Dresses (2)</a></li>
					      				<li><a href="#"> <span>-</span> Jackets &amp; Coats (4)</a></li>
					      				<li><a href="#"> <span>-</span> Skirts (0)</a></li>
					      				<li><a href="#"> <span>-</span> Suits &amp; Tailoring (82)</a></li>
					      				<li><a href="#"> <span>-</span> Tops (58)</a></li>
					      				<li><a href="#"> <span>-</span> Shoes (15)</a></li>
					      				<li><a href="#"> <span>-</span> Shorts (54) </a></li>
					      			</ul>
					      		</div>
				      		</li>
				      		<li><a href="#">Children</a></li>
				      		<li><a href="#">FootWear</a></li>
				      		<li>
				      			<a href="#">Accessories &nbsp;<i class="icon-caret-down"></i></a>
				      			<div>
					      			<ul>
					      				<li><a href="#"> <span>-</span> Dresses (2)</a></li>
					      				<li><a href="#"> <span>-</span> Jackets &amp; Coats (4)</a></li>
					      				<li><a href="#"> <span>-</span> Skirts (0)</a></li>
					      				<li><a href="#"> <span>-</span> Suits &amp; Tailoring (82)</a></li>
					      				<li><a href="#"> <span>-</span> Tops (58)</a></li>
					      				<li><a href="#"> <span>-</span> Shoes (15)</a></li>
					      				<li><a href="#"> <span>-</span> Shorts (54) </a></li>
					      			</ul>
					      		</div>
				      		</li>
				      		<li><a href="#">OutLet</a></li>
				      		<li><a href="#">Designers</a></li>
				      		<li><a href="#">Community</a></li>
				      	</ul><!--end nav-->

					</div>
				</div><!--end container-->
			</div><!--end mainNav-->
			
		</header>
		<!-- end header -->
				
		<?php echo $content;?>
				
		<!--begain footer-->
		<footer>
		<div class="footerOuter">
			<div class="container">
				<div class="row-fluid">

					<div class="span6">
						<div class="titleHeader clearfix">
							<h3>Usefull Links</h3>
						</div>

						
						<div class="usefullLinks">
							<div class="row-fluid">
								<div class="span6">
									<ul class="unstyled">
										<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> About Us</a></li>
										<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Delivery Information</a></li>
										<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Privecy Police</a></li>
										<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Tarms &amp; Condations</a></li>
									</ul>
								</div>

								<div class="span6">
									<ul class="unstyled">
										<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Surf Brands</a></li>
										<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Customer Support</a></li>
										<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Special Gifs</a></li>
										<li><a class="invarseColor" href="#"><i class="icon-caret-right"></i> Browse Site Map</a></li>
									</ul>
								</div>
							</div>
						</div>

					</div><!--end span6-->

					<div class="span3">
						<div class="titleHeader clearfix">
							<h3>Contact Info</h3>
						</div>

						<div class="contactInfo">
							<ul class="unstyled">
								<li>
									<button class="btn btn-small">
										<i class="icon-volume-up"></i>
									</button>
									Zadzwoń: <a class="invarseColor" href="#">662 078 402</a>
								</li>
								<li>
									<button class="btn btn-small">
										<i class="icon-envelope-alt"></i>
									</button>
									<a class="invarseColor" href="#">kontakt@imasztaniej.pl</a>
								</li>
								<li>
									<button class="btn btn-small">
										<i class="icon-map-marker"></i>
									</button>
									ul. Kolejowa 1/5, 21-200 Parczew
								</li>
							</ul>
						</div>

					</div><!--end span3-->

					<div class="span3">
						<div class="titleHeader clearfix">
							<h3>Newslatter</h3>
						</div>

						<div class="newslatter">
							<form method="get" action="page">
								<input class="input-block-level" type="text" name="email" value="" placeholder="Your Name...">
								<input class="input-block-level" type="text" name="email" value="" placeholder="Your E-Mail...">
								<button class="btn btn-block" type="submit" name="">Join Us Now</button>
							</form>
						</div>

					</div><!--end span3-->

				</div><!--end row-fluid-->

			</div><!--end container-->
		</div><!--end footerOuter-->

		<div class="container">
			<div class="row">
				<div class="span12">
					<ul class="payments inline pull-right">
						<li class="visia"></li>
						<li class="paypal"></li>
						<li class="electron"></li>
						<li class="discover"></li>
					</ul>
					<p>© Copyrights 2014 for imasztaniej.pl</p>
				</div>
			</div>
		</div>
		</footer>
		<!--end footer-->

	</div><!--end mainContainer-->


	


	<!-- JS
	================================================== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
    <!-- jQuery.Cookie -->
	<script src="../js/jquery.cookie.js"></script>
	<!-- bootstrap -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- flexslider -->
    <script src="../js/jquery.flexslider-min.js"></script>
    <!-- cycle2 -->
    <script src="../js/jquery.cycle2.min.js"></script>
    <script src="../js/jquery.cycle2.carousel.min.js"></script>
    <!-- tweets -->
    <script src="../js/jquery.tweet.js"></script>
    <!-- fancybox -->
    <script src="../js/fancybox/jquery.fancybox.js"></script>
    <!-- custom function-->
    <script src="../js/custom.js"></script>
    
</body>

</html>