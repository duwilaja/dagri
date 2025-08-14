<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		
		<!-- Title -->
		<title>Network Information & Monitoring</title>

		<!--Favicon -->
		<link rel="icon" href="aronox/assets/images/brand/favicon.ico" type="image/x-icon"/>

		<!-- ================== BEGIN spruha core-css ================== -->
		<!-- Bootstrap css-->
		<link  id="style" href="spruha/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

		<!-- Icons css-->
		<link href="spruha/assets/plugins/web-fonts/icons.css" rel="stylesheet"/>
		<link href="spruha/assets/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
		<link href="spruha/assets/plugins/web-fonts/plugin.css" rel="stylesheet"/>
		<!-- Owl-carousel css-->
		<link href="spruha/assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />
		<!-- select2 css-->
		<link href="spruha/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />

		<!-- Style css-->
		<link href="spruha/assets/css/style.css" rel="stylesheet">
		<!-- ================== END spruha core-css ================== -->
				
		<!-- datatables CSS-->
		<!--link rel="stylesheet" href="vendor/datatables/datatables.min.css"-->
		<link rel="stylesheet" href="vendor/datatables.net-bs4/dataTables.bootstrap4.css">
		<link rel="stylesheet" href="vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
		
		<!-- bootstrap CSS-->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap-datetimepicker.min.css">
		
		<!-- leaflet CSS-->
		<link rel="stylesheet" href="vendor/leaflet/leaflet.css">
		<link rel="stylesheet" href="vendor/leaflet/MarkerCluster.css">
		<link rel="stylesheet" href="vendor/leaflet/MarkerCluster.Default.css">
		<link rel="stylesheet" href="vendor/leaflet/leaflet.awesome-markers.css">
		
		<!-- fancybox CSS-->
		<link rel="stylesheet" href="vendor/jquery-fancybox/jquery.fancybox.min.css">
		
		<!-- overwrite css -->
		<link href="css/custom.css" rel="stylesheet" />
		<style type="text/css">
		.input-group-text{
			padding: .600rem;
		}
		.form-control:not([multiple]) option {
			color: #000;
		}
		.text-whitex{
			color: #aaa;
		}
		.text-whites{
			color: #fff;
		}
		.notification::before{
			background: var(--primary-transparentcolor);
		}
		
		.newx{
			color: var(--primary);
		}
		.progressx{
			color: var(--success);
		}
		.pendingx{
			color: var(--danger);
		}
		.solvedx{
			color: var(--warning);
		}
		.closedx{
			color: var(--secondary);
		}
		.main-notification-list .media:hover, .main-notification-list .media:focus{
			cursor: auto;
		}
		.blink-bg{
			animation: blinkingBackground 2s infinite;
		}
		@keyframes blinkingBackground{
/*			0%		{ background-color: #10c018;}
			25%		{ background-color: #1056c0;}
			50%		{ background-color: #ef0a1a;}
			75%		{ background-color: #254878;}
			100%	{ background-color: #04a1d5;}*/
			0% { background-color: #ef0a1a; }
			25%	{ background-color: #ef1a4a;}
			50%	{ background-color: #ef0515;}
			75%	{ background-color: #f14878;}
			100% { background-color: #f16d75; }
		}
		.divlnk{
			cursor:pointer;
		}
		select[readonly] option, select[readonly] optgroup {
			display: none;
		}
		.btn-yellow{
			color: #ffffff;
			background-color: #ffc107;
			border-color: #ffc107;
		}
		.btn-orange{
			color: #ffffff;
			background-color: #fd7e14;
			border-color: #fd7e14;
		}
		.btn-red{
			color: #ffffff;
			background-color: #dc3545;
			border-color: #dc3545;
		}
		#legend {
		  font-family: Arial, sans-serif;
		  background: #fff;
		  padding: 10px;
		  margin: 10px;
		  border: 3px solid #000;
		}

		#legend h3 {
		  margin-top: 0;
		}

		#legend img {
		  vertical-align: middle;
		}

		</style>

	</head>

	<body class="ltr main-body leftmenu <?php if(isset($_SESSION['theme'])) echo $_SESSION['theme']; ?>">

		<!-- Loader -->
		<div id="global-loader">
			<img src="spruha/assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page">
