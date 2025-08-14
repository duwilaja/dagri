<?php 
$restrict_lvl=array("0","1");

include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Tickets";
$modal_title="Ticket";
$card_title="$page_title";

$menu="tick";

$breadcrumb="Master/$page_title";

$o_lovtyp=[
	["group","Group"],
	["network","Network"],
	["devicetype","Device Type"]
];

include "inc.db.php";
$conn=connect();
$rs=exec_qry($conn,"select locid,name from core_location order by name");
$o_loc=fetch_all($rs);
$rs=exec_qry($conn,"select servid,servname from tick_serv order by servname");
$o_serv=fetch_all($rs);
$rs=exec_qry($conn,"select catid,catname from tick_cat order by catname");
$o_cat=fetch_all($rs);
disconnect($conn);


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
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>STATUS</b></div>
					<select id="fstts" class="form-select">
						<option value="">ALL STATUS</option>
						<?php echo options($o_tikstts)?>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>SERVICE</b></div>
					<select id="fsvc" class="form-select">
						<option value="">All SERVICE</option>
						<?php echo options($o_serv)?>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>CATEGORY</b></div>
					<select id="fcat" class="form-select">
						<option value="">All CATEGORY</option>
						<?php echo options($o_cat)?>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>GROUP</b></div>
					<select id="fgrp" class="form-select">
						<option value="">All GROUP</option>
						<?php echo options($o_tikgrp)?>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>&nbsp;</b></div>
					<button class="btn btn-success" onclick="reloadtbl()"><i class="fa fa-refresh"></i></button>
				</div>
		</div>
		<br /><br />
				<div class="card">
					<div class="card-header">
						<div class="card-title"><?php echo $card_title?></div>
						<div class="card-options ">
							<!--a href="#" onclick="$('#datas').val('');" data-toggle="modal" data-target="#modal_batch" title="Batch" class=""><i class="fe fe-upload"></i></a>
							--><a href="#" onclick="openForm(0);togglehide(0);" data-toggle="modal" data-target="#myModal" title="Add" class=""><i class="fe fe-plus"></i></a>
							<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="mytbl" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>Ticket#</th>
										<th>Date/Time</th>
										<th>Location</th>
										<th>Subject</th>
										<th>Detail</th>
										<th>Status</th>
										<th>Group</th>
										
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
<div id="myModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left modal_form">
  <div role="document" class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title"><?php echo $modal_title?></strong>
		<button type="button" data-dismiss="modal" aria-label="Close" class="close" onclick="togglehide(1);"><span aria-hidden="true">x</span></button>
	  </div>
	  <div class="modal-body">
		<!--p>Lorem ipsum dolor sit amet consectetur.</p-->
		<form id="myf" class="form-horizontal">
<!--hidden-->
<input type="hidden" name="rowid" id="rowid" value="0">
<input type="hidden" name="mnu" value="<?php echo $menu?>">
<input type="hidden" id="sv" name="sv" />
<input type="hidden" name="cols" value="dtm,loc,h,d,cat,svc,stts,grp,notes" />
<input type="hidden" name="tname" value="tick_ets" />
		
		  <div class="row mb-3">
			<div class="form-group col-md-6">
				<label>Ticket#</label>
				<input type="text" readonly id="ticketno" name="ticketno" placeholder="auto" class="form-control">
			</div>
			<div class="form-group col-md-6">
				<label>Report Date/Time</label>
				<input type="text" id="dtm" name="dtm" placeholder="..." class="form-control datetimepicker">
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-6">
				<label>Subject</label>
				<input type="text" id="h" name="h" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-6">
				<label>Desc</label>
				<textarea id="d" name="d" placeholder="..." class="form-control"></textarea>
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-6">
				<label>Location</label>
				<select class="form-control " id="loc" name="loc">
					<option value="">-</option>
					<?php echo options($o_loc)?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Service</label>
				<select class="form-control " id="svc" name="svc">
					<option value="">-</option>
					<?php echo options($o_serv)?>
				</select>
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-6">
				<label>Category</label>
				<select class="form-control " id="cat" name="cat">
					<option value="">-</option>
					<?php echo options($o_cat)?>
				</select>
			</div>
			<div class="form-group col-md-6 hideme">
				<label>Status</label>
				<select class="form-control " id="stts" name="stts">
					<option value="">-</option>
					<?php echo options($o_tikstts)?>
				</select>
			</div>
		  </div>
		  <div class="row mb-3 hideme">
			<div class="form-group col-md-6">
				<label>Group</label>
				<select class="form-control " id="grp" name="grp">
					<option value="">-</option>
					<?php echo options($o_tikgrp)?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Notes</label>
				<textarea id="note" name="notes" placeholder="..." class="form-control"></textarea>
			</div>
		  </div>
		  
		  <div class="row mb-3 hidden">
			<div class="form-group col-md-6">
				<label>Purchased</label>
				<div class="input-group">
					<input type="text" id="gr" name="gr" placeholder="" class="form-control datepicker">
					<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label>Warranty Expired</label>
				<div class="input-group">
					<input type="text" id="warexp" name="warexp" placeholder="" class="form-control datepicker">
					<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
				</div>
			</div>
		  </div>
		  
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" onclick="$('#modal_notes').modal('show');mytblx.ajax.reload();" class="btn btn-warning hideme">Notes</a>
	    <button type="button" class="btn btn-danger" id="bdel"  onclick="confirmDelete();">Delete</button>
		<button type="button" class="btn btn-success" onclick="b4sef(); saveData();">Save</button>
		<button type="button" data-dismiss="modal" class="btn btn-default" onclick="togglehide(1);">Close</button>
		
	  </div>
	</div>
  </div>
</div>

<!-- Modal Notes -->
<div class="modal fade modal_form" id="modal_notes" tabindex="1" role="dialog" aria-labelledby="formModalLabelNotes" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="background: #303030;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formModalLabelNotes">Notes</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
						<div class="table-responsive">
							<table id="mytblx" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>Date/Time</th>
										<th>Notes</th>
										<th>Status</th>
										<th>By</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Notes -->


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
					<input type="hidden" name="tname" value="ass_ets" />
					
						<!--div class="card-body"-->
							<div class="form-group">
								<label class=""><b>Data :</b><br /> - Copy paste from spreadsheet<br /> - 1st row always header field<br /> -  need sample? click <a target="_blank" style="text-decoration:underline;" href="sample_asset.xlsx">here</a></label>
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

$tname="tick_ets";
$cols="ticketno,dtm,loc,h,d,stts,grp,rowid";
$csrc="ticketno,h";

?>

<script>
var mytbl, jvalidate, mytblx;
$(document).ready(function(){
	$('#myModal').modal({
	   backdrop: 'static',
	   keyboard: false
	});
	page_ready();
	mytbl = $("#mytbl").DataTable({
		serverSide: true,
		processing: true,
		searching: true,
		buttons: ['copy', 'csv'],
		order: [[0,"desc"]],
		ajax: {
			type: 'POST',
			url: 'datatable<?php echo $ext?>',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.csrc= '<?php echo base64_encode($csrc); ?>',
				d.filtereq= 'grp,cat,svc,stts',
				d.cat= $("#fcat").val(),
				d.grp= $("#fgrp").val(),
				d.svc= $("#fsvc").val(),
				d.stts= $("#fstts").val(),
				d.x= '<?php echo $menu?>';
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});
	mytblx = $("#mytblx").DataTable({
		serverSide: true,
		processing: true,
		searching: false,
		//buttons: ['copy', 'csv'],
		order: [[0,"desc"]],
		ajax: {
			type: 'POST',
			url: 'datatable<?php echo $ext?>',
			data: function (d) {
				d.cols= '<?php echo base64_encode("dtm,notes,stts,updby"); ?>',
				d.tname= '<?php echo base64_encode("tick_note"); ?>',
				d.filtereq= 'ticketno',
				d.ticketno=$("#ticketno").val(),
				d.x= '-';
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});
	//dttbl_buttons(); //remark this if ajax dttbl call
	jvalidate = $("#myf").validate({
    ignore: ":hidden:not(.selectpicker)",
	rules :{
        "h" : {
            required : true
        },
		"d" : {
			required : true
		},
		"loc" : {
			required : true
		},
		"svc" : {
			required : true
		},
		"cat" : {
			required : true
		},
		"dtm" : {
			required : true
		},
		"grp" : {
			required : function(){
				if($("#rowid").val()==0) return false;
				
				return true;
			}
		},
		"stts" : {
			required : function(){
				if($("#rowid").val()==0) return false;
				
				return true;
			}
		},
		"notes" : {
			required : function(){
				if($("#rowid").val()==0) return false;
				
				return true;
			}
		}
    }});
	
	datepicker(true);
	datetimepicker();
	//selectpicker(true);
});

function reloadtbl(){
	mytbl.ajax.reload();
}

function togglehide(id){
	if(id==0){
		$(".hideme").hide();
	}else{
		$(".hideme").show();
	}
}
function b4sef(){
	if($("#rowid").val()==0){
		$("#grp").val("EOS");
		$("#stts").val("new");
	}
	if($("#myf").valid()){ $(".hideme").show(); }
}
</script>

  </body>
</html>