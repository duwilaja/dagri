<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-home";
$page_title="My Profile";
$modal_title="My Profile";
$menu="profile";

$breadcrumb="Profile/$page_title";

$myprof=1;

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

						</div>
						<!--End Page header-->
									
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Personal Data</div>
										<div class="card-options ">
											
										</div>
									</div>
									<div class="card-body">
										<form id="myf" class="form-horizontal">
								<!--hidden-->
								<input type="hidden" name="rowid" id="rowid" value="0">
								<input type="hidden" name="mnu" value="<?php echo $menu?>">
								<input type="hidden" name="sv" value="UPD" />
								<input type="hidden" name="cols" value="uname" />
								<input type="hidden" name="tname" value="core_user" />
										
										  <div class="row">
											<div class="form-group col-md-6">
												<label>ID</label>
												<input type="text" readonly id="uid" name="uid" placeholder="..." class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Name</label>
												<input type="text" readonly id="uname" name="uname" placeholder="..." class="form-control">
											</div>
										  </div>
										  <div class="row">
											<div class="form-group col-md-6">
												<label>Location</label>
												<input type="text" readonly id="uloc" name="uloc" placeholder="..." class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Ticketing Group</label>
												<input type="text" readonly id="utick" name="utick" placeholder="..." class="form-control">
											</div>
										  </div>
										  <div class="row">
											<div class="form-group col-md-6">
												<label>NIK</label>
												<input readonly type="text" id="unik" name="unik" placeholder="..." class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Picture</label>
												<input type="file" id="favatar" name="favatar" accept="image/*" placeholder="..." class="form-control">
											</div>
										  </div>
										</form>
									</div>
									<div class="card-footer">
										<div class="pull-right">
											<button type="button" class="btn btn-warning" onclick="resetAvatar();">Reset Picture</button>
											<button type="button" class="btn btn-success" onclick="saveData();">Save</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Reset Password</div>
										<div class="card-options ">
											
										</div>
									</div>
									<div class="card-body">
										<form id="myfx" class="form-horizontal">
								<!--hidden-->
								<input type="hidden" name="rowid" id="rowid" value="0">
								<input type="hidden" name="mnu" value="passwd">
								<input type="hidden" name="sv" value="UPD" />
								<input type="hidden" name="cols" value="" />
								<input type="hidden" name="tname" value="" />
										
											<div class="form-group">
												<label>Old Password</label>
												<input type="password" id="op" name="op" placeholder="..." class="form-control">
											</div>
											<div class="row">
												<div class="form-group col-md-6">
													<label>New Password</label>
													<input type="password" id="np" name="np" placeholder="..." class="form-control">
												</div>
												<div class="form-group col-md-6">
													<label>Retype New Password</label>
													<input type="password" id="rp" name="rp" placeholder="..." class="form-control">
												</div>
											</div>
										</form>
									</div>
									<div class="card-footer">
										<div class="pull-right">
											<button type="button" class="btn btn-success" onclick="if($('#myfx').valid()){sendDataFile('UPD','#myfx');}">Save</button>
										</div>
									</div>
								</div>
								<br /><br />
								<div class="row hidden">
									<div class="col-md-4 text-center">
										<a title="Attendance" class="btn rounded-pill btn-primary" href="JavaScript:;" data-fancybox data-type="iframe" data-src="prof_att<?php echo $ext?>">Attendance</a>
									</div>
									<div class="col-md-4 text-center">
										<a title="Offtime" class="btn rounded-pill btn-danger" href="JavaScript:;" data-fancybox data-type="iframe" data-src="prof_leav<?php echo $ext?>">DayOff Request</a>
									</div>
									<div class="col-md-4 text-center">
										<a title="Reimbursement" class="btn rounded-pill btn-warning" href="JavaScript:;" data-fancybox data-type="iframe" data-src="prof_rem<?php echo $ext?>">Reimbursement</a>
									</div>
								</div>
							</div>
						</div>
						<br />
						<div class="row hidden">
							<div class="col-md-12">
				<div class="card">
					<div class="card-header justify-content-between border-bottom-0" style="display: flex;">
						<div class="card-title main-content-label mb-1">Absensi</div>
						<div class="card-options ">
							<button class="btn btn-sm btn-success" onclick="cek('in');">Check-In</button>&nbsp;&nbsp;
							<button class="btn btn-sm btn-danger" onclick="cek('out');">Check-Out</button>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="mytbl" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>Date</th>
										<th>NIK</th>
										<th>Name</th>
										<th>IN</th>
										<th>Remark IN</th>
										<th>OUT</th>
										<th>Remark OUT</th>
										<th>Type</th>
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


$tname="hr_attend l left join hr_kary k on k.nik=l.nik";
$cols="dt,l.nik,nama,edin,reasonin,edout,reasonout,typ,l.rowid";
$csrc="l.nik,name,typ";
$where="l.nik='$s_NIK'";
?>
<script>
var jvalidate,jvalidatex, mytbl;
$(document).ready(function(){
	page_ready();
	
	jvalidate = $("#myf").validate({
    ignore: ":hidden:not(.selectpicker)",
	rules :{
        "uname" : {
			required : true
		}
    }});
	
	jvalidatex = $("#myfx").validate({
    ignore: ":hidden:not(.selectpicker)",
	rules :{
        "op" : {
			required : true
		},
		"np" : {
			required : true
		},
		"rp" : {
			required : true,
			equalTo : "#np"
		}
    }});
	
	openForm('profile','<?php echo $s_ID?>');
	
	//absenku();
})

function absenku(){
	mytbl = $("#mytbl").DataTable({
		serverSide: true,
		processing: true,
		searching: true,
		//buttons: ['copy', 'csv'],
		order: [[0,'desc']],
		ajax: {
			type: 'POST',
			url: 'datatable<?php echo $ext?>',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.where= '<?php echo base64_encode($where); ?>',
				d.csrc= '<?php echo base64_encode($csrc); ?>',
				d.fdf=$("#fdf").val(),
				d.fdt=$("#fdt").val(),
				d.x= '-';
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});
}
function reloadabsen(){
	mytbl.ajax.reload();
}
function cek(x){
	$.ajax({
		type: 'POST',
		url: 'datasave'+ext,
		data: {mnu:'cek'+x},
		success: function(data){
			var json = JSON.parse(data);
			alrt(json['msgs'],json['ttl'].toLowerCase(),json['ttl']);
			reloadabsen();
		},
		error: function(xhr){
			//modal('Error','Server Error');
			alrt('Could not execute command '+q,'error','Error');
		}
	});
}
</script>

  </body>
</html>