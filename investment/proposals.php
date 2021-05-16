<?php 
ob_start();
session_start();
include( 'pages/template.php');  
include( 'pages/connect_me.php'); ?>
<!doctype html>
<html lang="en">
<?php meta(); 
	if(isset($_SESSION['pub_id'])){$url='javascript:void(0)';}else{$url='/dashboard';}?>

<body>
	<?php headr()?>
	<div class="main-wrapper ">
		<section class="page-title bg-1">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="block text-center"> <span class="text-white">Investor</span>
							<h1 class="text-capitalize mb-4 text-lg">Proposals</h1>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="section blog-wrap bg-gray">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="row">
							<?php
							$indus = array( '', 'Agriculture', 'Automotive Products & Services', 'Aviation', 'Biotechnology & Life Sciences', 'Building Services & Products', 'Education & Training', 'Energy & Mining', 'Entertainment & Film', 'Fashion & Beauty', 'Financial, Business & Legal Services', 'Food & Beverage', 'Hospitality, Restaurants & Bars', 'Internet, eCommerce & Apps', 'IT, Hardware & Software', 'Leisure, Tourism & Hotels', 'Manufacturing', 'Marketing & Advertising', 'Media & Publishing', 'Medical, Pharmaceuticals & Health Care', 'Products & Inventions', 'Real Estate', 'Retail', 'Security & Defence', 'Technology', 'Telecom & Mobile', 'Transportation' );
							$role = array( '', 'Silent', 'Advisory', 'Hands-On', 'Any' );
							$stage = array( '', 'Pre-Startup/R&D', 'Finished Product', 'Achieving Sales', 'Breaking Even', 'Profitable', 'Other' );
							$reason = array( '', 'Research & Development', 'Sales & Marketing', 'Real Estate', 'Equipment or Inventory', 'Working Capital', 'Debt Refinance', 'Finance Acquisition', 'Other' );
							$where = '';
							if ( isset( $_GET[ 'search' ] ) ) { 
								$q = mysqli_real_escape_string( $mysql_link, $_GET[ 'search' ] );
								$where = "and (`title` like '%$q%' or `summary` like '%$q%') "; 
							} if(isset($_SESSION['pub_id'])){ 
								if($_SESSION['pub_group']=='investor'){
									$dp = mysqli_query($mysql_link, "SELECT propid FROM props where `userid`='{$_SESSION['pub_id']}'" )or die( mysqli_error($mysql_link ) ); 
									$p=mysqli_fetch_array($dp );															   
									if($p['propid']!=''){
										$where = "and id not in ('".str_replace(',',"','",$p['propid'])."')";
									}									
								}
								
							} 
							
							
							$c = mysqli_fetch_array( mysqli_query( $mysql_link, "SELECT count(*) FROM investment WHERE status=1 $where ORDER BY id DESC" ) )or die( mysqli_error( $mysql_link ) );
							if ( isset( $_GET[ 'search' ] ) or $c[ 'count(*)' ]==0 ) {
								echo '<div class="col-lg-6 col-md-6"><span class="h6 text-color">' . $c[ 'count(*)' ] . ' Result found</span></div>';
							}
							$sql = mysqli_query( $mysql_link, "SELECT * FROM investment WHERE status=1 $where ORDER BY id DESC" )or die( mysqli_error( $mysql_link ) );
							while ( $d = mysqli_fetch_array( $sql ) ) {
								?>
							<div class="col-lg-12 col-md-12 mb-5">
								<div class="blog-item">
									<div class="blog-item-content bg-white p-4">
										<div class="blog-item-meta  py-1 px-2">
											<span class="text-muted text-capitalize mr-3"><i class="ti-medall-alt mr-2"></i><?php echo $indus[$d['industry']]?></span>
											<span class="text-black text-capitalize mr-3"><i class="ti-time mr-1"></i> <?php echo date("F dS, Y ", strtotime($d['date'])); ?></span>
										</div>
										<h3 class="mt-3 mb-3"><a href="#"><?php echo ucwords($d['title']);?></a></h3>
										<p class="mb-4">
											<?php echo strip_tags(htmlspecialchars_decode($d['summary']));?>
										</p>
										<table width="100%" cellpadding="0" cellspacing="0" border="0" class="mb-4">
											<tbody>
												<tr>
													<td><b>Required Amount</b>
													</td>
													<td>$
														<?php echo $d['capital'] ?>
													</td>
												</tr>
												<tr>
													<td><b>Minimum Investment</b>
													</td>
													<td>$
														<?php echo $d['minimum'] ?>
													</td>
												</tr>
												<tr>
													<td><b>Money Invested</b>
													</td>
													<td>$
														<?php echo $d['invested'] ?>
													</td>
												</tr>
												<tr>
													<td><b>Primary reason</b>
													</td>
													<td>
														<?php echo $reason[$d['reason']] ?>
													</td>
												</tr>
												<tr>
													<td><b>Stage</b>
													</td>
													<td>
														<?php echo $stage[$d['stage']] ?>
													</td>
												</tr>
												<tr>
													<td><b>Investor Role</b>
													</td>
													<td>
														<?php echo $role[$d['role']] ?>
													</td>
												</tr>
											</tbody>
										</table>
										<a href="<?php echo $url?>" class="btn btn-small btn-main btn-round-full save" data-id="<?php echo $d['id']?>"><i class="ti-heart mr-2"></i> Save </a>
									</div>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="sidebar-wrap">
							<div class="sidebar-widget search card p-4 mb-3 border-0">
								<form method="get" action="/search">
									<input type="text" class="form-control" name="search" placeholder="search"> <button type="submit" class="btn btn-mian btn-small d-block mt-2">search</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php footer()?>
	</div>
	<?php script(); if(isset($_SESSION['pub_id']))
{ if($_SESSION['pub_group']=='investor'){?>
	<script>
		$( 'body' ).on( 'click', '.save', function () {
			$( this ).html('<i class="ti-heart mr-2"></i> saved');
		$.post( '/saveit', {
			pid: $( this ).attr( 'data-id' )
		}, function ( data, status ) {			
			$( "#myModalLabel" ).html( "Proposal saved" );
			$( "#myModal" ).modal( "show" );
			setTimeout( function () {
				$( "#myModal" ).modal( "hide" );
			}, 1000 );
		} );
		} );

	</script>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title" id="myModalLabel"></b>
            </div>
        </div>
    </div>
</div>
<?php } }?>
</body>

</html>