<?php
$redirect=false;

include "inc.common.php";
include "inc.session.php";
include "inc.db.php";

$conn=connect();

$wtik="(1=1)";
if($mys_LOC!=''){
	$wtik.= " AND loc in ('$mys_LOC')";
}
//$wtik.=post('prov')==''?'':" AND loc in (select locid from core_location where prov='".post('prov')."')";
//$wtik.=post('loc')==''?'':" AND loc='".post('loc')."'";
$sql="select catid,catname,count(cat) as tot from ass_cat c left join ass_ets t on c.catid=t.cat where  $wtik group by catid,catname";

$rs=fetch_alla(exec_qry($conn,$sql));

disconnect($conn);

$tot=0;
for($i=0;$i<count($rs);$i++){
	$tot+=intval($rs[$i]['tot']);
}
$tot=$tot==0?1:$tot;
for($i=0;$i<count($rs);$i++){
	//echo '<tr><td>'.$rs[$i]['catname'].'</td></tr>';
	/*$ico='fe fe-activity';
	switch($rs[$i]['catid']){
		case 'CR': $ico='fe fe-refresh-cw'; break;
		case 'IR': $ico='fe fe-info'; break;
	}*/
	echo	'<tr>
			<td class="d-flex">
			<div class="bg-primary my-auto me-2"></div>
				<div class="my-auto me-2">
					<p class="mb-0 d-flex justify-content-center "><span class="legend bg-primary brround"></span>'.$rs[$i]['catname'].'</p>
				</div>
			</td>
			<td class="">'.$rs[$i]['tot'].'</td>
			<td>'.round(((intval($rs[$i]['tot'])/$tot)*100),2).'%</td>
		</tr>';
}
?>
