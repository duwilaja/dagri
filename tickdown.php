<?php
include "inc.common.php";
include "inc.session.php";


include "inc.db.php";


$conn=connect();
$tick=get("t",$conn);

$his=array();

$rs=fetch_alla(exec_qry($conn,"select * from tick_ets where ticketno='$tick'"));
if(count($rs)>0){
	$his=fetch_alla(exec_qry($conn,"select * from tick_note where ticketno='$tick' order by dtm"));
}
disconnect($conn);

if(count($rs)<1) die("Data not found");

header('Content-Disposition: attachment; filename="'.$tick.'.xls"');
header("Content-Type: application/vnd.ms-excel");
?>
<html>
<head><title>Ticket# <?php echo $tick?></title>
<body>
<h3>Ticket</h3>
<table>
<tr><td>#</td><td><?php echo $tick?></td></tr>
<tr><td>Subject</td><td><?php echo $rs[0]["h"]?></td></tr>
<tr><td>Detail</td><td><?php echo $rs[0]["d"]?></td></tr>
<tr><td>Status</td><td><?php echo $rs[0]["stts"]?></td></tr>
<tr><td>Reported</td><td><?php echo $rs[0]["dtm"]?></td></tr>
<tr><td>Category</td><td><?php echo $rs[0]["cat"]?></td></tr>
<tr><td>Service</td><td><?php echo $rs[0]["svc"]?></td></tr>
</table>

<h4>History</h4>
<table>
<tr><td>Date/Time</td><td>Note</td><td>By</td><td>Status</td><td>Attc</td></tr>
<?php 
for($i=0;$i<count($his);$i++){
?>
<tr><td><?php echo $his[$i]["dtm"]?></td><td><?php echo $his[$i]["notes"]?></td>
<td><?php echo $his[$i]["updby"]?></td><td><?php echo $his[$i]["stts"]?></td>
<td><a target="_blank" href="<?php echo $app_url?>tickattc/<?php echo $his[$i]["attc"] ?>"><?php echo $his[$i]["attc"]?></a></td></tr>
<?php }?>
</table>
</body>
</html>
