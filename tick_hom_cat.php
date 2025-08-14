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
$wtik.=post('prov')==''?'':" AND loc in (select locid from core_location where prov='".post('prov')."')";
$wtik.=post('loc')==''?'':" AND loc='".post('loc')."'";
$sql="select catid,catname,count(cat) as tot from tick_cat c left join tick_ets t on c.catid=t.cat where  $wtik group by catid,catname";

$rs=fetch_alla(exec_qry($conn,$sql));

disconnect($conn);

$tot=0;
for($i=0;$i<count($rs);$i++){
	$tot+=intval($rs[$i]['tot']);
}
for($i=0;$i<count($rs);$i++){
	//echo '<tr><td>'.$rs[$i]['catname'].'</td></tr>';
	$ico='fe fe-activity';
	switch($rs[$i]['catid']){
		case 'CR': $ico='fe fe-refresh-cw'; break;
		case 'IR': $ico='fe fe-info'; break;
	}
	echo	'<tr>
			<td class="d-flex">
			<div class="cryp-icon bg-danger my-auto me-2"> <i class="'.$ico.'"></i> </div>
				<div class="media-body ms-3">
					<span class="tx-15 font-weight-semibold my-auto">'.$rs[$i]['catname'].'</span>
				</div>
			</td>
			<td>( '.$rs[$i]['catid'].' )</td>
			<td class="">'.$rs[$i]['tot'].'</td>
			<td>'.round(((intval($rs[$i]['tot'])/$tot)*100),2).'%</td>
			<td>
				<div class="button-list">
					<a href="#" class="btn" onclick="tixcatdetil(\''.$rs[$i]['catid'].'\',\''.base64_encode($wtik).'\');"><i class="fe fe-eye"></i></a>
				</div>
			</td>
		</tr>';
}
?>
<!--
				<tr>
					<td class="d-flex">
					<div class="cryp-icon bg-danger my-auto me-2"> <i class="fe fe-activity"></i> </div>
						<div class="media-body ms-3">
							<span class="tx-15 font-weight-semibold my-auto">Problem Ticket </span>
						</div>
					</td>
					<td>( PT )</td>
					<td class="">1</td>
					<td>25%</td>
					<td>
						<div class="button-list">
							<a href="#" class="btn"><i class="fe fe-eye"></i></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="d-flex">
					<div class="cryp-icon bg-danger my-auto me-2"> <i class="fe fe-refresh-cw"></i> </div>
						<div class="media-body ms-3">
							<span class="tx-15 font-weight-semibold my-auto">Change Request </span>
						</div>
					</td>
					<td>( CRT )</td>
					<td class="">1</td>
					<td>25%</td>
					<td>
						<div class="button-list">
							<a href="#" class="btn"><i class="fe fe-eye"></i></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="d-flex">
					<div class="cryp-icon bg-danger my-auto me-2"> <i class="fe fe-info"></i> </div>
						<div class="media-body ms-3">
							<span class="tx-15 font-weight-semibold my-auto">Information</span>
						</div>
					</td>
					<td>( IRT )</td>
					<td class="">2</td>
					<td>50%</td>
					<td>
						<div class="button-list">
							<a href="#" class="btn"><i class="fe fe-eye"></i></a>
						</div>
					</td>
				</tr>
-->