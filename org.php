<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-home";
$page_title="Organization";
$modal_title="Title of Modal";
$menu="org";

$breadcrumb="Overview/$page_title";

include "inc.head.php";
include "inc.menutop.php";
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

			</div>
			<!--End Page header-->
			
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header hidden">
							<div class="card-title"></div>
							<div class="card-options ">
								<!--a href="#" title="Batch" class=""><i class="fe fe-upload"></i></a--
								<a href="#" onclick="openForm(0);" data-toggle="modal" data-target="#myModal" title="Add" class=""><i class="fe fe-plus"></i></a-->
								<a href="#" title="Refresh" onclick="fitAnimated();"><i class="fe fe-refresh-cw"></i></a>
								<!--a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
								<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
							</div>
						</div>
						<div class="card-body">
							<div class="dimmer active ldr">
								<div class="sk-cube-grid">
									<div class="sk-cube sk-cube1"></div>
									<div class="sk-cube sk-cube2"></div>
									<div class="sk-cube sk-cube3"></div>
									<div class="sk-cube sk-cube4"></div>
									<div class="sk-cube sk-cube5"></div>
									<div class="sk-cube sk-cube6"></div>
									<div class="sk-cube sk-cube7"></div>
									<div class="sk-cube sk-cube8"></div>
									<div class="sk-cube sk-cube9"></div>
								</div>
							</div>
							<section id="visualisation" style="border: 1px black solid; max-width: 100%;"></section>
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</div><!-- end app-content-->
				
<?php 
include "inc.foot.php";
include "inc.js.php";
?>

  <script type="text/javascript" src="js/d3-mitch-tree.min.js"></script>
  <link href="css/d3-mitch-tree.min.css" rel="stylesheet" type="text/css" />
  <link href="css/d3-mitch-tree-theme-default.min.css" rel="stylesheet" type="text/css" />

<script>
var rootid=<?php echo time()?>;
var rootname="Organization";
var roottype="Root";
var rootdesc="NMS";

$(document).ready(function(){
	page_ready();
	get_orgs();
});


function get_orgs(){
	$(".ldr").show();
	$.ajax({
		type: 'POST',
		url: 'dataget'+ext,
		data: {q:'orgs',id:0}, //distinct org
		success: function(data){
			var json = JSON.parse(data);
			if(json['code']=='200'){
				var datax = json['msgs'];
				get_odatas(datax);
			}else{
				log(json['msgs']);
				$(".ldr").hide();
			}
		},
		error: function(xhr){
			log('Please check your connection'+xhr);
			$(".ldr").hide();
		}
	});
}
function get_odatas(grps){
	$.ajax({
		type: 'POST',
		url: 'dataget'+ext,
		data: {q:'odatas',id:0},
		success: function(data){
			var json = JSON.parse(data);
			if(json['code']=='200'){
				var odatas = json['msgs'];
				proses(grps,odatas);
			}else{
				log(json['msgs']);
				$(".ldr").hide();
			}
		},
		error: function(xhr){
			log('Please check your connection'+xhr);
			$(".ldr").hide();
		}
	});
}
function proses(grps,odatas){
	var datas=[{"id":rootid, "name":rootname, "type":roottype, "description":rootdesc}];
	log (grps);
	log (odatas);
	var grpid=rootid;
	for(var i=0;i<grps.length;i++){
		grpid++;
		var grpname=grps[i]['grp'];
		var dat={"id":grpid, "parentId": rootid, "name":grpname, "type":"Group", "description":"Group "+grpname};
		datas.push(dat);
		for(var j=0;j<odatas.length;j++){
			var odat=odatas[j];
			if(odat['grp']==grpname){
				var datx={"id":odat['rowid'], "parentId": grpid, "name":odat['host'], "type":"Node", "description":odat['name']};
				datas.push(datx);
			}
		}
	}
	//log(datas);
	$(".ldr").hide();
	draw(datas);
}
function draw(data){
	var treePlugin = new d3.mitchTree.boxedTree()
		.setIsFlatData(true)
		.setData(data)
		.setElement(document.getElementById("visualisation"))
		.setIdAccessor(function(data) {
			return data.id;
		})
		//.setChildrenAccessor(function(data) {
		//	return data.children;
		//})
		.setParentIdAccessor(function(data) {
			return data.parentId;
		})
		.setBodyDisplayTextAccessor(function(data) {
			return data.description;
		})
		.setTitleDisplayTextAccessor(function(data) {
			return data.name;
		})
		.getNodeSettings()
		.setSizingMode('nodesize')
		.setVerticalSpacing(10)				
		.setHorizontalSpacing(25)
		.back()
		.on("nodeClick",function(event){
			//log(event);
			if(event.data.type=='Node'){
				window.open("device<?php echo $ext;?>?h="+event.data.name,"ToolsWindow","width=700,height=450,location=no,scrollbars=yes");
			}
		})
		.initialize();
		
	/* Alternative Options Object Syntax, opposed to the Fluent Interface Above
		var options = {
			data: data,
			element: document.getElementById("visualisation"),
			getId: function (data) {
				return data.id;
			},
			getChildren: function (data) {
				return data.children;
			},
			getBodyDisplayText: function (data) {
				return data.description;
			},
			getTitleDisplayText: function (data) {
				return data.name;
			}
		};
		var treePlugin = new d3.MitchTree.BoxedTree(options).initialize();
	*/
}
</script>

  </body>
</html>