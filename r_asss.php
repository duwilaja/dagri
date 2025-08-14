<?php 
$restrict_lvl=array("0","1","2","11");

include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Assets";
$modal_title="";
$card_title="Assets Report";

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
			<!--div class="row">
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>BRAND</b></div>
					<select class="form-select">
						<option selected>ALL BRAND</option>
						<option value="1">INRICO</option>
						<option value="2">MOTOROLA</option>
						<option value="3">TD TECH</option>
						<option value="4">MILLTRAC</option>
						<option value="5">BELFONE</option>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>STATUS</b></div>
					<select class="form-select">
						<option selected>All STATUS</option>
						<option value="1">ACTIVE</option>
						<option value="2">ACTIVE STANDBY</option>
						<option value="3">STANDBY</option>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>EXPIRED</b></div>
					<select class="form-select">
						<option selected>YEAR</option>
						<option value="1">2024</option>
						<option value="2">2023</option>
						<option value="3">2022</option>
						<option value="4">2021</option>
					</select>
				</div>
				
			</div>

			<br><br-->
		
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
										<th>ID</th>
										<th>Name</th>
										<th>Desc</th>
										<th>Location</th>
										<th>S/N</th>
										<th>Brand</th>
										<th>Category</th>
										<th>Purchased</th>
										<th>Warranty Expired</th>
										<th>License Expired</th>
										<th>Status</th>
										
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


$tname="ass_ets";
$cols="assid,assname,assdesc,loc,sn,brand,cat,gr,warexp,licexp,stts";
$csrc="";
$grpby="";
$where="1=1"; $clso="";
if($mys_LOC!=''){ //session loc
	$where.= " AND loc in ('$mys_LOC')";
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
});

</script>

  </body>
</html>