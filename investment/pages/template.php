<?php
function meta(){
	$nav= basename($_SERVER['PHP_SELF']);
	if($nav=='index.php'){$title='Home';}
	elseif($nav=='contact.php'){$title='Contact';}
	elseif($nav=='privacy.php'){$title='Privacy';}
	elseif($nav=='investor.php'){$title='Investor';}
	elseif($nav=='proposals.php'){$title='Proposals';}
	elseif($nav=='entrepreneur.php'){$title='Entrepreneur';}
	elseif($nav=='company.php'){$title='Company';}
	else{$title='';}
?><head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CRWEWORLD Investment">  
  <title>CRWEWORLD Investment | <?php echo $title; ?></title>
  <link rel="icon" href="/favicon.ico" sizes="16x16" type="image/x-icon">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="plugins/icons/css/icons.css">
  <link rel="stylesheet" href="plugins/fontawesome/css/all.css">
  <link rel="stylesheet" href="plugins/magnific-popup/dist/magnific-popup.css">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="/assets/style.css">

</head>
<?php } 
function headr(){
?>
<header class="navigation">
	<div class="header-top ">
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-lg-12 col-md-12 text-center text-lg-right text-md-right">
					<div class="header-top-info">
						<a href="tel:+7026838946">Call Us : <span>+(702)683-8946</span></a>
						<a href="mailto:invest@crweworld.com"><i class="fa fa-envelope mr-2"></i><span>invest@crweworld.com</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg  py-4" id="navbar">
		<div class="container">
		  <a class="navbar-brand" href="\"><img width="150" src="assets/images/logo.png"></a>

		  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
			<span class="fa fa-bars"></span>
		  </button>
	  
		  <div class="collapse navbar-collapse text-center" id="navbarsExample09">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item active">
				<a class="nav-link" href="\">Home <span class="sr-only">(current)</span></a>
			  </li>			  
			   <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About</a>
					<ul class="dropdown-menu" aria-labelledby="dropdown03">
						<li><a class="dropdown-item" href="/company">Our company</a></li>
						<li><a class="dropdown-item" href="/privacy">Privacy Policy</a></li>
					</ul>
			  </li>
			   <li class="nav-item"><a class="nav-link" href="/entrepreneurs">Entrepreneurs</a></li>
			  <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Investors</a>
					<ul class="dropdown-menu" aria-labelledby="dropdown03">
						<li><a class="dropdown-item" href="/investors">How It Works</a></li>
						<li><a class="dropdown-item" href="/proposals">Browse Proposal</a></li>
					</ul>
			  </li>
			   <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
			</ul>
			<form class="form-lg-inline my-2 my-md-0 ml-lg-4 text-center">
			  <a href="/dashboard" class="btn btn-solid-border btn-round-full">Dashboard</a>
			</form>
		  </div>
		</div>
	</nav>
</header>
<?php }
function footer(){
?>
<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#237afc"
    },
    "button": {
      "background": "#fff",
      "text": "#237afc"
    }
  },
  "position": "top",
  "content": {
    "href": "https://investment.crweworld.com/privacy"
  }
});
</script>
<footer class="footer section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="widget">
					<h4 class="text-capitalize mb-4">Company</h4>

					<ul class="list-unstyled footer-menu lh-35">
						<li><a href="/terms">Terms & Conditions</a></li>
						<li><a href="/privacy">Privacy Policy</a></li>
						<li><a href="#">FAQ</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="widget">
					<h4 class="text-capitalize mb-4">Quick Links</h4>

					<ul class="list-unstyled footer-menu lh-35">
						<li><a href="/company">About</a></li>
						<li><a href="/investors">Investors</a></li>
						<li><a href="/entrepreneurs">Entrepreneurs</a></li>
						<li><a href="/proposals">Browse proposals</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="widget">
					<h4 class="text-capitalize mb-4">Contact</h4>
					<h6><a href="tel:+(702)810-0178" >+(702) 810-0178</a></h6>
					<a href="mailto:invest@crweworld.com"><span class="text-color h4">invest@crweworld.com</span></a>
				</div>
			</div>
		</div>
		
		<div class="footer-btm pt-4">
			<div class="row">
				<div class="col-lg-6">
					<div class="copyright">
						&copy; <?php echo date('Y');?> investment.crweworld.com
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<?php }
function script(){
?>
<!-- Main jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap 4.3.1 -->
    <script src="plugins/bootstrap/js/popper.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
   <!--  Magnific Popup-->
    <script src="plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <!-- Slick Slider -->
    <script src="plugins/slick-carousel/slick/slick.min.js"></script>
    <script src="js/script.js"></script>
<?php } ?>    