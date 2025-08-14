<?php 
$restrict_lvl=array("0","1","2");

include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Activity";
$modal_title="";
$card_title="Activity Report";

$menu="-";

$breadcrumb="Reports/$page_title";

include "inc.head.php";
include "inc.menutop.php";

include "inc.db.php";
$where="";
$o_kar=array();
if($s_LVL>1){
	$where="l.nik='$s_NIK'";
	$sql="select nama,nama from hr_kary where nik='$s_NIK' order by nama";
}else{
	$sql="select nama,nama from hr_kary order by nama";
}

$conn=connect();
$rs=exec_qry($conn,$sql);
$o_kar=fetch_all($rs);
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
						<form method="post" target="_blank" action="r_absenx<?php echo $ext?>">
						<div class="row">
							<div class="col-md-2"><div class="input-group">
								<input type="text" id="fdf" name="df" placeholder="From Date" class="form-control datepicker" value="<?php echo date('Y-m-d')?>">
								<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
							</div></div>
							<div class="col-md-2"><div class="input-group">
								<input type="text" id="fdt" name="dt" placeholder="To Date" class="form-control datepicker">
								<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
							</div></div>
							<div class="col-md-4">
							<select class="form-control select2" id="nikx" name="nikx">
								<option value="">All</option>
								<?php echo options($o_kar)?>
							</select>
							</div>
							<div class="col-md-1">
							<button type="button" onclick="reloadtbl();" class="btn btn-primary">Refresh</button>
							</div>
							<!--div class="col-md-1">
							<button type="button" onclick="this.form.submit();" class="btn btn-info">Download</button>
							</div-->
							<input type="hidden" id="tname">
						</div>
						</form>
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
										<th>Date/Time</th>
										<th>NIK</th>
										<th>Name</th>
										<th>Note</th>
										<th>Img</th>
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

$img="concat('<a target=\"_blank\" href=\"story/',photo,'\">',photo,'</a>') as img";

$tname="hr_story l left join hr_kary k on k.nik=l.nik";
$cols="dtm,l.nik,nama,txt,$img,l.rowid";
$csrc="l.nik,nama";
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
				d.where= '<?php echo base64_encode($where); ?>',
				d.fdtmf=$("#fdf").val(),
				d.fdtmt=$("#fdt").val(),
				d.filtereq="nama",
				d.nama=$("#nikx").val(),
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
	
	datepicker();
	$(".select2").select2();

});

function reloadtbl(){
	mytbl.ajax.reload();
}

</script>

  </body>
</html>