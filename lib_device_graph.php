<?php 
$redirect=false;
$cleartext=true;

include "inc.common.php";
include "inc.session.php";

include "inc.db.php";

$h=get("h");
$g=get("g");
$l=get("l");
$df=get("f")==''?date('Y-m-d')." 00:00:00":base64_decode(get("f"));
$dt=get("t")==''?date('Y-m-d')." 23:59:59":base64_decode(get("t"));

$conn=connect();
$rs=fetch_alla(exec_qry($conn,"select name from core_node where host='$h'"));
$name=$rs[0]["name"];
disconnect($conn);

$page_icon="fa fa-home";
$page_title="$h ($name)/$g";
$modal_title="My Profile";
$menu="lib_device";

$breadcrumb="Plugins/SNMP/Graph/$page_title";

include "inc.head.php";
//include "inc.menutop.php";
?>

				<div class="page-body">
					<div class="container" style="max-width:95%; width: 95%;">

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
				<div class="mb-3">
					<div class="card-body">
						<div class="row">
							<div class="col-md-3"><div class="input-group">
								<input type="text" id="df" placeholder="From Date" class="form-control datetimepicker" value="<?php echo $df?>">
								<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
							</div></div>
							<div class="col-md-3"><div class="input-group">
								<input type="text" id="dt" placeholder="To Date" class="form-control datetimepicker" value="<?php echo $dt?>">
								<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
							</div></div>
							&nbsp;&nbsp;&nbsp;
							<button type="button" onclick="submit_graph();" class="btn btn-primary col-md-1">Submit</button>
							
							<input type="hidden" id="lnk" value="<?php echo $l?>">
						</div>
					</div>
				</div>
				
						<div class="row">
							<div class="col-md-12">
								<div class="card mb-3">
									<div class="card-header">
										<div class="card-title"><?php echo $title?></div>
										<div class="card-options ">
											<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							
										</div>
									</div>
									<div class="card-body">
										<div class="dimmer active ldr-graph">
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
										<div id="isi-graph"></div>
									</div>
								</div>
							</div>
						</div>
				
					</div>
				</div><!-- end app-content-->
				
<?php 
include "inc.foot.php";
include "inc.js.php";
?>
<script>
var jvalidate,jvalidatex;
$(document).ready(function(){
	page_ready();
	
	datetimepicker();
	//get_content("device_perf<?php echo $ext?>",{h:"<?php echo $h?>"},".ldr-perf","#isi-perf");
	submit_graph();
	
});

function submit_graph(){
	get_content("lib_graph<?php echo $ext?>",{lnk:$("#lnk").val(),df:$("#df").val(),dt:$("#dt").val()},".ldr-graph","#isi-graph");
}
</script>

  </body>
</html>