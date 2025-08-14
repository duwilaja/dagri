<?php
//include "inc.common.php";
include 'inc.db.php';

$user=post('user');
$passwd=post('passwd');
$loggedin=false;
$m=get('m');
$x=get('x');

if($user!=''&&$passwd!=''){
	$conn=connect();
	$sql="select uid, uname, ulvl, ugrp, uprof, uavatar, uloc, utick from core_user where (md5(uid)=md5('$user')) and upwd=MD5('$passwd')";
	$rs = exec_qry($conn,$sql);
	if ($row = fetch_row($rs)) {
		session_start();
		
		$_SESSION['s_ID'] = $user;
		$_SESSION['s_NAME'] = $row[1];
		$_SESSION['s_LVL'] = $row[2];
		$_SESSION['s_GRP'] = $row[3];
		$_SESSION['s_PROF'] = $row[4];
		$_SESSION['s_AVATAR'] = $row[5];
		$_SESSION['s_LOC'] = $row[6];
		$_SESSION['s_TICK'] = $row[7];
		
		$loggedin=true;
	}else{
		$m='Wrong username/password';
		$x='error';
	}
	disconnect($conn);
}
if($loggedin){
	$hom='';
	if($is_asset) {$hom="ass_hom$ext";}
	if($is_ticket) {$hom="tick_hom$ext";}
	if($is_nms) {$hom="home$ext";}
	
	if($hom!=''){
		header("Location: $hom");
	}else{
		session_unset();
		session_destroy();
		
		$m="Module disabled";
	}
}

include "inc.head.php";
$menu="";
?>
		<!-- BEGIN login -->
		<div class="login">
			<!-- BEGIN login-content -->
			<div class="login-content">
				<form action="" method="POST" name="login_form" id="login_form">
					<div class="" style="align-items:center ;">
						<img src="hud/assets/img/logo-tni.png" alt="" class="">
					</div>
					<h1 class="text-center">Log In</h1>
					<div class="text-white text-opacity-50 text-center mb-4">
						For your protection, please verify your identity.
					</div>
					<div class="mb-3">
						<label class="form-label">Username <span class="text-danger">*</span></label>
						<input type="text" name="user" class="form-control form-control-lg bg-white bg-opacity-5" value="" placeholder="" />
					</div>
					<div class="mb-3">
						<div class="d-flex">
							<label class="form-label">Password <span class="text-danger">*</span></label>
							<!--a href="#" class="ms-auto text-white text-decoration-none text-opacity-50">Forgot password?</a-->
						</div>
						<input type="password"  name="passwd" class="form-control form-control-lg bg-white bg-opacity-5" value="" placeholder="" />
					</div>
					<!--div class="mb-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="customCheck1" />
							<label class="form-check-label" for="customCheck1">Remember me</label>
						</div>
					</div-->
					<button type="submit" class="btn btn-outline-theme btn-lg d-block w-100 fw-500 mb-3" onclick="if($('#login_form').valid()){this.form.submit();}">Log In</button>
					<!--div class="text-center text-white text-opacity-50">
						Don't have an account yet? <a href="page_register.html">Register</a>.
					</div-->
				</form>
			</div>
			<!-- END login-content -->
		</div>
		<!-- END login -->		
<?php
include "inc.foot.php";
include "inc.js.php";
?>
<script>
var x="<?php echo $x?>";
var m="<?php echo $m?>";
var jvalidate;
$(document).ready(function (){
	$(".page-main").addClass("page-single");
	jvalidate = $("#login_form").validate({
    rules :{
        "user" : {
            required : true
        },
		"passwd" : {
			required : true
		}
    }});
	showAlert();
	$("#app").addClass("app-full-height app-without-header");
});

function showAlert(){
	if(m!=""){
		alrt(m,x);
	}
}
</script>
  </body>
</html>