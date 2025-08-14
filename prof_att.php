<?php 
//$restrict_lvl=array("0");

include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Attendance";
$modal_title="Attendance";
$card_title="$page_title";

$menu="myatt";

$breadcrumb="My Profile/$page_title";

$o_ltyp=[
	["Cuti","Cuti"],
	["Ijin","Ijin"],
	["Sakit","Sakit"],
	["Masuk","Masuk"],
	["Terlambat","Terlambat"]
];
$o_lstt=[
	["Approved","Approved"]
];

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
					<div class="card-header" style="display: flex;">
						<div class="card-title"><?php echo $card_title?></div>
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
</div><!-- end app-content-->

<!-- Modal-->
<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left modal_form">
  <div role="document" class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title"><?php echo $modal_title?></strong>
		<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
	  </div>
	  <div class="modal-body">
		<!--p>Lorem ipsum dolor sit amet consectetur.</p-->
		<form id="myfcvx" class="form-horizontal">
<!--hidden-->
<input type="hidden" name="rowid" id="rowid" value="0">
<input type="hidden" name="mnu" value="<?php echo $menu?>">
<input type="hidden" id="sv" name="sv" />
<input type="hidden" name="cols" value="nik,dt,edin,edout,reasonin,reasonout,typ,status" />
<input type="hidden" name="tname" value="hr_attend" />
		
		  <div class="row">
			<div class="form-group col-md-4">
				<label>Date</label>
				<input type="text" id="dt" name="dt" placeholder="..." class="form-control datepicker">
			</div>
			<div class="form-group col-md-4">
				<label>NIK</label>
				<input type="text" readonly id="nik" name="nik" placeholder="..." class="form-control">
			</div>
		    <div class="form-group col-md-4">
				<label>Name</label>
				<input type="text" readonly id="nama" name="nama" placeholder="..." class="form-control">
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-4">
				<label>IN</label>
				<input type="text" id="edin" name="edin" placeholder="..." class="form-control timepicker">
			</div>
			<div class="form-group col-md-8">
				<label>Remark IN</label>
				<input type="text" id="reasonin" name="reasonin" placeholder="..." class="form-control">
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-4">
				<label>OUT</label>
				<input type="text" id="edout" name="edout" placeholder="..." class="form-control timepicker">
			</div>
			<div class="form-group col-md-8">
				<label>Remark OUT</label>
				<input type="text" id="reasonout" name="reasonout" placeholder="..." class="form-control">
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-6">
				<label>Type</label>
				<select class="form-control " id="typ" name="typ">
					<option value="">-</option>
					<?php echo options($o_ltyp)?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Status</label>
				<!--input type="text" readonly id="status" name="status" placeholder="..." class="form-control"-->
				<select class="form-control reado" id="status" name="status">
					<option value="">-</option>
					<?php echo options($o_lstt)?>
				</select>
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-3">
				<label>Lat.IN</label>
				<input type="text" id="latin" name="latin" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-3">
				<label>Lng.IN</label>
				<input type="text" id="lngin" name="lngin" placeholder="..." class="form-control">
			</div>
		  
			<div class="form-group col-md-3">
				<label>Lat.OUT</label>
				<input type="text" id="latout" name="latout" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-3">
				<label>Lng.OUT</label>
				<input type="text" id="lngout" name="lngout" placeholder="..." class="form-control">
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-6">
				<label>Pict. In</label><br />
				<span id="potoin"></span>
			</div>
			<div class="form-group col-md-6">
				<label>Pict. Out</label><br />
				<span id="potoout"></span>
			</div>
		  </div>
		  
		</form>
	  </div>
	  <div class="modal-footer">
	  
		<!--button type="button" class="btn btn-danger" id="bdel"  onclick="confirmDelete();">Delete</button>
		<button type="button" class="btn btn-success" id="bsav" onclick="saveData();">Save</button-->
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		
	  </div>
	</div>
  </div>
</div>

<!-- Modal Batch -->
<div class="modal fade modal_form" id="modal_batch" tabindex="-1" role="dialog" aria-labelledby="formModalLabelBatch" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formModalLabelBatch">Batch <?php echo $modal_title ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!--div class="card"-->
					<form class="form-horizontal" id="myfx">
					<input type="hidden" name="rowid" id="rowid" value="0">
					<input type="hidden" name="mnu" value="<?php echo $menu?>_batch">
					<input type="hidden" id="svx" name="sv" />
					<input type="hidden" name="cols" value="" />
					<input type="hidden" name="tname" value="core_netdiagram" />
					
						<!--div class="card-body"-->
							<div class="form-group">
								<label class=""><b>Data :</b><br /> - Copy paste from spreadsheet<br /> - 1st row always header field<br /> -  need sample? click <a target="_blank" style="text-decoration:underline;" href="sample_topology.xlsx">here</a></label>
								<div class="">
									<textarea class="form-control" name="datas" rows="10" id="datas" placeholder="....."></textarea>
								</div>
							</div>
							
						<!--/div-->
					</form>
				<!--/div-->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" onclick="$('#svx').val('DEL');saveData('#myfx');">Delete</button>
				<button type="button" class="btn btn-warning" onclick="$('#svx').val('UPD');saveData('#myfx');">Update</button>
				<button type="button" class="btn btn-success" onclick="$('#svx').val('NEW');saveData('#myfx');">Insert</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Batch -->

<?php 
include "inc.foot.php";
include "inc.js.php";

$tname="hr_attend l left join hr_kary k on k.nik=l.nik";
$cols="dt,l.nik,nama,edin,reasonin,edout,reasonout,typ,l.rowid";
$csrc="l.nik,name,typ";
$where="(1=1)";
//if($_GET["stt"]!=""){
//	$where.=" and status='".$_GET["stt"]."'";
//}
//if($mys_LOC!=''){
	$where.=" and (l.nik='$s_NIK')";
//}
?>

<script>
var mytbl, jvalidate;
$(document).ready(function(){
	page_ready();
	mytbl = $("#mytbl").DataTable({
		serverSide: true,
		processing: true,
		searching: true,
		buttons: ['copy', 'csv'],
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
				d.x= '<?php echo $menu?>';
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});
	//dttbl_buttons(); //remark this if ajax dttbl call
	jvalidate = $("#myfcvx").validate({
    ignore: ":hidden:not(.selectpicker)",
	rules :{
        "edin" : {
            required : true
        },
		"edout" : {
			required : true
		},
		"reasonin" : {
			required : true
		},
		"reasonout" : {
			required : true
		},
		"typ" : {
			required : true
		}
    }});
	
	datepicker();
	timepicker();
	//selectpicker(true);
});

function reloadtbl(){
	mytbl.ajax.reload();
}

function mappicker(lat,lng,ttl=''){
	window.open("mapgugel"+ext+"?ttl="+ttl+"&lat="+$(lat).val()+"&lng="+$(lng).val(),"MapWindow","width=830,height=500,location=no").focus();
}

function openformcallback(q,json){
	var nimapi="<?php echo $nimapi?>files/";
	$("#potoin").html("");
	$("#potoout").html("");
	if(json!=''){
		var pin=json["msgs"][0]["photoin"];
		var pout=json["msgs"][0]["photoout"];
		if(pin!="") $("#potoin").html('<img style="height:200px; width:auto;" src="'+nimapi+pin+'">&nbsp;&nbsp;<button class="btn btn-info" type="button" onclick="mappicker(\'#latin\',\'#lngin\',\'IN\');"><i class="fa fa-map-pin"></i></button>');
		if(pout!="") $("#potoout").html('<img style="height:200px; width:auto;" src="'+nimapi+pout+'">&nbsp;&nbsp;<button class="btn btn-info" type="button" onclick="mappicker(\'#latout\',\'#lngout\',\'OUT\');"><i class="fa fa-map-pin"></i></button>');
	}
}

function cek(x){
	$.ajax({
		type: 'POST',
		url: 'datasave'+ext,
		data: {mnu:'cek'+x},
		success: function(data){
			var json = JSON.parse(data);
			alrt(json['msgs'],json['ttl'].toLowerCase(),json['ttl']);
			reloadtbl();
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