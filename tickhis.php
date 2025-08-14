<?php 
include "inc.common.php";
include "inc.session.php";

$tick=$_GET["id"];

$page_icon="fa fa-home";
$page_title="History Ticket #$tick";
$modal_title="Title of Modal";
$menu="tickhis";

$breadcrumb="Ticket/History";

include "inc.head.php";
//include "inc.menutop.php";
include "inc.db.php";

$conn=connect();
$sql="select DATE_FORMAT(dtm,'%a, %e %b') as d,DATE_FORMAT(dtm,'%H:%i') as t,uname,uavatar,notes,stts,attc 
from tick_note n left join core_user u on u.uid=n.updby where ticketno='$tick' order by dtm desc";
$recs=fetch_alla(exec_qry($conn,$sql));
disconnect($conn);
?>
				<div class="app-content page-body">
					<div class="container">

						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title"><?php echo $page_title ?></h4>
								<ol class="breadcrumb pl-0">
									<?php echo breadcrumb($breadcrumb)?>
								</ol>
							</div>
							<div class="d-flex">
								<a target="_blank" href="tickdown<?php echo $ext?>?t=<?php echo $tick?>" class="btn btn-primary"> <i class="fe fe-download-cloud me-2"></i> Download </a>
							</div>
						</div>
						<!--End Page header-->
						
						<ul class="notification">
						<?php foreach($recs as  $rec){?>
							<li>
								<div class="notification-time text-white"> <span class="date"><?php echo $rec['d']?></span> <span class="time"><?php echo $rec['t']?></span> </div> 
								<div class="notification-icon"><a href="javascript:void(0);"></a></div> 
								<div class="notification-time-date mb-2 d-block d-md-none text-white"> 
									<span class="date"><?php echo $rec['d']?></span> <span class="time ms-2"><?php echo $rec['t']?></span> 
								</div> 
								<div class="notification-body"> 
									<div class="media mt-0"> 
										<div class="avatar-md">
											<img alt="avatar" class="rounded-6" src="avatars/<?php echo ($rec['uavatar']=='')?'logo.jpg':$rec['uavatar'];?>">
										</div> 
										<div class="media-body ms-3 d-flex"> 
											<div class=""> 
												<p class="tx-14 text-dark mb-0 tx-semibold"><?php echo $rec['uname']?></p>
												<p class="mb-0 tx-13 text-muted"><?php echo $rec['notes']?></p><br />
												<p><?php if($rec['attc']<>'') echo '<img src="tickattc/'.$rec['attc'].'" />';?></p>
											</div> 
											<div class="notify-time"> <p class="mb-0 tx-11 <?php echo $rec['stts']?>x"><?php echo $rec['stts']?></p></div> 
										</div> 
									</div> 
								</div> 
							</li>
						<?php }?>
						</ul>
						
					</div>
				</div><!-- end app-content-->
				
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
<?php 
include "inc.foot.php";
include "inc.js.php";
?>
<script>
$(document).ready(function(){
	page_ready();
})
</script>

  </body>
</html>