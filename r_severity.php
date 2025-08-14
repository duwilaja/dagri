<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Severity";
$modal_title="";
$card_title="Severity Report";

$menu="-";

$breadcrumb="Reports/$page_title";

include "inc.head.php";
include "inc.menutop.php";

include "inc.db.php";
$conn=connect();
$rs=exec_qry($conn,"select concat(sensor,'|',mn,'|',mx,'|',severity,'|',net) as val, name from core_severity order by name");
$o_severity=fetch_all($rs);
disconnect($conn);

if(count($o_severity)>0){
	$svr=explode("|",$o_severity[0][0]);
}else{
	$svr=array("status","9","9","-");
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
							<div class="col-md-3">
							<select class="form-control" id="severity" name="severity">
								<?php echo options($o_severity)?>
							</select>
							</div>
							&nbsp;&nbsp;&nbsp;
							<button type="button" onclick="submit_r_severity();" class="btn btn-primary col-md-1">Submit</button>
							
							<input type="hidden" id="cols" value="n.host,n.name,n.net,n.typ,">
							<input type="hidden" id="fld" value="<?php echo $svr[0]?>">
							<input type="hidden" id="min" value="<?php echo $svr[1]?>">
							<input type="hidden" id="max" value="<?php echo $svr[2]?>">
							<input type="hidden" id="svr" value="<?php echo $svr[3]?>">
							<input type="hidden" id="net" value="<?php echo $svr[4]?>">
						</div>
					</div>
				</div>
				<div class="card mb-3">
					<div class="card-header">
						<div class="card-title"><?php echo $card_title?></div>
						<div class="card-options ">
							<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="mytbl" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>Host</th>
										<th>Name</th>
										<th>Network</th>
										<th>Type</th>
										<th>Value</th>
										<th>Severity</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>

	</div>
</div><!-- end app-content-->

<?php 
include "inc.foot.php";
include "inc.js.php";


$tname="core_node n left join core_status s on n.host=s.host";
$tnamex="core_node n left join core_status_sla s on n.host=s.host";

$where=""; $clso="";
if($mys_LOC!=''){ //session loc
	$where.= " and loc in ('$mys_LOC')";
}
?>

<script>
var today='<?php echo date('Y-m-d')?>';
var tname='<?php echo base64_encode($tname); ?>';
var tnamex='<?php echo base64_encode($tnamex); ?>';
var where='<?php echo base64_encode($where); ?>';

var mytbl, jvalidate;
$(document).ready(function(){
	page_ready();
	//$("#df").val(today);
	//$("#dt").val(today);
	mytbl = $("#mytbl").DataTable({
		serverSide: true,
		processing: true,
		searching: false,
		buttons: ['copy', 'csv'],
		lengthMenu: [[10,50,100,500,-1],["10","50","100","500","All"]],
		ajax: {
			type: 'POST',
			url: 'datatable<?php echo $ext?>',
			data: function (d) {
				d.cols= btoa($("#cols").val()+$("#fld").val()+",'"+$("#svr").val()+"'"),
				d.tname= get_tname(),
				d.where= getWhere(),
				d.x= '<?php echo $menu?>';
			}
		},
		initComplete: function(){
			dttbl_buttons(); //for ajax call
		}
	});
	//dttbl_buttons(); //remark this if ajax dttbl call
	//datepicker(true);
	//timepicker();
	jvalidate = $("#myf").validate({
    rules :{
        "tx" : {
            required : true
        },
		"tm" : {
			required : true
		}
    }});
	
	datepicker(true);
});
function get_tname(){
	return $("#df").val()==today||$("#df").val()==''?tname:tnamex;
}
function getWhere(){
	var net=''; var  loc='';
	var df=$("#df").val();
	var dt=$("#dt").val();
	if(df!=''&&df!=today){
		df=" and dt>='"+df+"'";
		if(dt!='') dt=" and dt<='"+dt+"'";
	}else{
		df=''; dt='';
	}
	if($("#net").val()!='') net=" and net='"+$("#net").val()+"'";
	if(where!='') loc=atob(where);
	return btoa($("#fld").val()+'>='+$("#min").val()+' and '+$("#fld").val()+'<='+$("#max").val()+net+df+dt+loc);
}
function submit_r_severity(){
	var a=$("#severity").val().split("|");
	$("#fld").val(a[0]);
	$("#min").val(a[1]);
	$("#max").val(a[2]);
	$("#svr").val(a[3]);
	$("#net").val(a[4]);
	
	mytbl.ajax.reload();
}
</script>

  </body>
</html>