<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-home";
$page_title="Asset";
$modal_title="Title of Modal";
$menu="ass";

$breadcrumb="Overview/$page_title";

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
			
			<!-- Row -->
			<div class="row row-sm">
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
					<div class="card custom-card">
						<div class="card-body"><a href="m_ass<?php echo $ext?>">
							<div class="card-order ">
								<label class="main-content-label mb-3 pt-1">Total Asset</label>
								<h2 class="text-end card-item-icon card-icon">
								<i class="fa fa-cubes icon-size float-start text-primary"></i><span class="font-weight-bold xtot">0</span></h2>
								<!--p class="mb-0 mt-4 text-muted">Monthly users<span class="float-end">50%</span></p-->
							</div>
						</a></div>
					</div>
				</div>
				<!-- COL END -->
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
					<div class="card custom-card">
						<div class="card-body"><a href="m_ass<?php echo $ext?>?stt=active">
							<div class="card-order">
								<label class="main-content-label mb-3 pt-1">Active</label>
								<h2 class="text-end"><i class="fa fa-hdd icon-size float-start text-success"></i><span class="font-weight-bold xactive">0</span></h2>
								<!--p class="mb-0 mt-4 text-muted">Monthly Income<span class="float-end">$7,893</span></p-->
							</div>
						</a></div>
					</div>
				</div>
				<!-- COL END -->
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
					<div class="card custom-card">
						<div class="card-body"><a href="m_ass<?php echo $ext?>?stt=standby">
							<div class="card-order">
								<label class="main-content-label mb-3 pt-1">Standby</label>
								<h2 class="text-end"><i class="icon-size fa fa-hdd float-start text-warning"></i><span class="font-weight-bold xstandby">0</span></h2>
								<!--p class="mb-0 mt-4 text-muted">Monthly Profit<span class="float-end">$4,678</span></p-->
							</div>
						</a></div>
					</div>
				</div>
				<!-- COL END -->
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
					<div class="card custom-card">
						<div class="card-body"><a href="m_ass<?php echo $ext?>?stt=inactive">
							<div class="card-order">
								<label class="main-content-label mb-3 pt-1">Inactive</label>
								<h2 class="text-end"><i class="fa fa-hdd icon-size float-start text-danger"></i><span class="font-weight-bold xinactive">0</span></h2>
								<!--p class="mb-0 mt-4 text-muted">Monthly Sales<span class="float-end">3,756</span></p-->
							</div>
						</a></div>
					</div>
				</div>
				<!-- COL END -->
			</div>
			<!-- End Row -->
		
			<div class="row">
				<!-- BEGIN col-4 -->
				<div class="col-xl-6">
					<!-- BEGIN card -->
					<div class="card mb-3">
						<div class="card-header border-bottom-0">
							<label class="main-content-label my-auto pt-2 mb-1">ASSET CLASSIFICATION</label>
							<span class="d-block tx-12 mb-0 mt-1 text-muted"></span>
						</div>
						<!-- BEGIN card-body -->
						<div class="card-body">
							<!-- BEGIN table -->
							<div class="overflow-hidden">
								<canvas id="ass-class"></canvas>
							</div>
							<!-- END table -->
						</div>
						<!-- END card-body -->
						
					</div>
					<!-- END card -->
				</div>
				<!-- END col-4 -->
				<!-- BEGIN col-4 -->
				<div class="col-xl-6">
					<!-- BEGIN card -->
					<div class="card mb-3">
						
						<div class="card-header border-bottom-0">
							<label class="main-content-label my-auto pt-2 mb-1">BROKEN ASSET CLASSIFICATION</label>
							<span class="d-block tx-12 mb-0 mt-1 text-muted"></span>
						</div>

						<!-- BEGIN card-body -->
						<div class="card-body">
							<!-- BEGIN table -->
							<div class="overflow-hidden">
								<canvas id="break-ass-class" style="max-height:230px;"></canvas>
							</div>
							<!-- END table -->
						</div>
						<!-- END card-body -->
						
					</div>
					<!-- END card -->
				</div>
				<!-- END col-4 -->
			</div>
			<div class="row hidden">
				<!-- BEGIN col-4 -->
				<div class="col-xl-4">
					<!-- BEGIN card -->
					<div class="card mb-3">
						<!-- BEGIN card-body -->
						<div class="card-body">
							<!-- BEGIN title -->
							<div class="d-flex fw-bold small mb-3">
								<span class="flex-grow-1">Oldest Assets</span>
								<a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
							</div>
							<!-- END title -->
							<!-- BEGIN table -->
							<div class="table-responsive">
								<table id="topold" class="table table-striped table-borderless mb-2px small text-nowrap">
									<thead>
										<tr>
											<th>Name</th>
											<th>Location</th>
											<th>Purchased</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<!-- END table -->
						</div>
						<!-- END card-body -->
						
					</div>
					<!-- END card -->
				</div>
				<!-- END col-4 -->
				<!-- BEGIN col-4 -->
				<div class="col-xl-4">
					<!-- BEGIN card -->
					<div class="card mb-3">
						<!-- BEGIN card-body -->
						<div class="card-body">
							<!-- BEGIN title -->
							<div class="d-flex fw-bold small mb-3">
								<span class="flex-grow-1">Brand Problem</span>
								<a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
							</div>
							<!-- END title -->
							<!-- BEGIN table -->
							<div class="table-responsive">
								<table id="toppro" class="table table-striped table-borderless mb-2px small text-nowrap">
									<thead>
										<tr>
											<th>Brand</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<!-- END table -->
						</div>
						<!-- END card-body -->
						
					</div>
					<!-- END card -->
				</div>
				<!-- END col-4 -->
				<!-- BEGIN col-4 -->
				<div class="col-xl-4">
					<!-- BEGIN card -->
					<div class="card mb-3">
						<!-- BEGIN card-body -->
						<div class="card-body">
							<!-- BEGIN title -->
							<div class="d-flex fw-bold small mb-3">
								<span class="flex-grow-1">Warranty Warning</span>
								<a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
							</div>
							<!-- END title -->
							<!-- BEGIN table -->
							<div class="table-responsive">
								<table id="topwar" class="table table-striped table-borderless mb-2px small text-nowrap">
									<thead>
										<tr>
											<th>Name</th>
											<th>Location</th>
											<th>Expired</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<!-- END table -->
						</div>
						<!-- END card-body -->
						
					</div>
					<!-- END card -->
				</div>
				<!-- END col-4 -->
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header border-bottom-0">
							<label class="main-content-label my-auto pt-2 mb-1">ASSET LOCATION</label>
							<span class="d-block tx-12 mb-0 mt-1 text-muted"></span>
						</div>
						<div class="card-body">
							<div id="map" style="height:450px; z-index: 1;"></div>
						</div>
					</div>
				</div>
			</div>
			<br /><br />
			
			
		</div>
	</div><!-- end app-content-->
				
<?php 
include "inc.foot.php";
include "inc.js.php";
?>
<script>
var mytbl1, mytbl2, mytbl3, mytbl4, mytbl5, mytbl6, mytbl7, mytbl8, mytbl9, barChart, pieChart;

$(document).ready(function(){
	page_ready();
	//displayClock();
	gettot();
	
	//mytbl1 = loadTable('#topold','<?php echo base64_encode("assname,loc,gr"); ?>','<?php echo base64_encode("ass_ets"); ?>','<?php echo base64_encode("");?>','<?php echo base64_encode("");?>',[[ 2, "asc" ]],'-');
	//mytbl2 = loadTable('#toppro','<?php echo base64_encode("brand,count(brand) as cnt"); ?>','<?php echo base64_encode("ass_ets"); ?>','<?php echo base64_encode("stts='inactive'");?>','<?php echo base64_encode("brand");?>',[[ 1, "desc" ]],'-');
	//mytbl3 = loadTable('#topwar','<?php echo base64_encode("assname,loc,warexp"); ?>','<?php echo base64_encode("ass_ets"); ?>','<?php echo base64_encode("");?>','<?php echo base64_encode("");?>',[[ 2, "asc" ]],'-');
	
	//markers=null;
	//getData('onoff','maps-onoff');
	widget_map();
	getDataChart('asscat');
	getDataChart('brasscat');
	
});
function randomColor(){
	return "#"+(Math.random().toString(16)+"000000").slice(2, 8).toUpperCase();
}
// to check the value is hexa or not
const isValidHex = (hexValue) => /^#([A-Fa-f0-9]{3,4}){1,2}$/.test(hexValue)

const getChunksFromString = (st, chunkSize) => st.match(new RegExp(`.{${chunkSize}}`, "g"))
// convert hex value to 256
const convertHexUnitTo256 = (hexStr) => parseInt(hexStr.repeat(2 / hexStr.length), 16)
// get alpha value is equla to 1 if there was no value is asigned to alpha in function
const getAlphafloat = (a, alpha) => {
	if (typeof a !== "undefined") { return a / 255 }
	if ((typeof alpha != "number") || alpha < 0 || alpha > 1) {
		return 1
	}
	return alpha
}
// convertion of hex code to rgba code
function hexToRgba(hexValue, alpha) {
	if (!isValidHex(hexValue)) { return null }
	const chunkSize = Math.floor((hexValue.length - 1) / 3)
	const hexArr = getChunksFromString(hexValue.slice(1), chunkSize)
	const [r, g, b, a] = hexArr.map(convertHexUnitTo256)
	return `rgba(${r}, ${g}, ${b}, ${getAlphafloat(a, alpha)})`
}
function pieChart(databar){
	var label=[], datas=[], colors=[];
	var myVarVal="#6259ca";
	//log(databar);
	for(var i=0;i<databar.length;i++){
		label.push(databar[i]['cat']);
		datas.push(parseInt(databar[i]['tot']));
		//colors.push(randomColor());
		colors.push(hexToRgba(myVarVal,(1-(i*0.1))));
	}
	
	var ctx5 = document.getElementById('break-ass-class');
	pieChart = new Chart(ctx5, {
		type: 'doughnut',
		data: {
			labels: label,//['Total Visitor', 'New Visitor', 'Returning Visitor'],
			datasets: [{
				data: datas,//[300, 50, 100],
				backgroundColor: colors,
				//backgroundColor: ['rgba('+ app.color.greenRgb +', .5)', 'rgba('+ app.color.whiteRgb +', .5)', 'rgba('+ app.color.gray500Rgb +', .5)'],
				//hoverBackgroundColor: ['rgba('+ app.color.greenRgb +', 1)', 'rgba('+ app.color.whiteRgb +', 1)', 'rgba('+ app.color.gray500Rgb +', 1)'],
				borderWidth: 0
			}]
		}
	});
}

function getDataChart(q=''){
	var datachart=null;
	$.ajax({
		type: 'POST',
		url: 'dataget'+ext,
		data: {q:q},
		success: function(data){
			var json = JSON.parse(data);
			if(json['code']=='200'){
				datachart=json['msgs'];
				if(q=='asscat'){
					barChart(datachart);
				}
				if(q=='brasscat'){
					pieChart(datachart);
				}
			}else{
				log(json['msgs']);
			}
		},
		error: function(xhr){
			log('Please check your connection'+xhr);
		}
	});
}
function barChart(databar){
	var myVarVal="#6259ca";
	if(databar!=null){
		var label=[], datas=[];
		//log(databar);
		for(var i=0;i<databar.length;i++){
			label.push(databar[i]['cat']);
			datas.push(parseInt(databar[i]['tot']));
		}
		//log(label);
		//log(datas);
		var ctx2 = document.getElementById('ass-class');
		barChart = new Chart(ctx2, {
			type: 'bar',
			data: {
				labels: label,//['Jan','Feb','Mar','Apr','May','Jun'],
				datasets: [{
					label: 'Total',
					data: datas,//[37,31,36,34,43,31],
					backgroundColor: hexToRgba(myVarVal,0.5),
					//borderColor: randomColor(),
					borderWidth: 1.5
				}]
			}
		});
	}
}

function gettot(){
	$.ajax({
		type: 'POST',
		url: 'dataget'+ext,
		data: {q:'asshom'},
		success: function(data){
			var json = JSON.parse(data);
			if(json['code']=='200'){
				var tot=0;
				for(var i=0;i<json['msgs'].length;i++){
					var d=json['msgs'][i];
					$(".x"+d['stts']).html(d['tot']);
					tot+=parseInt(d['tot']);
				}
				$(".xtot").html(tot);
			}else{
				log(json['msgs']);
			}
		},
		error: function(xhr){
			log('Please check your connection'+xhr);
		}
	});
	//setTimeout(gettot,1000*300);
}

function loadTable(divid,cols,tname,where,grpby,ord,x){
var mytbl=$(divid).DataTable({
	buttons: [
            'copy', 'csv'
        ],
	searching: false,
	serverSide: true,
	processing: true,
	ordering: true,
	paging: true,
	lengthChange: false,
	info: false,
	order: ord,
		ajax: {
			type: 'POST',
			url: 'datatable'+ext,
			data: function (d) {
				d.cols= cols,
				d.tname= tname,
				d.csrc= '',
				d.where= where,
				d.grpby= grpby,
				d.df= $("#df").val(),
				d.dt= $("#dt").val(),
				d.x= x;
			}
		},
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});
	
	return mytbl;
}


var map, markers;
var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var err='';

function displayClock(){
	var d=new Date();
	var zone=d.toString().match(/([\+-][0-9]+)\s/)[1];
	$("#zone").text('('+zone+')');
	var tgl=months[d.getMonth()]+" "+d.getDate()+", "+d.getFullYear();
	$("#tgl").text(tgl);
	var jam=d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
	$("#jam").text(jam);
		
	setTimeout(displayClock,1000);
}

function widget_map(){
	map = L.map('map').setView([-2, 118], 5);

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);
	
	//L.geoJSON(indonesia).addTo(map);
	get_loc();
}

function get_loc(){
	$.ajax({
		type: 'POST',
		url: 'dataget'+ext,
		data: {q:'asetloc',id:''},
		success: function(data){
			var json = JSON.parse(data);
			if(json['code']=='200'){
				draw_map(json['msgs']);
			}else{
				log(json['msgs']);
			}
		},
		error: function(xhr){
			log('Please check your connection'+xhr);
		}
	});
}

function draw_map(data){
	if(markers!=null)  {
		map.removeLayer(markers);
		markers.clearLayers();
	}
	markers = L.markerClusterGroup();
		
		for (var i = 0; i < data.length; i++) {
			var a = data[i];
			var title = a['name']+'\nTotal: '+a['cnt'];
			var color = a['cnt']>0?"green":"green";
			var icon = L.AwesomeMarkers.icon({icon: 'server', prefix: 'fa', markerColor: color});
			
			if(isNaN(data[i]['lat'])||isNaN(data[i]['lng'])){
				err+=data[i]['name']+'/';
			}else{
				var marker = L.marker(new L.LatLng(a['lat'], a['lng']), { title: title, icon: icon });
				
				var fn=markerClickFunction(a['locid']);
				marker.on('click', fn);
				
				markers.addLayer(marker);
			}
		}

		map.addLayer(markers);
		
		if(err!='') {
			alert('Error: '+err);
		}
}

markerClickFunction = function(id,s) {
		return function(e) {
			e.cancelBubble = true;
		e.returnValue = false;
		if (e.stopPropagation) {
		  e.stopPropagation();
		  e.preventDefault();
		}
		//if(id=="0"){
			location.href="m_ass"+ext+"?loc="+id;
		//}else{
		//	location.href="device.php?id="+id;
		//	}
	}}

</script>

  </body>
</html>