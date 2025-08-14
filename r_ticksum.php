<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Ticket Summary";
$modal_title="";
$card_title="Ticket Report";

$menu="-";

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
		<div class="row">
				<div class="col-md-2"><div class="small text-opacity-50 mb-2"><b>FROM</b></div>
					<div class="input-group">
					<input type="text" id="df" placeholder="" class="form-control datepicker">
					<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
				</div></div>
				<div class="col-md-2"><div class="small text-opacity-50 mb-2"><b>TO</b></div>
					<div class="input-group">
					<input type="text" id="dt" placeholder="" class="form-control datepicker">
					<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
				</div></div>
				<div class="col-xl-2 pt-3">
					<button type="button" onclick="reloadtbl()" class="btn btn-primary my-2 btn-icon-text">Filter</button>
				</div>
		</div>
		<div class="row" style="">
			<div class="col-md-6">
		
				<div class="card">
					<div class="card-header">
						<div class="card-title">By Location</div>
						<div class="card-options ">
							<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="satu" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>Location</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
		
				<div class="card">
					<div class="card-header">
						<div class="card-title">By Status</div>
						<div class="card-options ">
							<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="dua" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>Status</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="row" style="">
			<div class="col-md-6">
		
				<div class="card">
					<div class="card-header">
						<div class="card-title">By Category</div>
						<div class="card-options ">
							<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="tiga" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>Category</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-6">
		
				<div class="card">
					<div class="card-header">
						<div class="card-title">By Service</div>
						<div class="card-options ">
							<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="empat" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>Service</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div><!-- end app-content-->

<?php 
include "inc.foot.php";
include "inc.js.php";


$tname="tick_ets";
$cols="assid,assname,assdesc,loc,sn,brand,cat,gr,warexp,stts";
$csrc="";
$grpby="";

$where="1=1"; $clso="";
if($mys_LOC!=''){ //session loc
	$where.= " AND loc in ('$mys_LOC')";
}

?>

<script>
var mytbl1, mytbl2, mytbl3, mytbl4, mytbl5, mytbl6, mytbl7, mytbl8, mytbl9, jvalidate;

function loadTable(divid,cols,tname,where,grpby,x){
var mytbl=$(divid).DataTable({
	buttons: [
            'copy', 'csv'
        ],
	searching: false,
	serverSide: true,
	processing: true,
	ordering: true,
	order: [[ 0, "asc" ]],
		ajax: {
			type: 'POST',
			url: 'datatable.php',
			data: function (d) {
				d.cols= cols,
				d.tname= tname,
				d.csrc= '',
				d.where= where,
				d.grpby= grpby,
				d.fdtmf= $("#df").val(),
				d.fdtmt= $("#dt").val(),
				d.x= x;
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});
	
	return mytbl;
}

$(document).ready(function(){
	page_ready();
	/*mytbl = $("#mytbl").DataTable({
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
				d.x= '<?php echo $menu?>';
			}
		},
		initComplete: function(){
			dttbl_buttons(); //for ajax call
		}
	});*/
	//dttbl_buttons(); //remark this if ajax dttbl call
	//datepicker(true);
	//timepicker();
	/*jvalidate = $("#myf").validate({
    rules :{
        "tx" : {
            required : true
        },
		"tm" : {
			required : true
		}
    }});*/
	mytbl1 = loadTable('#satu','<?php echo base64_encode("loc,count(loc) as cnt"); ?>','<?php echo base64_encode($tname); ?>','<?php echo base64_encode($where);?>','<?php echo base64_encode("loc");?>','-');
	mytbl2 = loadTable('#dua','<?php echo base64_encode("stts,count(stts) as cnt"); ?>','<?php echo base64_encode($tname); ?>','<?php echo base64_encode($where);?>','<?php echo base64_encode("stts");?>','-');
	mytbl3 = loadTable('#tiga','<?php echo base64_encode("cat,count(cat) as cnt"); ?>','<?php echo base64_encode($tname); ?>','<?php echo base64_encode($where);?>','<?php echo base64_encode("cat");?>','-');
	mytbl4 = loadTable('#empat','<?php echo base64_encode("svc,count(svc) as cnt"); ?>','<?php echo base64_encode($tname); ?>','<?php echo base64_encode($where);?>','<?php echo base64_encode("svc");?>','-');
	
	datepicker(true);
});
function reloadtbl(){
	mytbl1.ajax.reload();
	mytbl2.ajax.reload();
	mytbl3.ajax.reload();
	mytbl4.ajax.reload();
}
</script>

  </body>
</html>