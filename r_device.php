<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Device";
$modal_title="";
$card_title="Device Report";

$menu="rdevice";

$breadcrumb="Reports/$page_title";

include "inc.head.php";
include "inc.menutop.php";
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
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-3">
							<select class="form-control select2" id="loca">
							</select>
							</div>
							<div class="col-md-3">
							<select class="form-control" id="tipe">
							</select>
							</div>
							<div class="col-md-2">
							<select class="form-control" id="snmp">
								<option value="">All SNMP</option>
								<option value="1">Enabled</option>
								<option value="0">Disabled</option>
							</select>
							</div>
							&nbsp;&nbsp;&nbsp;
							<button type="button" onclick="reloadtbl();" class="btn btn-primary col-md-1">Submit</button>
							
							<input type="hidden" id="tname">
						</div>
					</div>
				</div>
				<div class="card">
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
										<th>Location</th>
										<th>Group</th>
										<th>Type</th>
										<th>Status</th>
										<th>SLA</th>
										<th>SNMP</th>
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
$cols="n.host,name,net,loc,grp,typ,status,n.sla,snmpenabled";
$csrc="";
$grpby="";
$where=""; $clso="";
if($mys_LOC!=''){ //session loc
	$where.= "loc in ('$mys_LOC')";
}

?>

<script>
var mytbl, jvalidate;
$(document).ready(function(){
	page_ready();
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
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.csrc= '<?php echo base64_encode($csrc); ?>',
				d.grpby= '<?php echo base64_encode($grpby); ?>',
				d.where= '<?php echo base64_encode($where); ?>',
				d.filtereq='loc,snmpenabled,typ',
				d.loc=$("#loca").val(),
				d.snmpenabled=$("#snmp").val(),
				d.typ=$("#tipe").val(),
				d.x= '-';
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
	$(".select2").select2();
	getCombo('dataget'+ext,'loclov','','#loca',dv='',blnk='All Location');
	getCombo('dataget'+ext,'typlov','','#tipe',dv='',blnk='All Type');
});

function reloadtbl(){
	mytbl.ajax.reload();
}
</script>

  </body>
</html>