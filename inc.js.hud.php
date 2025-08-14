	<!-- ================== BEGIN hud core-js ================== -->
	<script src="hud/assets/js/vendor.min.js"></script>
	<script src="hud/assets/js/app.min.js"></script>
	<!-- ================== END hud core-js ================== -->
	
	<!--Othercharts js-->
	<script src="aronox/assets/plugins/othercharts/jquery.sparkline.min.js"></script>

	<!-- Circle-progress js-->
	<script src="aronox/assets/js/vendors/circle-progress.min.js"></script>

	<!--Horizontal js-->
	<script src="aronox/assets/plugins/horizontal-menu/horizontal.js"></script>

	<!-- P-scroll js-->
	<script src="aronox/assets/plugins/p-scroll/perfect-scrollbar.js"></script>
	
	<!-- Peitychart js-->
	<script src="aronox/assets/plugins/peitychart/jquery.peity.min.js"></script>
	
	<!-- Custom js--
	<script src="aronox/assets/js/custom.js"></script-->
	
	<script src="vendor/bootstrap/js/moment.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap-select.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
    
	<script src="vendor/datatables/datatables.min.js"></script>
    <script src="vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.html5.min.js"></script>
	
    <script src="vendor/swal2/sweetalert.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/jquery-fancybox/jquery.fancybox.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    
	<script src="vendor/leaflet/leaflet.js"></script>
    <script src="vendor/leaflet/leaflet.markercluster.js"></script>
	<script src="vendor/leaflet/leaflet.awesome-markers.js"></script>
    
	<!-- global vars -->
	<script>
	var ext='<?php echo $ext?>';
	var page='<?php echo $menu?>';
	$("button.btn-default").attr("data-bs-dismiss","modal");
	$("button.close").attr("data-bs-dismiss","modal");
	$("i.fe-upload").addClass("fa fa-upload").attr("data-bs-toggle","modal").attr("data-bs-target","#modal_batch");
	$("i.fe-plus").addClass("fa fa-plus").attr("data-bs-toggle","modal").attr("data-bs-target","#myModal");
	$("i.fe-refresh-cw").addClass("fa fa-refresh");
	
	
	var card_arrow =	'<div class="card-arrow">'+
							'<div class="card-arrow-top-left"></div>'+
							'<div class="card-arrow-top-right"></div>'+
							'<div class="card-arrow-bottom-left"></div>'+
							'<div class="card-arrow-bottom-right"></div>'+
						'</div>';
	$("div.card").append(card_arrow);
	
	</script>
	<!-- my own custom js -->
	<script src="js/custom.hud.js"></script>
	
	<!-- this page's JavaScript -->
	