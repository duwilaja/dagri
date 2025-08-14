<?php 
include "inc.common.php";
include "inc.session.php";

//$tick=$_GET["id"];

$page_icon="fa fa-home";
$page_title="All Location";
$modal_title="Title of Modal";
$menu="tickhis";

$breadcrumb="Overview/Longest Down";

include "inc.head.php";
//include "inc.menutop.php";
include "inc.db.php";

$conn=connect();

$whr=($mys_LOC=='')?"1=1":" loc in ('$mys_LOC')";

$sql="select n.host, name, downsince, MY_SECTOTIME(TIMESTAMPDIFF(SECOND,downsince,now())) as mstt from core_node n join core_status s on s.host=n.host 
where status=0 and downsince is not NULL and $whr";
//echo $sql;
$rs=exec_qry($conn,$sql);
$lists=fetch_alla($rs);

//print_r($lists);

disconnect($conn);

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
							<!--div class="d-flex">
								<a target="_blank" href="tickdown<?php echo $ext?>" class="btn btn-primary"> <i class="fe fe-download-cloud me-2"></i> Download </a>
							</div-->
						</div>
						<!--End Page header-->
						
						<!--Row-->
						<div class="row">
							<div class="col-xl-12 col-xxl-12 col-md-12 col-lg-12">
								<div class="card custom-card">
									<div class="card-header justify-content-between" style="display: flex;">
										 <div class="card-title main-content-label mb-1"> &nbsp; </div> 
										 <span><!--a title="all locations" href="bwall<?php echo $ext?>" target="_blank"> <i class="fe fe-copy"></i> </a>&nbsp;&nbsp;
										 <a href="javascript:void(0);" data-bs-toggle="card-fullscreen"> <i class="fe fe-maximize"></i> </a--></span>
									</div>
									<div class="card-body pt-2 pb-0">
										<div class="table-responsive">
											<table id="tabelku" class="table card-table table-vcenter text-nowrap border">
												<thead>
													<tr>
														<th>Host</th>
														<th>Name</th>
														<th>Down Since</th>
														<th>Downtime</th>
													</tr>
												</thead>
												<tbody>
<?php
for($i=0;$i<count($lists);$i++){
	$list=$lists[$i];
	$h=$list['host'];
	$act='<a title="Overview" class="btn btn-sm btn-primary ripple" href="JavaScript:;" data-fancybox data-type="iframe" data-src="device'.$ext.'?h='.$h.'">'.$h.'</a>';
?>
		<tr>
			<!--td><?php echo ($i+1) ?></td-->
			<td><?php echo $act ?></td>
			<td><?php echo $list['name'] ?></td>
			<td><?php echo $list['downsince'] ?></td>
			<td><?php echo $list['mstt'] ?></td>
		</tr>
<?php }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--End Row-->
						
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
	$("#tabelku").DataTable({});
})
</script>

  </body>
</html>