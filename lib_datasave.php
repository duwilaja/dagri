<?php
$redirect=false;
include "inc.common.php";
include "inc.session.php";
include 'lib_inc.db.php';

$code='404';
$ttl='Error';
$msgs='Action not found';

$conn = connect();

$mn=post('mnu',$conn);

if($mn=='mport'){
	$sql="INSERT IGNORE INTO nimdb.core_ports (host,device,port,ifname) SELECT hostname,p.device_id,port_id,ifname FROM ports p JOIN devices d ON p.device_id=d.device_id WHERE deleted=0";
	$res=exec_qry($conn,$sql);
	if(db_error($conn)==""){
		$sql="UPDATE nimdb.core_ports cp JOIN ports p ON p.device_id=cp.device AND p.port_id=cp.port SET cp.ifname = p.ifname";
		$res=exec_qry($conn,$sql);
	}
	if(db_error($conn)==""){
		$sql="DELETE FROM nimdb.core_ports WHERE ifname IS NULL OR ifname='' OR port IN (SELECT port_id FROM ports WHERE deleted=1)";
		$res=exec_qry($conn,$sql);
	}
	if(db_error($conn)==""){
		$code="200"; $ttl="Success"; $msgs="Data loaded";
	}else{
		$code="500"; $msgs=db_error($conn);
	}
}

disconnect($conn);

echo json_encode(array('code'=>$code,'ttl'=>$ttl,'msgs'=>$msgs));
?>