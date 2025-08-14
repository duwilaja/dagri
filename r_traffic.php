<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Traffic";
$modal_title="";
$card_title="Traffic";

$menu="-";

$breadcrumb="Reports/$page_title";

include "inc.head.php";
include "inc.menutop.php";

include "lib_inc.db.php";
$conn=connect();
$where=""; $clso="";
if($mys_LOC!=''){ //session loc
	$where.= "where loc in ('$mys_LOC')";
}
$sql="select device_id, name, hostname from devices join nimdb.core_node on hostname=host $where order by name";
$rs=fetch_all(exec_qry($conn,$sql));
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
			<!--div class="page-rightheader">
				<a href="#" class="btn btn-primary" onclick="" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Create</a>
			</div-->
		</div>
		<!--End Page header-->
				<div class="mb-3">
					<div class="card-body">
						<div class="row">
							<div class="col-md-2"><div class="input-group">
								<input type="text" id="df" placeholder="From Date" class="form-control datepicker">
								<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
							</div></div>
							<div class="col-md-2"><div class="input-group">
								<input type="text" id="dt" placeholder="To Date" class="form-control datepicker">
								<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
							</div></div>
							<div class="col-md-6"><div class="input-group">
								<select id="hos" class="form-control select2">
									<option value="">--- Please Select ---</option>
									<?php echo options($rs)?>
								</select>
							</div></div>
							&nbsp;&nbsp;&nbsp;
							<button type="button" onclick="submit_r_trfc();" class="btn btn-primary col-md-1">Submit</button>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header hidden">
						<div class="card-title"><?php echo $card_title?></div>
						<div class="card-options ">
							<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="dimmer active ldr-inter">
							<div class="sk-cube-grid">
								<div class="sk-cube sk-cube1"></div>
								<div class="sk-cube sk-cube2"></div>
								<div class="sk-cube sk-cube3"></div>
								<div class="sk-cube sk-cube4"></div>
								<div class="sk-cube sk-cube5"></div>
								<div class="sk-cube sk-cube6"></div>
								<div class="sk-cube sk-cube7"></div>
								<div class="sk-cube sk-cube8"></div>
								<div class="sk-cube sk-cube9"></div>
							</div>
						</div>
						<div id="isi-inter"></div>
					
					</div>
				</div>

	</div>
</div><!-- end app-content-->

<?php 
include "inc.foot.php";
include "inc.js.php";
?>

<script>
var hosts=<?php echo json_encode($rs)?>;
$(document).ready(function(){
	page_ready();
	datepicker(true);
	$(".select2").select2();
});
function gethos(i){
	var rr='';
	for(var ii=0;ii<hosts.length;ii++){
		if(hosts[ii][0]==i) rr=hosts[ii][2];
	}
	return rr;
}
function  submit_r_trfc(){
	var id=$("#hos").val();
	var h=gethos(id);
	if(h!='') get_content("lib_device_inter<?php echo $ext?>",{h:h,idx:id,df:$("#df").val(),dt:$("#dt").val()},".ldr-inter","#isi-inter");
}
</script>

  </body>
</html>