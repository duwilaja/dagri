<?php
$redirect=false;
$cleartext=true;

include "inc.common.php";
include "inc.session.php";
include "lib_inc.db.php";

$conn=connect();

$host=post('h');
$id=post('idx',$conn,0);
$df=post("df");
$dt=post("dt");
$dfdt=($df!=''&&$dt!='')?"from=".strtotime("$df 00:00:00")."&to=".strtotime("$dt 23:59:59"):"";

$sql="select ifName,ifDescr from ports where device_id=$id and deleted=0";
$rs=exec_qry($conn,$sql);
$ports=fetch_alla($rs);

disconnect($conn);

if(count($ports)>0){
	$endpoint="devices/".$host."/ports/";
?>
<div class="row">
	<?php
	for($i=0;$i<count($ports);$i++){
		$port=$ports[$i];
		$name=$port['ifName'];
		$desc=$port['ifDescr'];
		$isdescr=$name==""?"?ifDescr=true":"";
		$isdescrimg=$name==""?"?ifDescr=true&$dfdt":"?$dfdt";
		$name=$name==""?$desc:$name;
		$lnk=urlencode(base64_encode($endpoint.urlencode($name).'/port_bits'.$isdescr));
		$lnkimg=urlencode(base64_encode($endpoint.urlencode($name).'/port_bits'.$isdescrimg));
		//echo base64_decode($lnk);
	?>
		<div class="col-lg-6 text-center center">
			<?php echo $name==$desc?$name:$name." - ".$desc ?>
			<br />
			<a href="JavaScript:;" data-fancybox="" data-type="iframe" data-src="lib_device_graph<?php echo $ext?>?l=<?php echo $lnk?>&h=<?php echo $host?>&g=<?php echo $name?>&f=<?php echo base64_encode($df)?>&t=<?php echo base64_encode($dt)?>">
				<img style="background:white;" width="100%" src="lib_api<?php echo $ext?>?lnk=<?php echo $lnkimg?>" />
			</a>
		</div>
	<?php
	}
	?>
</div>
<?php
}else{
	echo "No Interface found.";
}
?>
