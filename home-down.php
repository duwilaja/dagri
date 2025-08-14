<?php
$redirect=false;
$cleartext=true;

include "inc.common.php";
include "inc.session.php";
include "inc.db.php";

$conn=connect();

$whr=($mys_LOC=='')?"1=1":" loc in ('$mys_LOC')";

$sql="select hostname,ifname,ifinoctets_rate*8/1000 as inb,ifoutoctets_rate*8/1000 as outb,ifdescr from ports p join devices x on x.device_id=p.device_id 
 order by inb desc limit 5";

$sql="select n.host, name, MY_SECTOTIME(TIMESTAMPDIFF(SECOND,downsince,now())) as mstt from core_node n join core_status s on s.host=n.host 
where status=0 and downsince is not NULL and $whr order by downsince limit 5";

$rs=exec_qry($conn,$sql);
$lists=fetch_all($rs);

disconnect($conn);

for($i=0;$i<count($lists);$i++){
	$list=$lists[$i];
?>
	<tr>
		<td class="wd-5p">
			<div class="media-icon bg-danger crypto-icon my-auto me-2">
				<i class="fe fe-arrow-down-circle tx-20"></i>
			</div>
		</td>
		<td>
			<div class="d-flex align-middle ms-3">
				<div class="d-inline-block">
					<h6 class="mb-1"><?php echo $list[1]?></h6>
					<span class="status bg-danger"></span> <?php echo $list[0]?>
				</div>
			</div>
		</td>
		<td class="text-end">
			<div class="d-inline-block">
				<h6 class="mb-2 tx-15 font-weight-semibold"><?php echo $list[2]?></h6>
			</div>
		</td>
	</tr>
<?php
}
?>
