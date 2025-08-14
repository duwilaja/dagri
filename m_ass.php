<?php 
$restrict_lvl=array("0","1","2","11");

include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Asset";
$modal_title="Asset";
$card_title="Master $page_title";

$menu="mass";

$breadcrumb="Master/$page_title";

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
$rs=exec_qry($conn,"select brid,brname from ass_brand order by brname");
$o_brn=fetch_all($rs);
$rs=exec_qry($conn,"select catid,catname from ass_cat order by catname");
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
		
				<div class="card">
					<div class="card-header">
						<div class="card-title"><?php echo $card_title?></div>
						<div class="card-options ">
							<a href="#" onclick="$('#datas').val('');" data-toggle="modal" data-target="#modal_batch" title="Batch" class=""><i class="fe fe-upload"></i></a>
							<a href="#" onclick="openForm(0);togglehide(0);" data-toggle="modal" data-target="#myModal" title="Add" class=""><i class="fe fe-plus"></i></a>
							<a href="#" onclick="reloadtbl();" title="Refresh" class=""><i class="fe fe-refresh-cw"></i></a>
							<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="mytbl" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<!--th>Type</th-->
										<th>ID</th>
										<th>Name</th>
										<th>Brand</th>
										<th>Category</th>
										<th>Location</th>
										<th>Status</th>
										<th>Warranty Expired</th>
										<th>License Expired</th>
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
<input type="hidden" name="cols" value="assid,assname,assdesc,loc,brand,cat,warexp,gr,stts,sn,licexp" />
<input type="hidden" name="tname" value="ass_ets" />
		
		  <div class="row mb-3">
			<div class="form-group col-md-6">
				<label>ID</label>
				<input type="text" id="assid" name="assid" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-6">
				<label>Name</label>
				<input type="text" id="assname" name="assname" placeholder="..." class="form-control">
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-6">
				<label>S/N</label>
				<input type="text" id="sn" name="sn" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-6">
				<label>Desc</label>
				<textarea id="assdesc" name="assdesc" placeholder="..." class="form-control"></textarea>
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
				<label>Status</label>
				<select class="form-control " id="stts" name="stts">
					<option value="">-</option>
					<?php echo options($o_assstts)?>
				</select>
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-6">
				<label>Brand</label>
				<select class="form-control " id="brand" name="brand">
					<option value="">-</option>
					<?php echo options($o_brn)?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Category</label>
				<select class="form-control " id="cat" name="cat">
					<option value="">-</option>
					<?php echo options($o_cat)?>
				</select>
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-4">
				<label>Purchased</label>
				<div class="input-group">
					<input type="text" id="gr" name="gr" placeholder="" class="form-control datepicker">
					<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
				</div>
			</div>
			<div class="form-group col-md-4">
				<label>Warranty Expired</label>
				<div class="input-group">
					<input type="text" id="warexp" name="warexp" placeholder="" class="form-control datepicker">
					<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
				</div>
			</div>
			<div class="form-group col-md-4">
				<label>License Expired</label>
				<div class="input-group">
					<input type="text" id="licexp" name="licexp" placeholder="" class="form-control datepicker">
					<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
				</div>
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-6">
				<label>Image 1</label>
				<input type="file" id="imgx" name="imgx" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-6">
				<label>Image 2</label>
				<input type="file" id="imgy" name="imgy" placeholder="..." class="form-control">
			</div>
			<input type="hidden" id="img1" name="img1" value="" />
			<input type="hidden" id="img2" name="img2" value="" />
			
		  </div>
		</form>
	  </div>
	  <div class="modal-footer">
	    <button type="button" onclick="panci();" class="btn btn-warning hideme">History</button>
	    
		<button type="button" class="btn btn-danger" id="bdel"  onclick="confirmDelete();">Delete</button>
		<button type="button" class="btn btn-success" onclick="saveData();">Save</button>
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

$tname="ass_ets a left join ass_brand b on brid=brand left join ass_cat c on catid=cat left join core_location l on locid=loc";
$cols="assid,assname,brname,catname,name,stts,warexp,licexp,a.rowid";
$csrc="assname,name";

$where="1=1";
$loc=get("loc");
$stts=get("stt");
if($loc!=""){
	$where = "loc='$loc'";
}
if($mys_LOC!=''){ //session loc
	$where.= " AND loc in ('$mys_LOC')";
}
if($stts!=""){
	$where .= " AND stts='$stts'";
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
		ajax: {
			type: 'POST',
			url: 'datatable<?php echo $ext?>',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.csrc= '<?php echo base64_encode($csrc); ?>',
				d.where= '<?php echo base64_encode($where); ?>',
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
        "assid" : {
            required : true
        },
		"assname" : {
			required : true
		}
    }});
	
	datepicker(true);
	//timepicker();
	//selectpicker(true);
});

function reloadtbl(){
	mytbl.ajax.reload();
}

function openformcallback(q,json){
	togglehide($("#rowid").val());
}
function togglehide(id){
	if(id==0){
		$(".hideme").hide();
	}else{
		$(".hideme").show();
	}
}

function panci(){
	$.fancybox.open(
	  {
		src: "assvw"+ext+'?id='+$("#assid").val(),
		type: "iframe",
		preload: false,
//		width: 600,
//		height: 300,
	  },
	);
}
</script>

  </body>
</html>