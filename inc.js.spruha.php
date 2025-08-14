	<!-- ================== BEGIN spruha core-js ================== -->
		<!-- Jquery js-->
		<script src="spruha/assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap js-->
		<script src="spruha/assets/plugins/bootstrap/js/popper.min.js"></script>
		<script src="spruha/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!-- Perfect-scrollbar js -->
		<script src="spruha/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

		<!-- Sidemenu js -->
		<script src="spruha/assets/plugins/sidemenu/sidemenu.js" id="leftmenu"></script>

		<!-- Sidebar js -->
		<script src="spruha/assets/plugins/sidebar/sidebar.js"></script>

		<!-- Sticky js -->
		<script src="spruha/assets/js/sticky.js"></script>

		<!-- Owl Carousel js-->
		<script src="spruha/assets/plugins/owl-carousel/owl.carousel.js"></script>
		<!-- Owl Carousel js-->
		<script src="spruha/assets/plugins/select2/js/select2.min.js"></script>
		 
		<!-- Custom js -->
		<script src="spruha/assets/js/custom.js"></script>
	<!-- ================== END spruha core-js ================== -->
	
	<!--Othercharts js--
	<script src="aronox/assets/plugins/othercharts/jquery.sparkline.min.js"></script>

	<!-- Circle-progress js--
	<script src="aronox/assets/js/vendors/circle-progress.min.js"></script>

	<!--Horizontal js--
	<script src="aronox/assets/plugins/horizontal-menu/horizontal.js"></script>

	<!-- P-scroll js--
	<script src="aronox/assets/plugins/p-scroll/perfect-scrollbar.js"></script-->
	
	<!-- Peitychart js--
	<script src="aronox/assets/plugins/peitychart/jquery.peity.min.js"></script>
	
	<!-- Custom js--
	<script src="aronox/assets/js/custom.js"></script-->
	
	<script src="vendor/peitychart/jquery.peity.min.js"></script>
	
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
    <script src="vendor/morris/raphael.min.js"></script>
    <script src="vendor/morris/morris.min.js"></script>
    
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
	$(".nav-item").removeClass("active");
	$("i.fe-chevron-up").hide();
	$(".app-content").addClass("main-container").addClass("container-fluid");
	$(".container").addClass("inner-body");
	
	setTimeout(function(){$(".text-white").addClass("text-whitex").removeClass("text-white");},3000);
	
	function toggle_dark(){
		$.ajax({
		type: 'POST',
		url: 'datasave'+ext,
		data: {mnu:'theme'},
		success: function(data){
			log('OK');
		},
		error: function(xhr){
			log('Please check your connection'+xhr);
		}
	});
	}
	
	var excld=["device","libdevice","lib_device"];
	if(!excld.includes(page)) $(".container").removeClass("container");
	</script>
	<!-- my own custom js -->
	<script src="js/custom.spruha.js"></script>
	
	<!-- this page's JavaScript -->
	