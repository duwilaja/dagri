<?php include "inc.header.php"; ?>
		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">OVERVIEW</div>
					<?php if($is_nms){?>
					<div class="menu-item <?php echo $menu == 'home' ? 'active' : ''?>">
						<a href="home<?php echo $ext?>" class="menu-link">
							<span class="menu-icon"><i class="bi bi-cpu"></i></span>
							<span class="menu-text">Monitoring</span>
						</a>
					</div>
					<div class="menu-item <?php echo $menu == 'ncategory' ? 'active' : ''?>">
						<a href="n_category<?php echo $ext?>" class="menu-link">
							<span class="menu-icon"><i class="bi bi-bar-chart-steps"></i></span>
							<span class="menu-text">Category View</span>
						</a>
					</div>
					<div class="menu-item <?php echo $menu == 'org' ? 'active' : ''?>">
						<a href="org<?php echo $ext?>" class="menu-link">
							<span class="menu-icon"><i class="bi bi-bezier"></i></span>
							<span class="menu-text">Business View</span>
						</a>
					</div>
					<div class="menu-item <?php echo $menu == 'topo' ? 'active' : ''?>">
						<a href="topo<?php echo $ext?>" class="menu-link">
							<span class="menu-icon"><i class="bi bi-diagram-2"></i></span>
							<span class="menu-text">Topology View</span>
						</a>
					</div>
					<div class="menu-item <?php echo $menu == 'maps' ? 'active' : ''?>">
						<a href="maps<?php echo $ext?>" class="menu-link">
							<span class="menu-icon"><i class="bi bi-map"></i></span>
							<span class="menu-text">Map View</span>
						</a>
					</div>
					<?php }?>
					<?php if($is_ticket){?>
					<div class="menu-item <?php echo $menu == 'ticks' ? 'active' : ''?>">
						<a href="tick_hom<?php echo $ext?>" class="menu-link">
							<span class="menu-icon"><i class="bi bi-ticket-perforated"></i></span>
							<span class="menu-text">Tickets</span>
						</a>
					</div>
					<div class="menu-item <?php echo $menu == 'tickloc' ? 'active' : ''?>">
						<a href="tick_mapsx<?php echo $ext?>" class="menu-link">
							<span class="menu-icon"><i class="bi bi-pin-map-fill"></i></span>
							<span class="menu-text">Ticket Locations</span>
						</a>
					</div>
					<?php }?>
					<?php if($is_asset){?>
					<div class="menu-item <?php echo $menu == 'ass' ? 'active' : ''?>">
						<a href="ass_hom<?php echo $ext?>" class="menu-link">
							<span class="menu-icon"><i class="bi bi-box-seam"></i></span>
							<span class="menu-text">Asset</span>
						</a>
					</div>
					<div class="menu-item <?php echo $menu == 'asetloc' ? 'active' : ''?>">
						<a href="ass_mapsx<?php echo $ext?>" class="menu-link">
							<span class="menu-icon"><i class="bi bi-pin-map"></i></span>
							<span class="menu-text">Asset Locations</span>
						</a>
					</div>
					<?php }?>
					<?php if($is_nms){?>
					<div class="menu-header">MONITORING</div>
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<div class="menu-icon">
								<i class="bi bi-hdd-rack"></i>
								<!--span class="w-5px h-5px rounded-3 bg-theme position-absolute top-0 end-0 mt-3px me-3px"></span-->
							</div>
							<div class="menu-text d-flex align-items-center">Objects</div> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="n_devicex<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">Devices</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="n_location<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">Locations</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="p_snmpd<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">SNMP</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="p_app<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">Application</div>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon"><i class="bi bi-journals"></i></span>
							<span class="menu-text">Reports</span> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="r_device<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Devices</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="r_location<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Locations</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="r_perf<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Performance</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="r_sla<?php echo $ext?>" class="menu-link">
									<span class="menu-text">SLA</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="r_severity<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Severity</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="r_updown<?php echo $ext?>" class="menu-link">
									<span class="menu-text">UP/Down</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="r_traffic<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Traffic</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon"><i class="bi bi-gear"></i></span>
							<span class="menu-text">Setup</span> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<?php if($s_LVL==0){?>
							<div class="menu-item">
								<a href="m_lov<?php echo $ext?>" class="menu-link">
									<span class="menu-text">LoV</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_user<?php echo $ext?>" class="menu-link">
									<span class="menu-text">User</span>
								</a>
							</div>
							<?php }?>
							<div class="menu-item">
								<a href="m_device<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Devices</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_loc<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Locations</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_topo<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Topology</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_sla<?php echo $ext?>" class="menu-link">
									<span class="menu-text">SLA</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_severity<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Severity</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_events<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Events</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_bg<?php echo $ext?>" class="menu-link">
									<span class="menu-text">Reload Controls</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<div class="menu-icon">
								<i class="bi bi-wrench"></i>
								<!--span class="w-5px h-5px rounded-3 bg-theme position-absolute top-0 end-0 mt-3px me-3px"></span-->
							</div>
							<div class="menu-text d-flex align-items-center">Tools</div> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="t_ping<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">Ping</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="t_trace<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">Trace</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="t_snmp<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">SNMP</div>
								</a>
							</div>
						</div>
					</div>
					<?php }?>
					<?php if($is_ticket){?>
					<div class="menu-header">TICKET</div>
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<div class="menu-icon">
								<i class="bi bi-inboxes"></i>
								<!--span class="w-5px h-5px rounded-3 bg-theme position-absolute top-0 end-0 mt-3px me-3px"></span-->
							</div>
							<div class="menu-text d-flex align-items-center">Master</div> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="m_loc<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">Location</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_serv<?php echo $ext?>" class="menu-link">
									<div class="menu-text">Services</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_ticat<?php echo $ext?>" class="menu-link">
									<div class="menu-text">Category</div>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<div class="menu-icon">
								<i class="bi bi-ticket-perforated"></i>
								<!--span class="w-5px h-5px rounded-3 bg-theme position-absolute top-0 end-0 mt-3px me-3px"></span-->
							</div>
							<div class="menu-text d-flex align-items-center">Tickets</div> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="tickets<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">All</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="tickets<?php echo $ext?>?o=1" class="menu-link">
									<div class="menu-text">Open</div>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<div class="menu-icon">
								<i class="bi bi-journals"></i>
								<!--span class="w-5px h-5px rounded-3 bg-theme position-absolute top-0 end-0 mt-3px me-3px"></span-->
							</div>
							<div class="menu-text d-flex align-items-center">Reports</div> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="r_ticksum<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">Summary</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="r_tick<?php echo $ext?>" class="menu-link">
									<div class="menu-text">Tickets</div>
								</a>
							</div>
						</div>
					</div>
					<?php }?>
					<?php if($is_asset){?>
					<div class="menu-header">ASSET</div>
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<div class="menu-icon">
								<i class="bi bi-inboxes"></i>
								<!--span class="w-5px h-5px rounded-3 bg-theme position-absolute top-0 end-0 mt-3px me-3px"></span-->
							</div>
							<div class="menu-text d-flex align-items-center">Master</div> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="m_loc<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">Location</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_brand<?php echo $ext?>" class="menu-link">
									<div class="menu-text">Brand</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_ascat<?php echo $ext?>" class="menu-link">
									<div class="menu-text">Category</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="m_ass<?php echo $ext?>" class="menu-link">
									<div class="menu-text">Asset</div>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<div class="menu-icon">
								<i class="bi bi-journals"></i>
								<!--span class="w-5px h-5px rounded-3 bg-theme position-absolute top-0 end-0 mt-3px me-3px"></span-->
							</div>
							<div class="menu-text d-flex align-items-center">Reports</div> 
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="r_asssum<?php echo $ext?>"  class="menu-link">
									<div class="menu-text">Summary</div>
								</a>
							</div>
							<div class="menu-item">
								<a href="r_ass<?php echo $ext?>" class="menu-link">
									<div class="menu-text">Asset</div>
								</a>
							</div>
						</div>
					</div>
					<?php }?>
					
				</div>
				<!-- END menu -->
			</div>
			<!-- END scrollbar -->
		</div>
		<!-- END #sidebar -->
			
		<!-- BEGIN mobile-sidebar-backdrop -->
		<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>
		<!-- END mobile-sidebar-backdrop -->