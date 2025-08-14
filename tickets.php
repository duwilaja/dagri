<?php 
//$restrict_lvl=array("0","1");

include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Tickets";
$modal_title="Ticket";
$card_title="$page_title";

$menu="tick";

$breadcrumb="Ticketing/$page_title";

$o_lovtyp=[
	["group","Group"],
	["network","Network"],
	["devicetype","Device Type"]
];

include "inc.db.php";
$conn=connect();
$wherloc=$mys_LOC==''?'':"where locid in ('$mys_LOC')";
$rs=exec_qry($conn,"select locid,name from core_location $wherloc order by name");
$o_loc=fetch_all($rs);
$rs=exec_qry($conn,"select servid,servname from tick_serv order by servname");
$o_serv=fetch_all($rs);
$rs=exec_qry($conn,"select catid,catname from tick_cat order by catname");
$o_cat=fetch_all($rs);
disconnect($conn);

$ox=get("o");
$myg=get("g");
$mine=get("m");

$where="1=1"; $clso="";
if($ox=="1"){
	//$clso="hidden";
	$page_title="Tickets in Progress";
	$where="stts in ('progress','pending')";
}
if($mys_LOC!=''){ //session loc
	$where.= " AND loc in ('$mys_LOC')";
}
if($myg=="1"||$s_TICK=='LINK'){
	$where.= " AND grp='$s_TICK'";
	if($myg=="1") $page_title="My Group";
}
if($mine=="1"){
	$page_title="My Tickets";
	$where.= " AND (updby='$s_ID' OR creby='$s_ID')";
}

$prov=get("prov");
$loc=get("loc");
$stt=get("s");
if($loc!=''){
	$where.= " AND loc='$loc'";
	$clso="hidden";
}
if($stt!=''){
	$where.= " AND stts='$stt'";
	$clso="hidden";
}
if($prov!=''){
	$where.=" AND loc in (select locid from core_location where prov='$prov')";
	$clso="hidden";
}

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
		<div class="row <?php echo $clso;?>">
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
		<div class="row <?php echo $clso;?>">
			<div class="col-xl-2">
				<div class="small text-opacity-50 mb-2"><b>STATUS</b></div>
				<select class="form-control select2" id="fstts">
					<option value="">All STATUS</option>
					<?php echo options($o_tikstts)?>
				</select>
			</div>
			<div class="col-xl-2">
				<div class="small text-opacity-50 mb-2"><b>SERVICE</b></div>
				<select id="fsvc" class="form-control select2">
					<option value="">All SERVICE</option>
					<?php echo options($o_serv)?>
				</select>
			</div>
			<div class="col-xl-2">
				<div class="small text-opacity-50 mb-2"><b>CATEGORY</b></div>
				<select id="fcat" class="form-control select2">
					<option value="">All CATEGORY</option>
					<?php echo options($o_cat)?>
				</select>
			</div>
			<div class="col-xl-2">
				<div class="small text-opacity-50 mb-2"><b>GROUP</b></div>
				<select id="fgrp" class="form-control select2">
					<option value="">All GROUP</option>
					<?php echo options($o_tikgrp)?>
				</select>
			</div>
			<div class="col-xl-2">
				<div class="small text-opacity-50 mb-2"><b>LOCATION</b></div>
				<select id="floc" class="form-control select2">
					<option value="">All LOCATION</option>
					<?php echo options($o_loc)?>
				</select>
			</div>
			<div class="col-xl-2 pt-3">
				<button type="button" onclick="reloadtbl()" class="btn btn-primary my-2 btn-icon-text">Filter</button>
			</div>
		</div>
		<br />
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
										<th>Status</th>
										<th>Priority</th>
										<th>Location</th>
										<th>Suspect</th>
										<th>Detail</th>
										<th>Category</th>
										<th>Group</th>
										<th>Report Date/Time</th>
										<th>Created</th>
										<th>By</th>
										
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
  <div role="document" class="modal-dialog modal-lg modal-xxl">
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
<input type="hidden" name="cols" value="dtm,loc,h,d,cat,svc,stts,grp,notes,sn,prio,caus,solu" />
<input type="hidden" name="tname" value="tick_ets" />
<input type="hidden" name="created" id="created" value="" />
		
		  <div class="row mb-3">
			<div class="form-group col-md-4 hideme">
				<label>Ticket#</label>
				<input type="text" readonly id="ticketno" name="ticketno" placeholder="auto" class="form-control">
			</div>
			<div class="form-group col-md-4">
				<label>Report Date/Time</label>
				<input type="text" id="dtm" name="dtm" placeholder="..." class="form-control datetimepicker reado">
			</div>
		  <!--/div>
		  <div class="row mb-3"-->
			<div class="form-group col-md-4 hideme">
				<label>Created By</label>
				<input type="text" readonly id="creby" name="creby" placeholder="auto" class="form-control">
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-4">
				<label>Suspect</label>
				<input type="text" id="h" name="h" placeholder="..." class="form-control reado">
			</div>
			<div class="form-group col-md-4">
				<label>Desc</label>
				<textarea id="d" name="d" placeholder="..." class="form-control reado"></textarea>
			</div>
			<div class="form-group col-md-4">
				<label>Location</label>
				<select class="form-control reado" id="loc" name="loc" onchange="getsn(this.value);">
					<option value="">-</option>
					<?php echo options($o_loc)?>
				</select>
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-4">
				<label>Service</label>
				<select class="form-control " id="svc" name="svc">
					<option value="">-</option>
					<?php echo options($o_serv)?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label>Category</label>
				<select class="form-control " id="cat" name="cat">
					<option value="">-</option>
					<?php echo options($o_cat)?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label>Priority</label>
				<select class="form-control " id="prio" name="prio">
					<option value="">-</option>
					<?php echo options($o_prio)?>
				</select>
			</div>
		  </div>
		  <div class="row mb-3 hideme">
			<div class="form-group col-md-4">
				<label>Asset</label>
				<select class="form-control " id="sn" name="sn">
					<option value="">-</option>
				</select>
				<!--input type="text" id="sn" name="sn" placeholder="..." class="form-control"-->
			</div>
			<div class="form-group col-md-4">
				<label>Assigned To</label>
				<select class="form-control " id="grp" name="grp">
					<option value="">-</option>
					<?php echo options($o_tikgrp)?>
				</select>
			</div>
			<div class="form-group col-md-4 hideme">
				<label>Status</label>
				<select class="form-control " id="stts" name="stts">
					<option value="">-</option>
					<?php echo options($o_tikstts)?>
				</select>
			</div>
		  </div>
		  <!--div class="row mb-3 hideme">
			<div class="form-group col-md-6 notipme hidden">
				<label>Send notification to</label>
				<select class="form-control " id="usr" name="usr">
					<option value="">-</option>
				</select>
			</div>
		  </div-->
		  <hr />
		  <div class="row mb-3 hideme">
			<div class="form-group col-md-6">
				<label>Notes</label>
				<textarea id="note" name="notes" placeholder="..." class="form-control"></textarea>
			</div>
			<div class="form-group col-md-6">
				<label>Attachment</label>
				<input type="file" id="attc" name="attc" placeholder="..." class="form-control">
			</div>
		  </div>
		  
		  <div class="row mb-3 hideme">
			<div class="form-group col-md-6">
				<label>Cause</label>
				<input type="text" id="caus" name="caus" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-6">
				<label>Solution</label>
				<textarea id="solu" name="solu" placeholder="..." class="form-control"></textarea>
			</div>
		  </div>
		  
		</form>
	  </div>
	  <div class="modal-footer">
		<!--button type="button" onclick="$('#modal_notes').modal('show');mytblx.ajax.reload();" class="btn btn-warning hideme">History</a-->
	    <button type="button" onclick="panci();" class="btn btn-warning hideme">History</button>
		<?php if($s_LVL==0){?>
	    <button type="button" class="btn btn-danger" id="bdel"  onclick="confirmDelete();">Delete</button>
		<?php }?>
		<button type="button" class="btn btn-success" onclick="b4sef(); saveData();">Save</button>
		<button type="button" data-dismiss="modal" class="btn btn-default" onclick="togglehide(1);">Close</button>
		
	  </div>
	</div>
  </div>
</div>

<!-- Modal Notes -->
<div class="modal fade modal_form" id="modal_notes" tabindex="1" role="dialog" aria-labelledby="formModalLabelNotes" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="background: #303030; max-width: 1200px;">
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
										<th>Attachment</th>
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

$tname="tick_ets t left join tick_cat c on t.cat=c.catid left join core_location l on l.locid=t.loc left join core_user u on u.uid=creby";
$cols="ticketno,stts,prio,name,h,d,catname,grp,dtm,created,uname,t.rowid";
$csrc="ticketno,h,name";

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
				d.where= '<?php echo base64_encode($where); ?>',
				d.filtereq= 'grp,cat,svc,stts,loc,prio',
				d.cat= $("#fprio").val(),
				d.cat= $("#fcat").val(),
				d.grp= $("#fgrp").val(),
				d.svc= $("#fsvc").val(),
				d.stts= $("#fstts").val(),
				d.loc= $("#floc").val(),
				d.fdtmf= $("#df").val(),
				d.fdtmt= $("#dt").val(),
				d.x= '<?php echo $menu?>';
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});
	/*mytblx = $("#mytblx").DataTable({
		serverSide: true,
		processing: true,
		searching: false,
		//buttons: ['copy', 'csv'],
		order: [[0,"desc"]],
		ajax: {
			type: 'POST',
			url: 'datatable<?php echo $ext?>',
			data: function (d) {
				d.cols= '<?php echo base64_encode("dtm,notes,stts,updby,attc"); ?>',
				d.tname= '<?php echo base64_encode("tick_note"); ?>',
				d.filtereq= 'ticketno',
				d.ticketno=$("#ticketno").val(),
				d.x= 'ticknotes';
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});*/
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
		"usr" : {
			required : function(){
				if($("#stts").val()=="pending") return true;
				
				return false;
			}
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
	$(".select2").select2();
	
	menus();
});

function reloadtbl(){
	mytbl.ajax.reload();
}

function openformcallback(q,json=''){
	var dv='';
	var loc=$("#loc").val();
	if(json!=''){
		dv=json['msgs'][0]['sn'];
	}
	getsn(loc,dv);
}

function togglehide(id){
	if(id==0){
		$(".hideme").hide();
		$(".reado").attr("readonly",false);
	}else{
		$(".hideme").show();
		$(".reado").attr("readonly",true);
	}
}
function b4sef(){
	if($("#rowid").val()==0){
		$("#grp").val("EOS");
		$("#stts").val("new");
		mytbl.order([9,"desc"]);
	}
	if($("#myf").valid()){ $(".hideme").show(); }
}

function panci(){
	$.fancybox.open(
	  {
		src: "tickhis"+ext+'?id='+$("#ticketno").val(),
		type: "iframe",
		preload: false,
//		width: 600,
//		height: 300,
	  },
	);
}

function getsn(loc,dv=''){
	getCombo("dataget"+ext,'assno',loc,"#sn",dv);
}

function notip(){
	var s=$("#stts").val();
	var g=$("#grp").val();
	if(s=='pending'){
		$(".notipme").show();
		getCombo("dataget"+ext,'ticknot',g,"#usr");
	}else{
		$(".notipme").hide();
		$("#usr").find('option').remove();
	}
}

var ox='<?php echo $ox;?>';
var myg='<?php echo $myg;?>';
var mine='<?php echo $mine;?>';
function menus(){
	var  act=false;
	$(".tickets").removeClass("active");
	if(ox=='1'){
		$(".prgrs").addClass("active"); act=true;
	}
	if(mine=='1'){
		$(".mytix").addClass("active"); act=true;
	}
	if(myg=='1'){
		$(".mygrp").addClass("active"); act=true;
	}
	if(!act){
		$(".altix").addClass("active");
	}
}
</script>

  </body>
</html>