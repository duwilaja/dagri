<?php 
$restrict_lvl=array("0","1","2");

include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="DayOff Request";
$modal_title="";
$card_title="DayOff Report";

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
				<div class="mb-3">
					<div class="card-body">
						<div class="row">
							<div class="col-md-2"><div class="input-group">
								<input type="text" id="fdf" placeholder="From Date" class="form-control datepicker" value="<?php echo date('Y-m-d')?>">
								<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
							</div></div>
							<div class="col-md-2"><div class="input-group">
								<input type="text" id="fdt" placeholder="To Date" class="form-control datepicker">
								<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
							</div></div>
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
										<th>NIK</th>
										<th>Name</th>
										<th>From</th>
										<th>To</th>
										<th>Type</th>
										<th>Status</th>
										<th>Remark</th>
										
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


$tname="hr_leav l left join hr_kary k on k.nik=l.nik";
$cols="l.nik,nama,dtf,dtt,typ,status,rmk,l.rowid";
$csrc="l.nik,name,typ";

$where="";
$grpby="";
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
				d.where= getWhere(),
				d.x= '-';
			}
		},
		initComplete: function(){
			dttbl_buttons(); //for ajax call
		}
	});
	//dttbl_buttons(); //remark this if ajax dttbl call
	datepicker(true);
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
	
	datepicker();

});

function reloadtbl(){
	mytbl.ajax.reload();
}

function getWhere(){
	var ret='(1=1)';
	var dtf=$("#fdf").val().trim();
	var dtt=$("#fdt").val().trim();
	if(dtf!='') ret+=" and (dtf>='"+dtf+"')";
	if(dtt!='') ret+=" and (dtt<='"+dtt+"')";
	
	return btoa(ret);
}
</script>

  </body>
</html>