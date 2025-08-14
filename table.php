<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-table";
$page_title="Title of Page";
$modal_title="Title of Modal";
$menu="devices";

$breadcrumb="Parent/$page_title";

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
			<div class="page-rightheader">
				<a href="#" class="btn btn-primary" onclick="" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Create</a>
			</div>
		</div>
		<!--End Page header-->
		
				<div class="card">
					<div class="card-header">
						<div class="card-title">Data Tables</div>
						<div class="card-options ">
							<a href="#" title="Batch" class=""><i class="fe fe-upload"></i></a>
							<a href="#" onclick="openForm(0);" data-toggle="modal" data-target="#myModal" title="Add" class=""><i class="fe fe-plus"></i></a>
							<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="mytbl" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th class="wd-15p">First name</th>
										<th class="wd-15p">Last name</th>
										<th class="wd-20p">Position</th>
										<th class="wd-15p">Start date</th>
										<th class="wd-10p">Salary</th>
										<th class="wd-25p">E-mail</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Bella</td>
										<td>Chloe</td>
										<td>System Developer</td>
										<td>2018/03/12</td>
										<td>$654,765</td>
										<td>b.Chloe@datatables.net</td>
									</tr>
									<tr>
										<td>Donna</td>
										<td>Bond</td>
										<td>Account Manager</td>
										<td>2012/02/21</td>
										<td>$543,654</td>
										<td>d.bond@datatables.net</td>
									</tr>
									<tr>
										<td>Harry</td>
										<td>Carr</td>
										<td>Technical Manager</td>
										<td>20011/02/87</td>
										<td>$86,000</td>
										<td>h.carr@datatables.net</td>
									</tr>
									<tr>
										<td>Lucas</td>
										<td>Dyer</td>
										<td>Javascript Developer</td>
										<td>2014/08/23</td>
										<td>$456,123</td>
										<td>l.dyer@datatables.net</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
						<!-- BEGIN card-arrow -->
						<div class="card-arrow">
							<div class="card-arrow-top-left"></div>
							<div class="card-arrow-top-right"></div>
							<div class="card-arrow-bottom-left"></div>
							<div class="card-arrow-bottom-right"></div>
						</div>
						<!-- END card-arrow -->
				</div>
					<!-- BEGIN card -->
					<div class="card mb-3">
						<!-- BEGIN card-body -->
						<div class="card-body">
							<!-- BEGIN title -->
							<div class="d-flex fw-bold small mb-3">
								<span class="flex-grow-1">TOTAL DEVICE</span>
								<a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none" data-bs-original-title="" title=""><i class="bi bi-fullscreen"></i></a>
							</div>
							<!-- END title -->
							<!-- BEGIN stat-lg -->
							<div class="row align-items-center mb-2">
								<div class="col-7">
									<h3 class="mb-0">27</h3>
								</div>
								<div class="col-5">
									<div class="mt-n2" data-render="apexchart" data-type="bar" data-title="Visitors" data-height="30" style="min-height: 30px;"><div id="apexcharts5o5lirez" class="apexcharts-canvas apexcharts5o5lirez apexcharts-theme-light" style="width: 78px; height: 30px;"><svg id="SvgjsSvg4337" width="78" height="30" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent none repeat scroll 0% 0%;"><g id="SvgjsG4339" class="apexcharts-inner apexcharts-graphical" transform="translate(11.816666666666666, 0)"><defs id="SvgjsDefs4338"><linearGradient id="SvgjsLinearGradient4343" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop4344" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop4345" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop4346" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMask5o5lirez"><rect id="SvgjsRect4348" width="82" height="30" x="-9.816666666666666" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask5o5lirez"></clipPath><clipPath id="nonForecastMask5o5lirez"></clipPath><clipPath id="gridRectMarkerMask5o5lirez"><rect id="SvgjsRect4349" width="66.36666666666667" height="34" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><rect id="SvgjsRect4347" width="3.378194444444444" height="30" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient4343)" class="apexcharts-xcrosshairs" y2="30" filter="none" fill-opacity="0.9"></rect><g id="SvgjsG4380" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG4381" class="apexcharts-xaxis-texts-g" transform="translate(0, 4)"></g><line id="SvgjsLine4388" x1="-7.816666666666666" y1="30" x2="70.18333333333334" y2="30" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><g id="SvgjsG4390" class="apexcharts-grid"><g id="SvgjsG4391" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine4399" x1="-7.816666666666666" y1="0" x2="70.18333333333334" y2="0" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine4400" x1="-7.816666666666666" y1="6" x2="70.18333333333334" y2="6" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine4401" x1="-7.816666666666666" y1="12" x2="70.18333333333334" y2="12" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine4402" x1="-7.816666666666666" y1="18" x2="70.18333333333334" y2="18" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine4403" x1="-7.816666666666666" y1="24" x2="70.18333333333334" y2="24" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine4404" x1="-7.816666666666666" y1="30" x2="70.18333333333334" y2="30" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG4392" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine4393" x1="0" y1="30" x2="0" y2="36" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine4394" x1="12.473333333333333" y1="30" x2="12.473333333333333" y2="36" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine4395" x1="24.946666666666665" y1="30" x2="24.946666666666665" y2="36" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine4396" x1="37.42" y1="30" x2="37.42" y2="36" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine4397" x1="49.89333333333333" y1="30" x2="49.89333333333333" y2="36" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine4398" x1="62.36666666666666" y1="30" x2="62.36666666666666" y2="36" stroke="rgba(255,255,255, .25)" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine4406" x1="0" y1="30" x2="62.36666666666667" y2="30" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine4405" x1="0" y1="1" x2="0" y2="30" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG4350" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG4351" class="apexcharts-series" rel="1" seriesName="Visitors" data:realIndex="0"><path id="SvgjsPath4355" d="M -1.689097222222222 30L -1.689097222222222 6.300000000000001Q -1.689097222222222 6.300000000000001 -1.689097222222222 6.300000000000001L 1.689097222222222 6.300000000000001Q 1.689097222222222 6.300000000000001 1.689097222222222 6.300000000000001L 1.689097222222222 6.300000000000001L 1.689097222222222 30L 1.689097222222222 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M -1.689097222222222 30L -1.689097222222222 6.300000000000001Q -1.689097222222222 6.300000000000001 -1.689097222222222 6.300000000000001L 1.689097222222222 6.300000000000001Q 1.689097222222222 6.300000000000001 1.689097222222222 6.300000000000001L 1.689097222222222 6.300000000000001L 1.689097222222222 30L 1.689097222222222 30z" pathFrom="M -1.689097222222222 30L -1.689097222222222 30L 1.689097222222222 30L 1.689097222222222 30L 1.689097222222222 30L 1.689097222222222 30L 1.689097222222222 30L -1.689097222222222 30" cy="6.300000000000001" cx="1.689097222222222" j="0" val="79" barHeight="23.7" barWidth="3.378194444444444"></path><path id="SvgjsPath4357" d="M 3.5081249999999997 30L 3.5081249999999997 4.200000000000003Q 3.5081249999999997 4.200000000000003 3.5081249999999997 4.200000000000003L 6.886319444444444 4.200000000000003Q 6.886319444444444 4.200000000000003 6.886319444444444 4.200000000000003L 6.886319444444444 4.200000000000003L 6.886319444444444 30L 6.886319444444444 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 3.5081249999999997 30L 3.5081249999999997 4.200000000000003Q 3.5081249999999997 4.200000000000003 3.5081249999999997 4.200000000000003L 6.886319444444444 4.200000000000003Q 6.886319444444444 4.200000000000003 6.886319444444444 4.200000000000003L 6.886319444444444 4.200000000000003L 6.886319444444444 30L 6.886319444444444 30z" pathFrom="M 3.5081249999999997 30L 3.5081249999999997 30L 6.886319444444444 30L 6.886319444444444 30L 6.886319444444444 30L 6.886319444444444 30L 6.886319444444444 30L 3.5081249999999997 30" cy="4.200000000000003" cx="6.886319444444444" j="1" val="86" barHeight="25.799999999999997" barWidth="3.378194444444444"></path><path id="SvgjsPath4359" d="M 8.705347222222223 30L 8.705347222222223 12.600000000000001Q 8.705347222222223 12.600000000000001 8.705347222222223 12.600000000000001L 12.083541666666667 12.600000000000001Q 12.083541666666667 12.600000000000001 12.083541666666667 12.600000000000001L 12.083541666666667 12.600000000000001L 12.083541666666667 30L 12.083541666666667 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 8.705347222222223 30L 8.705347222222223 12.600000000000001Q 8.705347222222223 12.600000000000001 8.705347222222223 12.600000000000001L 12.083541666666667 12.600000000000001Q 12.083541666666667 12.600000000000001 12.083541666666667 12.600000000000001L 12.083541666666667 12.600000000000001L 12.083541666666667 30L 12.083541666666667 30z" pathFrom="M 8.705347222222223 30L 8.705347222222223 30L 12.083541666666667 30L 12.083541666666667 30L 12.083541666666667 30L 12.083541666666667 30L 12.083541666666667 30L 8.705347222222223 30" cy="12.600000000000001" cx="12.083541666666667" j="2" val="58" barHeight="17.4" barWidth="3.378194444444444"></path><path id="SvgjsPath4361" d="M 13.902569444444444 30L 13.902569444444444 13.8Q 13.902569444444444 13.8 13.902569444444444 13.8L 17.280763888888888 13.8Q 17.280763888888888 13.8 17.280763888888888 13.8L 17.280763888888888 13.8L 17.280763888888888 30L 17.280763888888888 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 13.902569444444444 30L 13.902569444444444 13.8Q 13.902569444444444 13.8 13.902569444444444 13.8L 17.280763888888888 13.8Q 17.280763888888888 13.8 17.280763888888888 13.8L 17.280763888888888 13.8L 17.280763888888888 30L 17.280763888888888 30z" pathFrom="M 13.902569444444444 30L 13.902569444444444 30L 17.280763888888888 30L 17.280763888888888 30L 17.280763888888888 30L 17.280763888888888 30L 17.280763888888888 30L 13.902569444444444 30" cy="13.8" cx="17.280763888888888" j="3" val="54" barHeight="16.2" barWidth="3.378194444444444"></path><path id="SvgjsPath4363" d="M 19.099791666666665 30L 19.099791666666665 10.2Q 19.099791666666665 10.2 19.099791666666665 10.2L 22.477986111111107 10.2Q 22.477986111111107 10.2 22.477986111111107 10.2L 22.477986111111107 10.2L 22.477986111111107 30L 22.477986111111107 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 19.099791666666665 30L 19.099791666666665 10.2Q 19.099791666666665 10.2 19.099791666666665 10.2L 22.477986111111107 10.2Q 22.477986111111107 10.2 22.477986111111107 10.2L 22.477986111111107 10.2L 22.477986111111107 30L 22.477986111111107 30z" pathFrom="M 19.099791666666665 30L 19.099791666666665 30L 22.477986111111107 30L 22.477986111111107 30L 22.477986111111107 30L 22.477986111111107 30L 22.477986111111107 30L 19.099791666666665 30" cy="10.2" cx="22.477986111111107" j="4" val="66" barHeight="19.8" barWidth="3.378194444444444"></path><path id="SvgjsPath4365" d="M 24.297013888888888 30L 24.297013888888888 17.4Q 24.297013888888888 17.4 24.297013888888888 17.4L 27.67520833333333 17.4Q 27.67520833333333 17.4 27.67520833333333 17.4L 27.67520833333333 17.4L 27.67520833333333 30L 27.67520833333333 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 24.297013888888888 30L 24.297013888888888 17.4Q 24.297013888888888 17.4 24.297013888888888 17.4L 27.67520833333333 17.4Q 27.67520833333333 17.4 27.67520833333333 17.4L 27.67520833333333 17.4L 27.67520833333333 30L 27.67520833333333 30z" pathFrom="M 24.297013888888888 30L 24.297013888888888 30L 27.67520833333333 30L 27.67520833333333 30L 27.67520833333333 30L 27.67520833333333 30L 27.67520833333333 30L 24.297013888888888 30" cy="17.4" cx="27.67520833333333" j="5" val="42" barHeight="12.6" barWidth="3.378194444444444"></path><path id="SvgjsPath4367" d="M 29.494236111111107 30L 29.494236111111107 16.5Q 29.494236111111107 16.5 29.494236111111107 16.5L 32.87243055555555 16.5Q 32.87243055555555 16.5 32.87243055555555 16.5L 32.87243055555555 16.5L 32.87243055555555 30L 32.87243055555555 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 29.494236111111107 30L 29.494236111111107 16.5Q 29.494236111111107 16.5 29.494236111111107 16.5L 32.87243055555555 16.5Q 32.87243055555555 16.5 32.87243055555555 16.5L 32.87243055555555 16.5L 32.87243055555555 30L 32.87243055555555 30z" pathFrom="M 29.494236111111107 30L 29.494236111111107 30L 32.87243055555555 30L 32.87243055555555 30L 32.87243055555555 30L 32.87243055555555 30L 32.87243055555555 30L 29.494236111111107 30" cy="16.5" cx="32.87243055555555" j="6" val="45" barHeight="13.5" barWidth="3.378194444444444"></path><path id="SvgjsPath4369" d="M 34.69145833333333 30L 34.69145833333333 9.3Q 34.69145833333333 9.3 34.69145833333333 9.3L 38.069652777777776 9.3Q 38.069652777777776 9.3 38.069652777777776 9.3L 38.069652777777776 9.3L 38.069652777777776 30L 38.069652777777776 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 34.69145833333333 30L 34.69145833333333 9.3Q 34.69145833333333 9.3 34.69145833333333 9.3L 38.069652777777776 9.3Q 38.069652777777776 9.3 38.069652777777776 9.3L 38.069652777777776 9.3L 38.069652777777776 30L 38.069652777777776 30z" pathFrom="M 34.69145833333333 30L 34.69145833333333 30L 38.069652777777776 30L 38.069652777777776 30L 38.069652777777776 30L 38.069652777777776 30L 38.069652777777776 30L 34.69145833333333 30" cy="9.3" cx="38.069652777777776" j="7" val="69" barHeight="20.7" barWidth="3.378194444444444"></path><path id="SvgjsPath4371" d="M 39.88868055555555 30L 39.88868055555555 3.6000000000000014Q 39.88868055555555 3.6000000000000014 39.88868055555555 3.6000000000000014L 43.266875 3.6000000000000014Q 43.266875 3.6000000000000014 43.266875 3.6000000000000014L 43.266875 3.6000000000000014L 43.266875 30L 43.266875 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 39.88868055555555 30L 39.88868055555555 3.6000000000000014Q 39.88868055555555 3.6000000000000014 39.88868055555555 3.6000000000000014L 43.266875 3.6000000000000014Q 43.266875 3.6000000000000014 43.266875 3.6000000000000014L 43.266875 3.6000000000000014L 43.266875 30L 43.266875 30z" pathFrom="M 39.88868055555555 30L 39.88868055555555 30L 43.266875 30L 43.266875 30L 43.266875 30L 43.266875 30L 43.266875 30L 39.88868055555555 30" cy="3.6000000000000014" cx="43.266875" j="8" val="88" barHeight="26.4" barWidth="3.378194444444444"></path><path id="SvgjsPath4373" d="M 45.085902777777775 30L 45.085902777777775 20.1Q 45.085902777777775 20.1 45.085902777777775 20.1L 48.46409722222222 20.1Q 48.46409722222222 20.1 48.46409722222222 20.1L 48.46409722222222 20.1L 48.46409722222222 30L 48.46409722222222 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 45.085902777777775 30L 45.085902777777775 20.1Q 45.085902777777775 20.1 45.085902777777775 20.1L 48.46409722222222 20.1Q 48.46409722222222 20.1 48.46409722222222 20.1L 48.46409722222222 20.1L 48.46409722222222 30L 48.46409722222222 30z" pathFrom="M 45.085902777777775 30L 45.085902777777775 30L 48.46409722222222 30L 48.46409722222222 30L 48.46409722222222 30L 48.46409722222222 30L 48.46409722222222 30L 45.085902777777775 30" cy="20.1" cx="48.46409722222222" j="9" val="33" barHeight="9.9" barWidth="3.378194444444444"></path><path id="SvgjsPath4375" d="M 50.283125 30L 50.283125 12.3Q 50.283125 12.3 50.283125 12.3L 53.661319444444445 12.3Q 53.661319444444445 12.3 53.661319444444445 12.3L 53.661319444444445 12.3L 53.661319444444445 30L 53.661319444444445 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 50.283125 30L 50.283125 12.3Q 50.283125 12.3 50.283125 12.3L 53.661319444444445 12.3Q 53.661319444444445 12.3 53.661319444444445 12.3L 53.661319444444445 12.3L 53.661319444444445 30L 53.661319444444445 30z" pathFrom="M 50.283125 30L 50.283125 30L 53.661319444444445 30L 53.661319444444445 30L 53.661319444444445 30L 53.661319444444445 30L 53.661319444444445 30L 50.283125 30" cy="12.3" cx="53.661319444444445" j="10" val="59" barHeight="17.7" barWidth="3.378194444444444"></path><path id="SvgjsPath4377" d="M 55.48034722222222 30L 55.48034722222222 10.2Q 55.48034722222222 10.2 55.48034722222222 10.2L 58.85854166666667 10.2Q 58.85854166666667 10.2 58.85854166666667 10.2L 58.85854166666667 10.2L 58.85854166666667 30L 58.85854166666667 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 55.48034722222222 30L 55.48034722222222 10.2Q 55.48034722222222 10.2 55.48034722222222 10.2L 58.85854166666667 10.2Q 58.85854166666667 10.2 58.85854166666667 10.2L 58.85854166666667 10.2L 58.85854166666667 30L 58.85854166666667 30z" pathFrom="M 55.48034722222222 30L 55.48034722222222 30L 58.85854166666667 30L 58.85854166666667 30L 58.85854166666667 30L 58.85854166666667 30L 58.85854166666667 30L 55.48034722222222 30" cy="10.2" cx="58.85854166666667" j="11" val="66" barHeight="19.8" barWidth="3.378194444444444"></path><path id="SvgjsPath4379" d="M 60.67756944444444 30L 60.67756944444444 12.900000000000002Q 60.67756944444444 12.900000000000002 60.67756944444444 12.900000000000002L 64.05576388888888 12.900000000000002Q 64.05576388888888 12.900000000000002 64.05576388888888 12.900000000000002L 64.05576388888888 12.900000000000002L 64.05576388888888 30L 64.05576388888888 30z" fill="rgba(0,207,1,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask5o5lirez)" pathTo="M 60.67756944444444 30L 60.67756944444444 12.900000000000002Q 60.67756944444444 12.900000000000002 60.67756944444444 12.900000000000002L 64.05576388888888 12.900000000000002Q 64.05576388888888 12.900000000000002 64.05576388888888 12.900000000000002L 64.05576388888888 12.900000000000002L 64.05576388888888 30L 64.05576388888888 30z" pathFrom="M 60.67756944444444 30L 60.67756944444444 30L 64.05576388888888 30L 64.05576388888888 30L 64.05576388888888 30L 64.05576388888888 30L 64.05576388888888 30L 60.67756944444444 30" cy="12.900000000000002" cx="64.05576388888888" j="12" val="57" barHeight="17.099999999999998" barWidth="3.378194444444444"></path><g id="SvgjsG4353" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG4354" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4356" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4358" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4360" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4362" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4364" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4366" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4368" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4370" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4372" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4374" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4376" className="apexcharts-bar-goals-groups"></g><g id="SvgjsG4378" className="apexcharts-bar-goals-groups"></g></g></g><g id="SvgjsG4352" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine4407" x1="-7.816666666666666" y1="0" x2="70.18333333333334" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine4408" x1="-7.816666666666666" y1="0" x2="70.18333333333334" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG4409" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG4410" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG4411" class="apexcharts-point-annotations"></g></g><g id="SvgjsG4389" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG4340" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend" style="max-height: 15px;"></div><div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 207, 1);"></span><div class="apexcharts-tooltip-text" style="font-family: Chakra Petch, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
								</div>
							</div>
							<!-- END stat-lg -->
							<!-- BEGIN stat-sm -->
							<div class="small text-white text-opacity-50 text-truncate">
								<i class="fa fa-chevron-up fa-fw me-1"></i> 33.3% more than last week<br>
								<i class="fa-solid fa-rotate fa-fw me-1"></i> Last Update 2022-9-15 16:38
							</div>
							<!-- END stat-sm -->
						</div>
						<!-- END card-body -->
						
						<!-- BEGIN card-arrow -->
						<div class="card-arrow">
							<div class="card-arrow-top-left"></div>
							<div class="card-arrow-top-right"></div>
							<div class="card-arrow-bottom-left"></div>
							<div class="card-arrow-bottom-right"></div>
						</div>
						<!-- END card-arrow -->
					</div>
					<!-- END card -->

	</div>
</div><!-- end app-content-->

<!-- Modal-->
<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header"><strong id="exampleModalLabel" class="modal-title"><?php echo $modal_title?></strong>
		<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">x</span></button>
	  </div>
	  <div class="modal-body">
		<!--p>Lorem ipsum dolor sit amet consectetur.</p-->
		<form id="myf" class="form-horizontal">
		  <div class="form-group">
			<label>Text</label>
			<input type="text" id="tx" name="tx" placeholder="Your text here" class="form-control">
		  </div>
		  <div class="row">
			  <div class="form-group col-md-6">
				<label class="form-control-label">Date</label>
				<div class="input-group">
					<input type="text" id="dt" name="dt" placeholder="Date" class="form-control datepicker">
					<div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
				</div>
			  </div>
			  <div class="form-group col-md-6">
				<label class="form-control-label">Time</label>
				<div class="input-group">
					<input type="text" id="tm" name="tm" placeholder="Time" class="form-control timepicker">
					<div class="input-group-append"><span class="input-group-text"><i class="fa fa-clock-o"></i></span></div>
				</div>
			  </div>
		  </div>
		  <div class="row">
			  <div class="form-group col-md-6">       
				<label>Select</label>
				<select class="form-control selectpicker">
					<option>option 1</option>
					<option>option 2</option>
					<option>option 3</option>
					<option>option 4</option>
				</select>
			  </div>
			  <div class="form-group col-md-6">       
				<label>Multiple Select</label>
				<select multiple class="form-control selectpicker">
					<option>option 1</option>
					<option>option 2</option>
					<option>option 3</option>
					<option>option 4</option>
				</select>
			  </div>
		  </div>
		</form>
	  </div>
	  <div class="modal-footer">
	    <button type="button" class="btn btn-danger">Delete</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button type="button" class="btn btn-success" onclick="if($('#myf').valid()){log('valid');}else{log('invalid');}">Save</button>
	  </div>
	</div>
  </div>
</div>


					

<?php 
include "inc.foot.php";
include "inc.js.php";
?>

<script>
var mytbl, jvalidate;
$(document).ready(function(){
	page_ready();
	mytbl = $("#mytbl").DataTable({
		serverSide: false,
		processing: true,
		searching: false,
		buttons: ['copy', 'csv'],
		initComplete: function(){
			//dttbl_buttons(); //for ajax call
		}
	});
	dttbl_buttons(); //remark this if ajax dttbl call
	datepicker(true);
	timepicker();
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

</script>

  </body>
</html>