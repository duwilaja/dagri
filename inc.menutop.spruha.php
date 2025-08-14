<?php include "inc.header.php"; ?>
		<!-- Sidemenu -->
		<div class="sticky">
			<div class="main-menu main-sidebar main-sidebar-sticky side-menu">
				<div class="main-sidebar-header main-container-1 active">
					<div class="sidemenu-logo">
						<a class="main-logo" href="home<?php echo $ext?>">
							<img src="img/icon-sidebar.png" class="header-brand-img desktop-logo" alt="logo">
							<img src="img/icon-sidebar-hide.png" class="header-brand-img icon-logo" alt="logo">
							<img src="img/icon-sidebar.png" class="header-brand-img desktop-logo theme-logo" alt="logo">
							<img src="img/icon-sidebar-hide.png" class="header-brand-img icon-logo theme-logo" alt="logo">
						</a>
					</div>
				<!-- BEGIN menu -->
				<div class="main-sidebar-body main-body-1">
				<div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
				<div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
				<ul class="menu-nav nav">
<?php if(isset($myprof)){?>
					<li class="nav-header"><span class="nav-label">My Profile</span></li>
					<li class="nav-item">
						<a class="nav-link" href="prof_att<?php echo $ext?>">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-user sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Attendance</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="prof_leav<?php echo $ext?>">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-shift-right sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">DayOff Request</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="prof_rem<?php echo $ext?>">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-wallet sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Reimbursment</span>
						</a>
					</li>
<?php }else{?>
					<?php if($is_nms){?>
					<li class="nav-item">
						<a class="nav-link with-sub" href="javascript:void(0)">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="fa fa-server sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Monitoring</span>
						</a>
						<ul class="nav-sub">
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">Overview</a>
							<ul class="sub-nav-sub">
								<li class="nav-sub-item"><a class="nav-sub-link home" href="home<?php echo $ext?>">Dashboard</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link ncategory" href="n_category<?php echo $ext?>">Category View</a></li>
								<!--li class="nav-sub-item"><a class="nav-sub-link org" href="org<?php echo $ext?>">Business View</a></li-->
								<li class="nav-sub-item"><a class="nav-sub-link topo" href="topo<?php echo $ext?>">Topology View</a></li>
								<!--li class="nav-sub-item hidden"><a class="nav-sub-link maps" href="maps<?php echo $ext?>">Map View</a></li-->
							</ul>
							</li>
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">Objects</a>
							<ul class="sub-nav-sub">
								<li class="nav-sub-item"><a class="nav-sub-link ndevice" href="n_devicex<?php echo $ext?>">Devices</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link nlocation" href="n_location<?php echo $ext?>">Locations</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link papp" href="p_snmpd<?php echo $ext?>">SNMP</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link papp" href="p_app<?php echo $ext?>">Application</a></li>
							</ul>
						</ul>
					</li>
					<?php }?>
					<?php if($is_ticket){?>
					<li class="nav-item">
						<a class="nav-link with-sub" href="javascript:void(0)">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="fa fa-newspaper-o sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Ticketing</span>
						</a>
						<ul class="nav-sub">
							<li class="nav-sub-item"><a class="nav-sub-link ticks" href="tick_hom<?php echo $ext?>">Dashboard</a></li>
							<!--li class="nav-sub-item"><a class="nav-sub-link tickloc" href="tick_mapsx<?php echo $ext?>">Map View</a></li-->
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">Tickets</a>
							<ul class="sub-nav-sub">
								<li class="nav-sub-item"><a class="nav-sub-link tickets altix" href="tickets<?php echo $ext?>">All</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link tickets prgrs" href="tickets<?php echo $ext?>?o=1">Progress</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link tickets mytix" href="tickets<?php echo $ext?>?m=1">My Tickets</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link tickets mygrp" href="tickets<?php echo $ext?>?g=1">My Group</a></li>
							</ul>
							</li>
						</ul>
					</li>
					<?php }?>
					<?php if($is_asset && $s_LVL!=12){?>
					<li class="nav-item">
						<a class="nav-link with-sub" href="javascript:void(0)">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="fa fa-cubes sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Asset</span>
						</a>
						<ul class="nav-sub">
							<li class="nav-sub-item"><a class="nav-sub-link ass" href="ass_hom<?php echo $ext?>">Dashboard</a></li>
							<!--li class="nav-sub-item hidden"><a class="nav-sub-link asetloc" href="ass_mapsx<?php echo $ext?>">Map View</a></li-->
							<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_ass<?php echo $ext?>">Assets</a></li>
						</ul>
					</li>
					<?php }?>
					<?php if($is_hr && ($s_LVL==0||$s_LVL==1||$s_LVL==2)){?>
					<li class="nav-item">
						<a class="nav-link with-sub" href="javascript:void(0)">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="fa fa-users sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">HR</span>
						</a>
						<ul class="nav-sub">
							<li class="nav-sub-item"><a class="nav-sub-link ass" href="hr_hom<?php echo $ext?>">Dashboard</a></li>
							<li class="nav-sub-item"><a class="nav-sub-link asetloc" href="hr_att<?php echo $ext?>">Attendance</a></li>
							<li class="nav-sub-item"><a class="nav-sub-link muser" href="hr_leav<?php echo $ext?>">Leave</a></li>
							<li class="nav-sub-item"><a class="nav-sub-link muser" href="hr_rem<?php echo $ext?>">Reimburse</a></li>
						</ul>
					</li>
					<?php }?>
					
					<li class="nav-item">
						<a class="nav-link with-sub" href="javascript:void(0)">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="fa fa-file-text sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Reports</span>
						</a>
						<ul class="nav-sub">
					<?php if($is_bai){?>
							<li class="nav-sub-item"><a class="nav-sub-link rbai" href="r_bai<?php echo $ext?>">BAI</a></li>
					<?php }?>
					<?php if($is_nms){?>
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">Monitoring</a>
							<ul class="sub-nav-sub">
								<li class="nav-sub-item"><a class="nav-sub-link rdevice" href="r_device<?php echo $ext?>">Devices</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link rlocation" href="r_location<?php echo $ext?>">Locations</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link rperf" href="r_perf<?php echo $ext?>">Performance</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link rsla" href="r_sla<?php echo $ext?>">SLA</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link rseverity" href="r_severity<?php echo $ext?>">Severity</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link rupdown" href="r_updown<?php echo $ext?>">UP/Down</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link rtraffic" href="r_traffic<?php echo $ext?>">Traffic</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link rtraffic" href="r_gen<?php echo $ext?>">Generate</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link rtraffic" href="r_arch<?php echo $ext?>">Archieve</a></li>
							</ul>
							</li>
					<?php }?>
					<?php if($is_ticket){?>
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">Ticketing</a>
							<ul class="sub-nav-sub">
								<li class="nav-sub-item"><a class="nav-sub-link " href="r_ticksum<?php echo $ext?>">Summary</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link " href="r_tick<?php echo $ext?>">Tickets</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link " href="r_mttr<?php echo $ext?>">MTTR</a></li>
							</ul>
							</li>
					<?php }?>
					<?php if($is_asset && $s_LVL!=12){?>
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">Asset</a>
							<ul class="sub-nav-sub">
								<li class="nav-sub-item"><a class="nav-sub-link mlov" href="r_asssum<?php echo $ext?>">Summary</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link muser" href="r_asss<?php echo $ext?>">Assets</a></li>
							</ul>
							</li>
					<?php }?>
					<?php if($is_hr && ($s_LVL==0||$s_LVL==1)){?>
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">HR</a>
							<ul class="sub-nav-sub">
								<li class="nav-sub-item"><a class="nav-sub-link" href="r_absen<?php echo $ext?>">Attendance</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link muser" href="r_leave<?php echo $ext?>">Leave</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link" href="r_reim<?php echo $ext?>">Reimburse</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link" href="r_story<?php echo $ext?>">Activity</a></li>
							</ul>
							</li>
					<?php }?>
						</ul>
					</li>
					<?php if($s_LVL==0||$s_LVL==1){?>
					<li class="nav-header"><span class="nav-label">Setup & Tools</span></li>
					<li class="nav-item">
						<a class="nav-link with-sub" href="javascript:void(0)">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="fa fa-gears sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Setup</span>
						</a>
						<ul class="nav-sub">
							<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_loc<?php echo $ext?>">Locations</a></li>
							<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_events<?php echo $ext?>">Events</a></li>
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">Monitoring</a>
							<ul class="sub-nav-sub">
								<?php if($s_LVL==0){?>
								<li class="nav-sub-item"><a class="nav-sub-link mlov" href="m_lov<?php echo $ext?>">LoV</a></li>
								<!--li class="nav-sub-item"><a class="nav-sub-link muser" href="m_user<?php echo $ext?>">User</a></li-->
								<?php }?>
								<li class="nav-sub-item"><a class="nav-sub-link mlov" href="m_device<?php echo $ext?>">Devices</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link mlov" href="m_topo<?php echo $ext?>">Topology</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_sla<?php echo $ext?>">SLA</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link mlov" href="m_severity<?php echo $ext?>">Severity</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_bg<?php echo $ext?>">Controls</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_ports<?php echo $ext?>">Ports</a></li>
							</ul>
							</li>
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">Ticketing</a>
							<ul class="sub-nav-sub">
								<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_serv<?php echo $ext?>">Services</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_ticat<?php echo $ext?>">Categories</a></li>
							</ul>
							</li>
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">Asset</a>
							<ul class="sub-nav-sub">
								<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_brand<?php echo $ext?>">Brand</a></li>
								<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_ascat<?php echo $ext?>">Categories</a></li>
							</ul>
							</li>
							<li class="nav-sub-item"><a class="nav-sub-link sub-with-sub" href="javascript:void(0)">HR</a>
							<ul class="sub-nav-sub">
								<li class="nav-sub-item"><a class="nav-sub-link muser" href="m_kar<?php echo $ext?>">Employee</a></li>
								<!--li class="nav-sub-item"><a class="nav-sub-link muser" href="m_kset<?php echo $ext?>">Setting</a></li-->
							</ul>
							</li>
						</ul>
					</li>
					<?php }?>
					<li class="nav-item">
						<a class="nav-link with-sub" href="javascript:void(0)">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="fa fa-wrench sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Tools</span>
						</a>
						<ul class="nav-sub">
							<li class="side-menu-label1"><a href="javascript:void(0)">Tools</a></li>
							<li class="nav-sub-item"><a class="nav-sub-link mlov" href="t_ping<?php echo $ext?>">Ping</a></li>
							<li class="nav-sub-item"><a class="nav-sub-link muser" href="t_trace<?php echo $ext?>">Trace</a></li>
							<li class="nav-sub-item"><a class="nav-sub-link muser" href="t_snmp<?php echo $ext?>">SNMP</a></li>
						</ul>
					</li>
<?php }?>
				</ul>
				<!-- END menu -->
				</div>
				</div>
			</div>
		</div>
		<!-- End Sidemenu -->
		
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
