<?php 
$restrict_lvl=array("0","1");

include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Location";
$modal_title="Location";
$card_title="Master $page_title";

$menu="location";

$breadcrumb="Setup/$page_title";

include "inc.db.php";
$conn=connect();
$rs=exec_qry($conn,"select iso,name from core_province order by name");
$o_prov=fetch_all($rs);
$rs=exec_qry($conn,"select rowid,name from core_location order by name");
$o_loc=fetch_all($rs);
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
		
				<div class="card mb-3">
					<div class="card-header">
						<div class="card-title"><?php echo $card_title?></div>
						<div class="card-options ">
							<a href="#" onclick="$('#datas').val('');" data-toggle="modal" data-target="#modal_batch" title="Batch" class=""><i class="fe fe-upload"></i></a>
							<a href="#" onclick="openForm(0);" data-toggle="modal" data-target="#myModal" title="Add" class=""><i class="fe fe-plus"></i></a>
							<a href="#" onclick="openBAI();" data-toggle="modal" data-target="#modal_ba" title="BAI" class=""><i class="fe fe-file"></i></a>
							<!--a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="mytbl" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Addr</th>
										<th>City</th>
										<th>Prov</th>
										<th>Internet B/W</th>
										<th>VPN B/W</th>
										<th>BAI</th>
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
<input type="hidden" name="cols" value="locid,name,addr,city,prov,postal,area,lat,lng,lnk,bw,hrminutediff" />
<input type="hidden" name="tname" value="core_location" />
		
		  <div class="row mb-3">
			<div class="form-group col-md-6">
				<label>ID</label>
				<input type="text" id="locid" name="locid" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-6">
				<label>Name</label>
				<input type="text" id="name" name="name" placeholder="..." class="form-control">
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-6">
				<label>Province</label>
				<input type="text" id="prov" name="prov" placeholder="..." class="form-control">
				<!--select class="form-control " id="prov" name="prov" onchange="getkabkot(this.value);">
					<option value="">-</option>
					<?php echo options($o_prov)?>
				</select-->
			</div>
			<div class="form-group col-md-6">
				<label>City</label>
				<input type="text" id="city" name="city" placeholder="..." class="form-control">
				<!--select class="form-control " id="city" name="city">
					<option value="">-</option>
				</select-->
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-9">
				<label>Address</label>
				<input type="text" id="addr" name="addr" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-3">
				<label>Postal Code</label>
				<input type="text" id="postal" name="postal" placeholder="..." class="form-control">
			</div>
		  </div>
		  <div class="form-group mb-3 hidden">
				<label>Area</label>
				<input type="text" id="area" name="area" placeholder="..." class="form-control">
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-5">
				<label>Latitude</label>
				<input type="text" id="lat" name="lat" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-5 mb-3">
				<label>Longitude</label>
				<input type="text" id="lng" name="lng" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-2 mb-3">
				<label>&nbsp;</label><br />
				<button type="button" onclick="mappicker('#lat','#lng');" class="btn btn-info"><i class="fa fa-map-pin"></i></button>
			</div>
		  </div>
		  <div class="row mb-3">
			<div class="form-group col-md-4">
				<label>VPN B/W</label>
				<input type="text" id="lnk" name="lnk" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-4">
				<label>Internet B/W</label>
				<input type="text" id="bw" name="bw" placeholder="..." class="form-control">
			</div>
			<div class="form-group col-md-4">
				<label>TimeDiff(minutes)</label>
				<input type="text" id="hrminutediff" name="hrminutediff" placeholder="..." class="form-control">
			</div>
		  </div>
		  
		</form>
	  </div>
	  <div class="modal-footer">
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
					<input type="hidden" name="tname" value="core_location" />
					
						<!--div class="card-body"-->
							<div class="form-group">
								<label class=""><b>Data :</b><br /> - Copy paste from spreadsheet<br /> - 1st row always header field<br /> -  need sample? click <a target="_blank" style="text-decoration:underline;" href="sample_location.xlsx">here</a></label>
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

<!-- Modal Batch -->
<div class="modal fade modal_form" id="modal_ba" tabindex="-3" role="dialog" aria-labelledby="formModalLabelBa" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formModalLabelBa">Upload BAI</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="myfz">
				<!--input type="hidden" name="rowid" id="rowid" value="0"-->
				<input type="hidden" name="mnu" value="<?php echo $menu?>_ba">
				<input type="hidden" id="svz" name="sv" value="UPD" />
				<input type="hidden" name="cols" value="" />
				<input type="hidden" name="tname" value="core_location" />
				<div class="row mb-3">
					<div class="form-group col-md-12">
						<label>Location</label>
						<!--input type="text" id="locid" name="locid" placeholder="..." class="form-control"-->
						<select class="form-control select2" id="rowidz" name="rowid">
						<option value="">-- Please Select --</option>
						<?php echo options($o_loc)?>
						</select>
					</div>
				</div>
				<div class="row mb-3">
					<div class="form-group col-md-12">
						<label>BAI File</label>
						<input type="file" id="bai" name="bai" placeholder="..." class="form-control">
					</div>
				</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="saveData('#myfz');">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Batch -->
<?php 
include "inc.foot.php";
include "inc.js.php";

$tname="core_location";
$cols="locid,name,addr,city,prov,bw,lnk,bai,rowid";
$csrc="name,addr,city,prov";

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
        "locid" : {
            required : true
        },
		"name" : {
			required : true
		}
    }});
	
	//datepicker();
	//timepicker();
	//selectpicker(true);
	$(".select2").select2();
});

function reloadtbl(){
	mytbl.ajax.reload();
}

function openBAI(){
	$('#bai').val('');
	$("#rowidz").select2('destroy');
	$('#rowidz').val('');
	$("#rowidz").select2();
	$('#modal_ba').modal('show');
}

function mappicker(lat,lng){
	window.open("map"+ext+"?lat="+$(lat).val()+"&lng="+$(lng).val(),"MapWindow","width=830,height=500,location=no").focus();
}

function getkabkot(prov,dv=''){
	getCombo("dataget"+ext,'kabkot',prov,"#city",dv);
}

function openformcallback(q,json=''){
	var dv='';
	var prov=$("#prov").val();
	if(json!=''){
		dv=json['msgs'][0]['city'];
	}
	getkabkot(prov,dv);
}
</script>

  </body>
</html>