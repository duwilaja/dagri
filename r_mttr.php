<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="MTTR";
$modal_title="";
$card_title="Tickets Report";

$menu="-";

$breadcrumb="Reports/$page_title";

include "inc.head.php";
include "inc.menutop.php";

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

$where="1=1"; $clso="";
if($mys_LOC!=''){ //session loc
	$where.= " AND loc in ('$mys_LOC')";
}

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
			<div class="col-xl-2 hidden">
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
		<br /><br />
		
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
										<th>Ticket#</th>
										<th>Date/Time</th>
										<th>Subject</th>
										<th>Detail</th>
										<th>Category</th>
										<th>Service</th>
										<th>Location</th>
										<th>Created</th>
										<th>CreateBy</th>
										<th>Closed</th>
										<th>Closeby</th>
										<th>New</th>
										<th>Progress</th>
										<th>Solved</th>
										<th>Pending</th>
										<th>Total</th>
										<th>MTTR</th>
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


$tname="tick_ets t left join core_location  l on locid=loc left join core_user u1 on creby=u1.uid left join core_user u2 on clsby=u2.uid";
$cols="ticketno,dtm,h,d,cat,svc,l.name,created,u1.uname,closed,u2.uname,
MY_SECTOTIME(snew),MY_SECTOTIME(sprogress),MY_SECTOTIME(ssolved),MY_SECTOTIME(spending),MY_SECTOTIME(TIMESTAMPDIFF(SECOND, created, closed)),
MY_SECTOTIME(snew+sprogress+ssolved),t.rowid";
$csrc="ticketno,h,d";
$grpby="";

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
		order: [[0,"desc"]],
		ajax: {
			type: 'POST',
			url: 'datatable<?php echo $ext?>',
			data: function (d) {
				d.cols= '<?php echo base64_encode($cols); ?>',
				d.tname= '<?php echo base64_encode($tname); ?>',
				d.csrc= '<?php echo base64_encode($csrc); ?>',
				//d.grpby= '<?php echo base64_encode($grpby); ?>',
				d.where= '<?php echo base64_encode($where); ?>',
				d.filtereq= 'cat,svc,loc',
				d.loc= $("#floc").val(),
				d.cat= $("#fcat").val(),
				d.grp= $("#fgrp").val(),
				d.svc= $("#fsvc").val(),
				d.stts= $("#fstts").val(),
				d.fdtmf= $("#df").val(),
				d.fdtmt= $("#dt").val(),
				d.x= '<?php echo $menu?>';
			}
		},
		initComplete: function(){
			dttbl_buttons(); //for ajax call
		}
	});
	//dttbl_buttons(); //remark this if ajax dttbl call
	datepicker(true);
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

</script>

  </body>
</html>