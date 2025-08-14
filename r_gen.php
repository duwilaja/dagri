<?php 
//$restrict_lvl=array("0","1");

include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Generate Report";
$modal_title="Generate Report";
$card_title="$page_title";

$menu="rgen";

$breadcrumb="Report/$page_title";

$o_lovrpt=[
	["ping","ping"],
	["traffic","traffic"],
	["wan1","wan1 traffic"],
	["wan2","wan2 traffic"]
];

$gx=($s_GRP=="")?"":" and val='$s_GRP'";

include "inc.db.php";
$conn=connect();
$rs=exec_qry($conn,"select val,txt from core_lov where typ='group' $gx order by txt");
$o_grp=fetch_all($rs);
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
		
				<div class="card">
					<div class="card-header">
						<div class="card-title"><?php echo $card_title?></div>
						<div class="card-options ">
							<!--a href="#" onclick="$('#datas').val('');" data-toggle="modal" data-target="#modal_batch" title="Batch" class=""><i class="fe fe-upload"></i></a>
							-->
							<a href="#" onclick="openForm(0);" data-toggle="modal" data-target="#myModal" title="Add" class=""><i class="fe fe-plus"></i></a>
							<a href="#" title="Refresh" onclick="reloadtbl();"><i class="fe fe-refresh-cw"></i></a>
							<!--a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="mytbl" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>Title</th>
										<th>Desc.</th>
										<th>Report</th>
										<th>From</th>
										<th>To</th>
										<th>Group</th>
										<th>Status</th>
										<th>JobID</th>
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
		<form id="myf" class="form-horizontal">
<!--hidden-->
<input type="hidden" name="rowid" id="rowid" value="0">
<input type="hidden" name="mnu" value="<?php echo $menu?>">
<input type="hidden" id="sv" name="sv" />
<input type="hidden" name="cols" value="ttl,dscr,rpt,dtf,dtt,grp,lst,stts" />
<input type="hidden" name="tname" value="core_bgrpt" />
		
		  <div class="row">
			<div class="form-group col-md-6">
				<label>Title</label>
				<input type="text" id="ttl" name="ttl" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-6">
				<label>Desc</label>
				<textarea id="dscr" name="dscr" placeholder="..." class="form-control"></textarea>
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-6">
				<label>From</label>
				<input type="text" id="dtf" name="dtf" placeholder="..." class="form-control datepicker">
			</div>
			<div class="form-group col-md-6">
				<label>To</label>
				<input type="text" id="dtt" name="dtt" placeholder="..." class="form-control datepicker">
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-6">
				<label>Report</label>
				<select class="form-control " id="rpt" name="rpt">
					<option value=""></option>
					<?php echo options($o_lovrpt)?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Device/Group</label>
				<select class="form-control " id="grp" name="grp">
					<option value=""></option>
					<?php if($gx==''){?>
					<option value="all">All</option>
					<option value="list">List</option>
					<?php }?>
					<?php echo options($o_grp)?>
				</select>
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-md-6">
				<label>Status</label>
				<input type="text" readonly id="stts" name="stts" placeholder="[auto]" class="form-control">
				<select class="form-control hidden" id="sttsx" name="sttsx">
					<option value=""></option>
					<option value="new">new</option>
					<option value="cmd_g">generate command</option>
					<option value="img_g">generate image</option>
					<option value="done">done</option>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Hosts</label>
				<textarea id="lst" name="lst" placeholder="separated by [enter]" class="form-control"></textarea>
			</div>
		  </div>
		  
		</form>
	  </div>
	  <div class="modal-footer">
	    <button type="button" class="btn btn-danger" id="bdel"  onclick="confirmDelete();">Delete</button>
		<button type="button" id="bgen" class="btn btn-warning" onclick="generate();">Generate</button>
		<button type="button" id="bsave" class="btn btn-success" onclick="b4Save();">Save</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		
	  </div>
	</div>
  </div>
</div>


<?php 
include "inc.foot.php";
include "inc.js.php";

$tname="core_bgrpt";
$cols="ttl,dscr,rpt,dtf,dtt,grp,stts,job,rowid";
$csrc="ttl,dscr";

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
		order: [[7,'desc']],
		ajax: {
			type: 'POST',
			url: 'datatable<?php echo $ext?>',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.csrc= '<?php echo base64_encode($csrc); ?>',
				d.x= '<?php echo $menu?>';
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
        "ttl" : {
            required : true
        },
		"dscr" : {
			required : true
		},
		"dtf" : {
			required : true
		},
		"dtt" : {
			required : true
		},
		"rpt" : {
			required : true
		},
		"lst" : {
			required : function(){
				return ($("#grp").val()=="list");
			}
		},
		"grp" : {
			required : true
		}
    }});
	
	datepicker();
	//timepicker();
	//selectpicker(true);
});

function reloadtbl(){
	mytbl.ajax.reload();
}

function b4Save(){
	if($("#rowid").val()=="0") $("#stts").val("new");
	saveData();
}
function generate(){
	if($("#stts").val()=="new"||$("#stts").val()=="done"){
		$("#stts").val("generate");
		saveData();
	}else{
		alrt('Background process is running. Please do not edit.','warning','Attention');
	}
}

function openformcallback(q){
	$("#bdel").hide();
	$("#bgen").hide();
	$("#bsave").hide();
	if($("#rowid").val()=="0") {
		$("#bsave").show();
	}else{
		if($("#stts").val()=="new"){
			$("#bsave").show();
			$("#bgen").show();
		}
	}
}
</script>

  </body>
</html>