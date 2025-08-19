<?php
$redirect=false;

include "inc.common.php";
include "inc.session.php";
include "inc.db.php";

$conn=connect();

$all=0;
$on=0;
$allpus=0;
$onpus=0;
$allpro=0;
$onpro=0;
$allkab=0;
$onkab=0;
$allkec=0;
$onkec=0;
$allkel=0;
$onkel=0;

$whr=($mys_LOC=='')?"1=1":" loc in ('$mys_LOC')";

//today
$sql="select count(s.host),sum(status),grp from core_status s left join core_node n on n.host=s.host where $whr group by grp";
//$sql.=$whr=='1=1'?"":" where host in (select host from core_node where $whr)";

$rs=exec_qry($conn,$sql);
while($row=fetch_row($rs)){
	$all+=$row[0]==null?0:$row[0];
	$on+=$row[1]==null?0:$row[1];
	$allpus=strtolower($row[2])=='pusat'?$row[0]:$allpus;
	$onpus=strtolower($row[2])=='pusat'?$row[1]:$onpus;
	$allpro=strtolower($row[2])=='propinsi'?$row[0]:$allpro;
	$onpro=strtolower($row[2])=='propinsi'?$row[1]:$onpro;
	$allkab=strtolower($row[2])=='kabupaten'?$row[0]:$allkab;
	$onkab=strtolower($row[2])=='kabupaten'?$row[1]:$onkab;
	$allkec=strtolower($row[2])=='kecamatan'?$row[0]:$allkec;
	$onkec=strtolower($row[2])=='kecamatan'?$row[1]:$onkec;
	$allkel=strtolower($row[2])=='kelurahan'?$row[0]:$allkel;
	$onkel=strtolower($row[2])=='kelurahan'?$row[1]:$onkel;
}

disconnect($conn);

//echo json_encode(($yearweeks));

$out=array(
"tdev"=>$all,
"dtot"=>'<b>'.$all.'</b>',//.$all_class."100%)</span>",//$all_perc, 
"don"=>'<b>'.$on.'</b>',//.$on_class.(round($on/$all*100,2))."%)</span>",//$on_class.//$on_perc, 
"doff"=>'<b>'.($all-$on).'</b>', //.$off_class.(round($off/$all*100,2))."%)</span>"//$off_perc
"pusat_dtot"=>$allpus,
"propinsi_dtot"=>$allpro,
"kabupaten_dtot"=>$allkab,
"kecamatan_dtot"=>$allkec,
"kelurahan_dtot"=>$allkel,
"pusat_don"=>$onpus,
"propinsi_don"=>$onpro,
"kabupaten_don"=>$onkab,
"kecamatan_don"=>$onkec,
"kelurahan_don"=>$onkel,
"pusat_doff"=>($allpus-$onpus),
"propinsi_doff"=>($allpro-$onpro),
"kabupaten_doff"=>($allkab-$onkab),
"kecamatan_doff"=>($allkec-$onkec),
"kelurahan_doff"=>($allkel-$onkel)
);

$msgs = array($out);
echo json_encode(array('code'=>"200",'ttl'=>"OK",'msgs'=>$msgs));
?>