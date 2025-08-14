<?php
$redirect=false;
$cleartext=true;

include "inc.common.php";
include "inc.session.php";
include "inc.db.php";

$conn=connect();

$whr=($s_GRP=='')?"1=1":"(grp='$s_GRP')";

$tot=0;
$tots=fetch_all(exec_qry($conn,"select count(host) from core_node where $whr"));
if(count($tots)>0) $tot=$tots[0][0];

$rs=exec_qry($conn,"select if(prov='' or prov is null,'Undefined',prov) as prv, count(host) as cnt from core_node n left join core_location l on n.loc=l.locid where $whr group by prv order by prv");
$lists=fetch_alla($rs);

disconnect($conn);

foreach($lists as $dat){
	$val = ceil(ceil($dat['cnt']/$tot*100)/5)*5;
	?>
		<div class="row mt-4">
			<div class="col-6">
				<span class=""><?php echo $dat['prv']?></span>
			</div>
			<div class="col-5 my-auto">
				<div class="progress ht-6 my-auto">
					<div class="progress-bar ht-6 wd-<?php echo $val?>p" role="progressbar"
						aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
					</div>
				</div>
			</div>
			<div class="col-1">
				<div class="d-flex">
					<span class="tx-13"><b><?php echo $dat['cnt']?></b></span>
				</div>
			</div>
		</div>
	
	<?php
}
?>
