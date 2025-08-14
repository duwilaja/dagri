<?php 
$restrict_lvl=array("0","1","2","11");

include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Assets Summary";
$modal_title="";
$card_title="Assets Report";

$menu="-";

$breadcrumb="Reports/$page_title";

include "inc.head.php";
include "inc.menutop.php";

include "inc.db.php";
$conn=connect();

$wherloc=$mys_LOC==''?'':"where locid in ('$mys_LOC')";
$rs=exec_qry($conn,"select locid,name from core_location $wherloc order by name");
$o_loc=fetch_all($rs);

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
			<!--div class="row">
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>BRAND</b></div>
					<select class="form-select">
						<option selected>ALL BRAND</option>
						<option value="1">INRICO</option>
						<option value="2">MOTOROLA</option>
						<option value="3">TD TECH</option>
						<option value="4">MILLTRAC</option>
						<option value="5">BELFONE</option>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>STATUS</b></div>
					<select class="form-select">
						<option selected>All STATUS</option>
						<option value="1">ACTIVE</option>
						<option value="2">ACTIVE STANDBY</option>
						<option value="3">STANDBY</option>
					</select>
				</div>
				<div class="col-xl-2">
					<div class="small text-white text-opacity-50 mb-2"><b>EXPIRED</b></div>
					<select class="form-select">
						<option selected>YEAR</option>
						<option value="1">2024</option>
						<option value="2">2023</option>
						<option value="3">2022</option>
						<option value="4">2021</option>
					</select>
				</div>
				
			</div>

			<br><br-->
			<div class="row row-sm">
				
				<div class="col-lg-12 col-xl-12">
					<div class="row pb-4">
						<div class="col-xl-6">
							<div class="small text-opacity-50 mb-2 text-whitex"><b>LOCATION</b></div>
							<select class="form-control select2" id="loc">
								<option value="">All Location</option>
								<?php echo options($o_loc)?>
							</select>
						</div>
						
						<div class="col-xl-2 pt-3">
							<button type="button" class="btn btn-primary my-2 btn-icon-text" onclick="getsum()">Filter</button>
						</div>
					</div>
					<!-- Row -->
					<div class="row isin">
						
					</div>
					<div class="row hidden">
						<div class="col-xl-3 col-md-4 col-sm-6">
							<div class="card custom-card border p-0 shadow-none">
								<div class="d-flex align-items-center px-4 pt-2">&nbsp;
									<div class="float-end ms-auto hidden">
										<a href="#" class="option-dots" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
										<div class="dropdown-menu dropdown-menu-start">
											<a class="dropdown-item" href="#"><i class="fe fe-edit me-2"></i> Edit</a>
											<a class="dropdown-item" href="#"><i class="fe fe-share me-2"></i> Share</a>
											<a class="dropdown-item" href="#"><i class="fe fe-download me-2"></i> Download</a>
											<a class="dropdown-item" href="#"><i class="fe fe-trash me-2"></i> Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body pt-0 text-center">
									<a href="file-manager-list.html" class="open-file">
										<div class="file-manger-icon">
											<img src="img/cat/router-core.png" alt="img" class="br-7">
										</div><br>
										<h6 class="mb-1 font-weight-semibold mt-0">Router Core</h6>
										<span class="text-muted">1.000 Unit</span>
									</a>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-4 col-sm-6">
							<div class="card custom-card border p-0 shadow-none">
								<div class="d-flex align-items-center px-4 pt-2">&nbsp;
									<div class="float-end ms-auto hidden">
										<a href="#" class="option-dots" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
										<div class="dropdown-menu dropdown-menu-start">
											<a class="dropdown-item" href="#"><i class="fe fe-edit me-2"></i> Edit</a>
											<a class="dropdown-item" href="#"><i class="fe fe-share me-2"></i> Share</a>
											<a class="dropdown-item" href="#"><i class="fe fe-download me-2"></i> Download</a>
											<a class="dropdown-item" href="#"><i class="fe fe-trash me-2"></i> Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body pt-0 text-center">
									<a href="#" class="open-file">
									<div class="file-manger-icon">
										<img src="img/cat/router-gateway.png" alt="img" class="br-7">
									</div><br>
									<h6 class="mb-1 font-weight-semibold mt-0">Router Gateway</h6>
									<span class="text-muted">1.000 Unit</span>
								</a>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-4 col-sm-6">
							<div class="card custom-card border p-0 shadow-none">
								<div class="d-flex align-items-center px-4 pt-2">&nbsp;
									<div class="float-end ms-auto hidden">
										<a href="#" class="option-dots" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
										<div class="dropdown-menu dropdown-menu-start">
											<a class="dropdown-item" href="#"><i class="fe fe-edit me-2"></i> Edit</a>
											<a class="dropdown-item" href="#"><i class="fe fe-share me-2"></i> Share</a>
											<a class="dropdown-item" href="#"><i class="fe fe-download me-2"></i> Download</a>
											<a class="dropdown-item" href="#"><i class="fe fe-trash me-2"></i> Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body pt-0 text-center">
									<a href="#" class="open-file">
									<div class="file-manger-icon">
										<img src="img/cat/switch-access-2.png" alt="img" class="rounded-10">
									</div><br>
									<h6 class="mb-1 font-weight-semibold mt-1">Switch Access</h6>
									<span class="text-muted">1.000 Unit</span></a>
								</div>
							</div>
							</div>
						<div class="col-xl-3 col-md-4 col-sm-6">
							<div class="card custom-card border p-0 shadow-none">
								<div class="d-flex align-items-center px-4 pt-2">&nbsp;
									<div class="float-end ms-auto hidden">
										<a href="#" class="option-dots" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
										<div class="dropdown-menu dropdown-menu-start">
											<a class="dropdown-item" href="#"><i class="fe fe-edit me-2"></i> Edit</a>
											<a class="dropdown-item" href="#"><i class="fe fe-share me-2"></i> Share</a>
											<a class="dropdown-item" href="#"><i class="fe fe-download me-2"></i> Download</a>
											<a class="dropdown-item" href="#"><i class="fe fe-trash me-2"></i> Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body pt-0 text-center">
									<a href="file-manager-list.html" class="open-file">
									<div class="file-manger-icon">
										<img src="img/cat/switch-distribution.png" alt="img" class="br-7">
									</div><br>
									<h6 class="mb-1 font-weight-semibold mt-0">Switch Distribution</h6>
									<span class="text-muted">1.000 Unit</span></a>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-4 col-sm-6">
							<div class="card custom-card border p-0 shadow-none">
								<div class="d-flex align-items-center px-4 pt-2">&nbsp;
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="example-checkbox2" value="option2">
										<span class="custom-control-label"></span>
									</label>
									<div class="float-end ms-auto hidden">
										<a href="#" class="option-dots" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
										<div class="dropdown-menu dropdown-menu-start">
											<a class="dropdown-item" href="#"><i class="fe fe-edit me-2"></i> Edit</a>
											<a class="dropdown-item" href="#"><i class="fe fe-share me-2"></i> Share</a>
											<a class="dropdown-item" href="#"><i class="fe fe-download me-2"></i> Download</a>
											<a class="dropdown-item" href="#"><i class="fe fe-trash me-2"></i> Delete</a>
										</div>
									</div>
								</div>
								<div class="card-body pt-0 text-center">
									<a href="file-manager-list.html" class="open-file">
									<div class="file-manger-icon">
										<img src="img/cat/access-point.png" alt="img" class="br-7">
									</div><br>
									<h6 class="mb-1 font-weight-semibold mt-0">Access Point</h6>
									<span class="text-muted Access-Point utxt">0 Unit</span></a>
								</div>
							</div>
						</div>
					</div>
					<!-- End Row -->
				</div>
			</div>

	
	</div>
</div><!-- end app-content-->

<?php 
include "inc.foot.php";
include "inc.js.php";


$tname="ass_ets";
$cols="assid,assname,assdesc,loc,sn,brand,cat,gr,warexp,stts";
$csrc="";
$grpby="";
$where="1=1"; $clso="";
if($mys_LOC!=''){ //session loc
	$where.= " AND loc in ('$mys_LOC')";
}
?>

<script>

$(document).ready(function(){
	page_ready();
	$(".select2").select2();
	getsum();
});

function getsum(lnk='dataget',q='asssum'){
	var id=$("#loc").val();
	$.ajax({
		type: 'POST',
		url: lnk+ext,
		data: {q:q,id:id},
		success: function(data){
			var json = JSON.parse(data);
			if(json['code']=='200'){
				var html='';
				for(var i=0;i<json['msgs'].length;i++){
					var d=json['msgs'][i];
					var img=d['cat'].trim().replace(" ","-").toLowerCase();
					html += ''+
						'<div class="col-xl-3 col-md-4 col-sm-6">'+
						'	<div class="card custom-card border p-0 shadow-none">'+
						'		<div class="d-flex align-items-center px-4 pt-2">&nbsp;'+
						'		</div>'+
						'		<div class="card-body pt-0 text-center">'+
						'				<div class="file-manger-icon">'+
						'					<img src="img/cat/'+img+'.png" alt="image '+img+'.png not found" class="br-7">'+
						'				</div><br>'+
						'				<h6 class="mb-1 font-weight-semibold mt-0">'+d['cat']+'</h6>'+
						'				<span class="text-muted">'+d['tot']+' Unit</span>'+
						'		</div>'+
						'	</div>'+
						'</div>';
				}
				log(html);
				$(".isin").html(html);
			}else{
				log(json['msgs']);
			}
		},
		error: function(xhr){
			log('Please check your connection'+xhr);
		}
	});
}
</script>

  </body>
</html>