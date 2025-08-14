<?php 
include "inc.common.php";
include "inc.session.php";

//$tick=$_GET["id"];

$page_icon="fa fa-home";
$page_title="All Location";
$modal_title="Title of Modal";
$menu="tickhis";

$breadcrumb="Overview/Bandwidth Usage";

include "inc.head.php";
//include "inc.menutop.php";
include "lib_inc.db.php";

$conn=connect();


$whr=($mys_LOC=='')?"1=1":" loc in ('$mys_LOC')";

$ord="desc";
//find the hosts and the bw of the loc
$sql="select distinct n.host,n.name,l.bw,device,port from nimdb.core_node n join nimdb.core_location l on l.locid=n.loc
join nimdb.core_ports x on x.host=n.host where traffic='Y' and $whr";
$rs=exec_qry($conn,$sql);
$locs=fetch_alla($rs);
$devices=array();
$ports=array(0);
for($i=0;$i<count($locs);$i++){
	$devices[]=$locs[$i]["device"];
	$ports[]=$locs[$i]["port"];
}
$devs=implode(",",$devices);
$recs=implode(",",$ports);

/*
//look for the latest record
$sql="select max(t.rowid) as mrow,device_id from libdb.core_traffic t join nimdb.core_ports x on x.port=t.port_id where traffic='Y' and device_id in ($devs) group by device_id";
$rs=exec_qry($conn,$sql);
$maxs=fetch_alla($rs);
$rowids=array(); 
for($i=0;$i<count($maxs);$i++){
	$rowids[]=$maxs[$i]["mrow"];
}
$recs=implode(",",$rowids);

$sql="select t.ifinoctets_delta as inb, t.ifoutoctets_delta as outb, device_id 
from libdb.core_traffic t where t.rowid in ($recs) and t.ifoutoctets_delta<>t.ifinoctets_delta
 order by inb $ord";
*/

$sql="select t.ifinoctets_delta as inb, t.ifoutoctets_delta as outb, device_id 
from libdb.ports t where t.port_id in ($recs) and t.ifoutoctets_delta<>t.ifinoctets_delta
 order by inb $ord";
 
$rs=exec_qry($conn,$sql);
$lists=fetch_alla($rs);

disconnect($conn);

function urai($bit){
	$bit=$bit/300;
	$ret=round($bit/1000000000,2).'gb/s';
	if($bit<1000000000) $ret=round($bit/1000000,2).'mb/s';
	if($bit<1000000) $ret=round($bit/1000,2).'kb/s';
	
	return $ret;
}
function mybw($sbw){
	$bw=trim(str_ireplace("gbps","",str_ireplace("mbps","",$sbw))); //cleanup letter
	$bw = (is_numeric($bw)) ? intval($bw):0;
	if(strpos($sbw,"gbps")!==false) $bw=$bw*1000000000;
	if(strpos($sbw,"mbps")!==false) $bw=$bw*1000000;
	return $bw;
}
function mymaster($id,$mas){
	$ret=array('bw'=>0,'name'=>'','host'=>'');
	for($i=0;$i<count($mas);$i++){
		$m=$mas[$i];
		if($m['device']==$id) $ret=$m;
	}
	return $ret;
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
										 <div class="card-title main-content-label mb-1"> Usage/second </div> 
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
														<th>BW</th>
														<th>In</th>
														<th>Usage</th>
														<th>Out</th>
														<th>Usage</th>
													</tr>
												</thead>
												<tbody>
<?php
for($i=0;$i<count($lists);$i++){
	$list=$lists[$i];
	$master=mymaster($list['device_id'],$locs);
	$h=$master['host']; $idx=$list['device_id'];
	$bw=mybw($master['bw']);
	$act='<a title="Overview" class="btn btn-sm btn-primary ripple" href="JavaScript:;" data-fancybox data-type="iframe" data-src="lib_device'.$ext.'?h='.$h.'&idx='.$idx.'">'.$h.'</a>';
?>
		<tr>
			<!--td><?php echo ($i+1) ?></td-->
			<td><?php echo $act ?></td>
			<td><?php echo $master['name'] ?></td>
			<td><?php echo $master['bw'] ?></td>
			<td><?php echo urai($list['inb']) ?></td>
			<td><?php echo ($bw>0)?round(intval($list['inb'])/300/$bw,3)*100:0 ?>%</td>
			<td><?php echo urai($list['outb']) ?></td>
			<td><?php echo ($bw>0)?round(intval($list['outb'])/300/$bw,3)*100:0 ?>%</td>
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