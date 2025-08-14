<?php
$ext=".php";
date_default_timezone_set("Asia/Jakarta");

$is_bai=true;
$is_nms=true;
$is_ticket=false;
$is_asset=false;
$is_hr=false;

$template="spruha"; //hud , spruha , aronox

$theme="hor-skin/horizontal-dark.css"; //hor-skin/hor-skin1.css
$theme="hor-skin/hor-skin1.css";

$app_url="http://localhost/nimnas/";

$lib_url="http://localhost:8080/api/v0/";
$lib_token="0eeab6a92040c3ac52f396b2b3fb9299";

$cgi_url="";
$rpt_dir="rpt/";
$trf_img=".svg";
$trf_ports="'wan1','wan2','eth0','br-vlan10'";

$company="Matrik, PT";
$about=array(base64_encode("Network Information & Monitoring System"), base64_encode("Licensed to $company"));

/*common values*/
$o_ugrp=[
	["","All"],
	["commercial","Commercial"],
	["billing","Billing Admin"],
	["finance","Finance/Collection"]
];
$o_ulvl=[
	["0","Super"],
	["1","Admin"],
	["11","User"]
];

$o_days=[
	["","-"],
	["0","Mon"],
	["1","Tue"],
	["2","Wed"],
	["3","Thu"],
	["4","Fri"],
	["5","Sat"],
	["6","Sun"]
];

$o_ssensor=[
	["status","On/Off Status"],
	["rtt","Ping RTT"],
	["mdev","Ping Jitter"],
	["lost/cnt","Ping Lost"]
];
$o_sseverity=[
	["minor","Minor"],
	["major","Major"],
	["critical","Critical"]
];
$o_assstts=[
	["active","active"],
	["standby","standby"],
	["inactive","inactive"]
];

$o_tikstts=[
	["new","new"],
//	["open","open"],
	["progress","progress"],
	["pending","pending"],
	["solved","solved"],
	["closed","closed"]
];
$o_tikgrp=[
	["EOS","EOS/L1"],
	["L2","L2"],
	["L3","L3"],
	["EU","End User"],
	["MGMT","Management"]
];
$o_prio=[
	["normal","normal"],
	["high","high"],
	["critical","critical"]
];

/*common php functions*/
function getVal($k,$kv){
	$ret="";
	for($i=0;$i<count($kv);$i++){
		if($kv[$i][0]==$k) $ret=$kv[$i][1];
	}
	return $ret;
}
function options($kv){
	$ret="";
	if(is_array($kv)){
	for($i=0;$i<count($kv);$i++){
		$ret.='<option value="'.$kv[$i][0].'">'.$kv[$i][1].'</option>';
	}
	}
	return $ret;
}
function multiple_select($f){
	$return="";
	for($i=0;$i<count($_POST[$f]);$i++){
		$return.=$return==""?"":";";
		$return.=$_POST[$f][$i];
	}
	return $return;
}
function breadcrumb($bread,$s='/'){
	$a=explode($s,$bread);
	$r="";
	for($i=0;$i<count($a);$i++){
		$r.='<li class="breadcrumb-item">'.$a[$i].'</li>';
	}
	return $r;
}

function lib_api($lib_token,$lib_url){
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, $lib_url);
	curl_setopt ($curl, CURLOPT_HEADER, false);
	curl_setopt ($curl, CURLOPT_HTTPHEADER, array('X-Auth-Token: '.$lib_token));
	curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
    $out=curl_exec ($curl);
    curl_close ($curl);
	return $out;
}

function compare($o,$n,$fix,$highlow=true){
	$ret="0%$fix";
	$d=$o==0?$n:$o;
	if($o>$n){
		$hl=$highlow?" lower ":"";
		$ret=round(($o-$n)/$o*100,2)."%$hl$fix";
	}
	if($o<$n){
		$hl=$highlow?" higher ":"";
		$ret=round(($n-$o)/$d*100,2)."%$hl$fix";
	}
	return $ret;
}
function compare_class($o,$n,$dclass,$hclass,$lclass){
	$ret=$dclass;
	if($n>$o){
		$ret=$hclass;
	}
	if($n<$o){
		$ret=$lclass;
	}
	return $ret;
}
function progress_bar($o,$fix,$t=-1){
	$t=($t==0)?1:$t;
	if($t==-1){
		$ret=ceil($o/10)*10;
	}else{
		$ret=ceil(($o/$t*100)/10)*10;
	}
	return '<div class="progress-bar '.$fix.' w-'.$ret.' " role="progressbar"></div>';
}
