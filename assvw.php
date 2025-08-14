<?php 
$redirect=false;
$cleartext=true;
include "inc.common.php";
include "inc.session.php";


include '../phpqrcode/qrlib.php';

$ass=$_GET["id"];

$page_icon="fa fa-home";
$page_title="Asset #$ass";
$modal_title="Title of Modal";
$menu="assvw";

$breadcrumb="Asset/Details";

include "inc.head.php";
//include "inc.menutop.php";
include "inc.db.php";

$conn=connect();
$sql="select * from ass_ets where assid='$ass'";
$recs=fetch_alla(exec_qry($conn,$sql));
if(count($recs)<1){ disconnect($conn); header("Location: error$ext?m=No data found."); }

$sql="select ticketno,stts from tick_ets where sn='$ass' order by dtm desc";
$hist=fetch_alla(exec_qry($conn,$sql));
disconnect($conn);

$kode = $recs[0]["sn"]."/".$recs[0]["assname"]."/".$recs[0]["loc"]."/".$recs[0]["brand"]."/".$recs[0]["cat"];
$filename="qr/$ass.png";
$errorCorrectionLevel = "L";
$matrixPointSize = "6";
if(!file_exists($filename)){
	QRcode::png($kode, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
}
?>

				<div class="app-content page-body">
					<div class="container">

						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title"><?php echo $page_title ?></h4>
								<ol class="breadcrumb pl-0">
									<?php echo breadcrumb($breadcrumb)?>
								</ol>
							</div>

						</div>
						<!--End Page header-->
						
						<!-- Row -->
						<div class="row row-sm">
							<div class="col-xl-4 col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class=" card-body ">
										<h5 class="mb-3">Asset details :</h5>
										<div class="">
											<div class="row">
												<div class="col-xl-12">
													<div class="table-responsive">
														<table class="table mb-0 border-top table-bordered text-nowrap">
															<tbody>
																<tr>
																	<th scope="row">Name</th>
																	<td><?php echo $recs[0]["assname"]?></td>
																</tr>
																<tr>
																	<th scope="row">S/N</th>
																	<td><?php echo $recs[0]["sn"]?></td>
																</tr>
																<tr>
																	<th scope="row">Description</th>
																	<td><?php echo $recs[0]["assdesc"]?></td>
																</tr>
																<tr>
																	<th scope="row">Location</th>
																	<td><?php echo $recs[0]["loc"]?></td>
																</tr>
																<tr>
																	<th scope="row">Status</th>
																	<td><?php echo $recs[0]["stts"]?></td>
																</tr>
																<tr>
																	<th scope="row">Brand</th>
																	<td><?php echo $recs[0]["brand"]?></td>
																</tr>
																<tr>
																	<th scope="row">Category</th>
																	<td><?php echo $recs[0]["cat"]?></td>
																</tr>
																<tr>
																	<th scope="row">Purchased</th>
																	<td><?php echo $recs[0]["gr"]?></td>
																</tr>
																<tr>
																	<th scope="row">Warranty Expired</th>
																	<td><?php echo $recs[0]["warexp"]?></td>
																</tr>
																<tr>
																	<th scope="row">License Expired</th>
																	<td><?php echo $recs[0]["licexp"]?></td>
																</tr>
																<tr>
																	<th scope="row">QR</th>
																	<td><img src="<?php echo $filename?>"></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-8 col-lg-12 col-md-12">
								<div class="card custom-card overflow-hidden">
									<?php if($recs[0]["img1"]!=''){?>
									<div class="card-body px-4 pt-4">
										<img id="imej" src="assimg/<?php echo $recs[0]["img1"]?>" alt="img" class="rounded-5 h-100"></a>
									</div>
									<?php } else { if($recs[0]["img2"]!=''){?>
									<div class="card-body px-4 pt-4">
										<img id="imej" src="assimg/<?php echo $recs[0]["img2"]?>" alt="img" class="rounded-5 h-100"></a>
									</div>
									<?php }}?>
								</div>
							</div>
							<div class="col-xl-4 col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<h5 class="mb-3">Pictures</h5>
										<div class="row row-sm">
									<?php if($recs[0]["img1"]!=''){?>
											<div class="col-xl-3">
												<div class="card custom-card">
													<img id="img1" style="cursor:pointer;" onclick="$('#imej').attr('src','assimg/<?php echo $recs[0]["img1"]?>');" src="assimg/<?php echo $recs[0]["img1"]?>" alt="img" height="100%" width="100%" class="rounded-5">
												</div>
											</div>
									<?php }?>
									<?php if($recs[0]["img2"]!=''){?>
											<div class="col-xl-3">
												<div class="card custom-card">
													<img style="cursor:pointer;" onclick="$('#imej').attr('src','assimg/<?php echo $recs[0]["img2"]?>');" src="assimg/<?php echo $recs[0]["img2"]?>" alt="img" height="100%" width="100%" class="rounded-5">
												</div>
											</div>
									<?php }?>
									
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-8 col-lg-12 col-md-12">
								<div class="card custom-card overflow-hidden">
									<div class="card-body px-4 pt-4">
									<h5 class="mb-3">Ticket History</h5>
									<?php for($i=0;$i<count($hist);$i++){
										$stts="bg-warning";
										if($hist[$i]['stts']=='pending') $stts='bg-danger';
										if($hist[$i]['stts']=='closed') $stts='bg-dark';
										if($hist[$i]['stts']=='solved') $stts='bg-success';
										?>
										<button class="btn btn-ripple btn-primary" onclick="panci('<?php echo $hist[$i]['ticketno']?>');"><?php echo $hist[$i]['ticketno']?>
										<span class="badge <?php echo $stts?>"><?php echo $hist[$i]['stts']?></span></button>&nbsp;
									<?php }?>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->
						
					</div>
				</div><!-- end app-content-->
				
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
<?php 
include "inc.foot.php";
include "inc.js.php";
?>
<script>
$(document).ready(function(){
	page_ready();
})

function panci(tno){
	$.fancybox.open(
	  {
		src: "tickhis"+ext+'?id='+tno,
		type: "iframe",
		preload: false,
//		width: 600,
//		height: 300,
	  },
	);
}

</script>

  </body>
</html>