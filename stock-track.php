<?php 
include('subs/header.php');
$_SESSION['landing']='true';

?>
<style>
body { background-color: #b2d3fb }
.header-menu{display:none}
.container {padding-left: 15; padding-right: 15}
#page-header #header .header-logo-banner, .header-background-menu, .header-logo-banner{ display:none }
#page-header #header .header-menu{ background-color: #CC0101 }
@media screen and (max-width: 1024px) {	#wrapper {padding-top: 2em} .banner .header .logo{ padding-bottom:15px}}
</style>



<!-- WRAPPER-->
<div id="wrapper"><!-- PAGE WRAPPER-->

<!--start-banner-->
	<div class="banner" id="home">
  
		<div class="container">
		
			<div class="row">
			
				<div class="col-xs-12 col-md-6 header">
					<div class="logo">
						<a href="<?php echo "http://".$_SERVER['HTTP_HOST'];/*if(isset($nav)){echo $nav; }*/?>"><img src="/assets/images/logo2.png" alt="crwe world" width="100%" class="img-responsive"></a>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="banner-bottom">
				
				
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 banner-left">
							<center><img src="/assets/img/crweworld-stocks-2.png" class="img-responsive" alt="" /></center></br>
						</div>
						
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 banner-right">
						
							<h1>Share knowledge and ideas about stocks </h1> <br>
														
												
							<div class="bnr-btn" role="group" aria-label="Basic example">
							
								<div class="section-name">
									<form action="/search" class="search-form" method="get">
										<div class="input-icon right">
											<input style="width:90%; float:left" name="search" placeholder="Stock symbol or Company's name" autocomplete="off" class="form-control searchit" type="text">
											<input name="searchtype" type="hidden" value="symbol">				
											<button style="width: 10%;height: 34px;background-color: #CC0101;border: 0;color: #fff;">
											<i class="ion-android-search"></i>
											</button>
										</div>
									</form>
									<div id="list_sym2" style="border: 1px solid #c7c7c7; display: none"></div>
								</div>
														
								
								
							</div>					
						</div>
						
					
					
					<div class="clearfix"></div>
				</div>
			
			</div>
		</div>
	</div>	
	<!--end-banner-->           
<script>
$('.searchit').keyup(function(e) {
			var tval = $(this).val();
			if (tval == '') {
				$("#list_sym2").hide();
			} else {
				$.ajax({
					type: "POST",
					url: "/subs/ajax.php",
					data: {
						searchitSymbol: tval
					},
					cache: false,
					success: function(data) {
						if (data != '') {
							$("#list_sym2").html(data).show();
						} else {
							$("#list_sym2").hide();
						}
					}
				});
			}
		});</script>    
<?php include('subs/footer.php'); ?>