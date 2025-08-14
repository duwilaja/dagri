<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Devices";
$modal_title="";
$card_title="Devices Status";

$menu="ndevice";

$breadcrumb="Objects/$page_title";

include "inc.head.php";
include "inc.menutop.php";

include "inc.db.php";
$conn=connect();
$wherloc=$mys_LOC==''?'':"where locid in ('$mys_LOC')";
$rs=exec_qry($conn,"select locid,name from core_location $wherloc order by name");
$o_loc=fetch_all($rs);
$rs=exec_qry($conn,"select val,txt from core_lov where typ='group' order by txt");
$o_grp=fetch_all($rs);
$rs=exec_qry($conn,"select val,txt from core_lov where typ='devicetype' order by txt");
$o_typ=fetch_all($rs);
$rs=exec_qry($conn,"select val,txt from core_lov where typ='network' order by txt");
$o_net=fetch_all($rs);
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
			<div class="row pb-4">
				<div class="col-xl-2">
					<div class="small text-opacity-50 mb-2 "><b>GROUP</b></div>
					<select class="form-control select2" id="grp">
						<option value="">All Group</option>
						<?php echo options($o_grp)?>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-opacity-50 mb-2 "><b>LOCATION</b></div>
					<select class="form-control select2" id="loc">
						<option value="">All Location</option>
						<?php echo options($o_loc)?>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-opacity-50 mb-2 "><b>NETWORK</b></div>
					<select class="form-control select2" id="net">
						<option value="">All Network</option>
						<?php echo options($o_net)?>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-opacity-50 mb-2 "><b>TYPE</b></div>
					<select class="form-control select2" id="typ">
						<option value="">All Type</option>
						<?php echo options($o_typ)?>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-opacity-50 mb-2 "><b>STATUS</b></div>
					<select class="form-control select2" id="status">
						<option value="">All STATUS</option>
						<option value="1">UP</option>
						<option value="0">DOWN</option>
					</select>
				</div>
				<div class="col-xl-2 pt-3">
					<button type="button" onclick="reloadtbl();" class="btn btn-primary my-2 btn-icon-text">Filter</button>
				</div>
			</div>
		
			<div>&nbsp;</div>
				<div class="card">
					<div class="card-header hidden">
						<div class="card-title"><?php echo $card_title?></div>
						<div class="card-options hidden">
							<a href="#" title="Refresh" onclick="reloadtbl();"><i class="fe fe-refresh-cw"></i></a>
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
										<th>Status</th>
										<th>Network</th>
										<th>Province</th>
										<!--th>Group</th-->
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
<div id="myModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left modal_form">
  <div role="document" class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title"><?php echo $modal_title?></strong>
		<button type="button" data-dismiss="modal" aria-label="Close" class="close" onclick=""><span aria-hidden="true">x</span></button>
	  </div>
	  <div class="modal-body">
		<!--p>Lorem ipsum dolor sit amet consectetur.</p-->
		<form id="myf" class="form-horizontal">
<!--hidden-->
<input type="hidden" name="rowid" id="rowid" value="0">
<input type="hidden" name="mnu" value="tick">
<input type="hidden" id="sv" name="sv" />
<input type="hidden" name="cols" value="dtm,loc,h,d,cat,svc" />
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
				<select class="form-control " id="locf" name="loc">
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
			<div class="form-group col-md-6 hidden">
				<label>Status</label>
				<select class="form-control " id="stts" name="stts">
					<option value="">-</option>
					<?php echo options($o_tikstts)?>
				</select>
			</div>
		  </div>
		  <div class="row mb-3 hidden">
			<div class="form-group col-md-6">
				<label>Group</label>
				<select class="form-control " id="grp" name="grp">
					<option value="">-</option>
					<?php echo options($o_tikgrp)?>
				</select>
			</div>
		  </div>
		  <hr />
		  <div class="row mb-3 hidden">
			<div class="form-group col-md-6">
				<label>Notes</label>
				<textarea id="note" name="notes" placeholder="..." class="form-control"></textarea>
			</div>
			<div class="form-group col-md-6">
				<label>Attachment</label>
				<input type="file" id="attc" name="attc" placeholder="..." class="form-control">
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
		<button type="button" onclick="$('#modal_notes').modal('show');mytblx.ajax.reload();" class="btn btn-warning hidden">History</button>
	    <button type="button" class="btn btn-danger hidden" id="bdel"  onclick="confirmDelete();">Delete</button>
		<button type="button" class="btn btn-success" onclick="saveData();">Save</button>
		<button type="button" data-dismiss="modal" class="btn btn-default" onclick="">Close</button>
		
	  </div>
	</div>
  </div>
</div>

<?php 
include "inc.foot.php";
include "inc.js.php";

//include "inc.db.php";

$loc=get("loc")==""?"1=1":"loc='".get("loc")."'";
$status=get("status")==""?"1=1":"status='".get("status")."'";
$prov=get("prov")==""?"1=1":"prov='".get("prov")."'";

$where = "$loc and $status and $prov";

$tname="core_node n left join core_status s on n.host=s.host left join core_location l on n.loc=l.locid";
$cols="n.host,n.name,if(status=1,'UP','DOWN') as stt,net,loc,grp,typ,n.rowid";
$csrc="n.host,n.name,net,loc,grp,typ";
$tname="core_node n left join core_status s on n.host=s.host left join core_location l on l.locid=loc";
$cols="n.host,n.name,if(status=1,'UP','DOWN') as stt,net,loc,grp,typ,n.rowid";
$cols="n.host,n.name,if(status=1,'UP','DOWN') as stt,net,prov,typ,loc,n.rowid";
$csrc="n.host,n.name,net,prov,typ";
$grpby="";

$cari=post("cari");

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
		searching: true,
		buttons: ['copy', 'csv'],
		lengthMenu: [[10,50,100,500,-1],["10","50","100","500","All"]],
		search: {
			search: "<?php echo $cari?>"
		},
		ajax: {
			type: 'POST',
			url: 'datatable<?php echo $ext?>',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.csrc= '<?php echo base64_encode($csrc); ?>',
				d.where= '<?php echo base64_encode($where); ?>',
				d.grpby= '<?php echo base64_encode($grpby); ?>',
				d.status= $("#status").val(),
				d.net= $("#net").val(),
				d.loc= $("#loc").val(),
				d.typ= $("#typ").val(),
				d.grp= $("#grp").val(),
				d.filtereq= "status,net,loc,typ,grp",
				d.x= '<?php echo $menu?>';
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
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

function reloadtbl(){
	mytbl.ajax.reload();
}

function ticks(nm,loc){
	$("#myf")[0].reset();
	$("#myModal").modal("show");
	jvalidate.resetForm();
	$("#locf").val(loc);
	$("#h").val(nm);
}

</script>

  </body>
</html>