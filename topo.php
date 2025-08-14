<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-home";
$page_title="Topology";
$modal_title="Title of Modal";
$menu="topo";

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
						<div class="card-header">
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
							<div id="hasil" class="hasil" style="height:400px;">
							
							</div>
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

  <script type="text/javascript" src="js/vis.js"></script>
  <link href="css/vis.css" rel="stylesheet" type="text/css" />

<script>
var nodes, edges, network;

$(document).ready(function(){
	page_ready();
	
	//goku();
	
	//get_content('netdiagram'+ext,{},'.ldr','.hasil');
	nodes=[];
	edges=[];
	network=null;
	get_nodes();
});


function get_nodes(){
	$(".ldr").show();
	$.ajax({
		type: 'POST',
		url: 'dataget'+ext,
		data: {q:'nodes',id:0},
		success: function(data){
			var json = JSON.parse(data);
			if(json['code']=='200'){
				nodes = json['msgs'];
				for(var i=0;i<nodes.length;i++){
					nodes[i]['font']={color:nodes[i]['fc']};
				}
				get_edges();
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
function get_edges(){
	$.ajax({
		type: 'POST',
		url: 'dataget'+ext,
		data: {q:'edges',id:0},
		success: function(data){
			var json = JSON.parse(data);
			if(json['code']=='200'){
				edges = json['msgs'];
			}else{
				log(json['msgs']);
			}
			$(".ldr").hide();
			draw();
		},
		error: function(xhr){
			log('Please check your connection'+xhr);
			$(".ldr").hide();
		}
	});
}
function fitAnimated() {
	var options = {
	  offset: { x: 0, y: 0 },
	  duration: 1000,
	  easingFunction: "easeInOutQuad",
	};
	if(network!=null) network.fit({ animation: options });
}
function getHost(id){
	var h="";
	for(var  i=0; i<nodes.length; i++){
		if(nodes[i]['id']==id){
			h=nodes[i]['label']; break;
		}
	}
	return h;
}
function draw(){
	var container = document.getElementById('hasil');
      var data = {
        nodes: nodes,
        edges: edges
      };
      var options = {interaction:{hover:true}, nodes:{font:{color: "#ababab"}}, edges:{color: "#ababab"}};
      network = new vis.Network(container, data, options);
	  network.on("click", function (params) {
			//params.event = "[original event]";
			//alert(params["nodes"]);
			//document.getElementById('eventSpan').innerHTML = '<h2>Click event:</h2>' + JSON.stringify(params, null, 4);
			//window.open("toolss<?php echo '';?>?id="+params["nodes"],"ToolsWindow","width=700,height=450,location=no,scrollbars=yes");
			window.open("device<?php echo $ext;?>?h="+getHost(params["nodes"]),"ToolsWindow","width=700,height=450,location=no,scrollbars=yes");
			var nodeId = params["nodes"];
			var coptions = {
			  // position: {x:positionx,y:positiony}, // this is not relevant when focusing on nodes
			  scale: 1,
			  offset: { x: 0, y: 0 },
			  animation: {
				duration: 1000,
				easingFunction: "easeInOutQuad",
			  },
			};
			network.focus(nodeId, coptions);
		});
//	  network.moveTo({scale: 0.5});
}
</script>

  </body>
</html>