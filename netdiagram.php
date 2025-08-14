<?php
$redirect=false;
$cleartext=true;
include 'inc.session.php';
?>
<!--doctype html>
<html>
<head>
  <title>Network | Images</title-->

  <style type="text/css">
    #mynetwork {
      width: 100%;
      height: 100%;
	  background-color:#eee;
      border: 1px solid lightgray;
    }
  </style>

  <script type="text/javascript" src="js/vis.js"></script>
  <link href="css/vis.css" rel="stylesheet" type="text/css" />

  <script type="text/javascript">
    var nodes = null;
    var edges = null;
    var network = null;

    var DIR = 'img/';
    var EDGE_LENGTH_MAIN = 150;
    var EDGE_LENGTH_SUB = 50;

    // Called when the Visualization API is loaded.
    function draw() {
      // Create a data table with nodes.
      nodes = [];

      // Create a data table with links.
      edges = [];

      nodes.push({id: 1, label: 'Main', image: DIR + 'network.png', shape: 'image'});
      nodes.push({id: 2, label: 'Office', image: DIR + 'network.png', shape: 'image'});
      nodes.push({id: 3, label: 'Wireless', image: DIR + 'network.png', shape: 'image'});
      edges.push({from: 1, to: 2, length: EDGE_LENGTH_MAIN});
      edges.push({from: 1, to: 3, length: EDGE_LENGTH_MAIN});

      for (var i = 4; i <= 7; i++) {
        nodes.push({id: i, label: 'Computer', image: DIR + 'server.png', shape: 'image'});
        edges.push({from: 2, to: i, length: EDGE_LENGTH_SUB});
      }

      nodes.push({id: 101, label: 'Printer', image: DIR + 'server.png', shape: 'image'});
      edges.push({from: 2, to: 101, length: EDGE_LENGTH_SUB});

      nodes.push({id: 102, label: 'Laptop', image: DIR + 'server.png', shape: 'image'});
      edges.push({from: 3, to: 102, length: EDGE_LENGTH_SUB});

      nodes.push({id: 103, label: 'network drive', image: DIR + 'generic.png', shape: 'image'});
      edges.push({from: 1, to: 103, length: EDGE_LENGTH_SUB});

      nodes.push({id: 104, label: 'Internet', image: DIR + 'generic.png', shape: 'image'});
      edges.push({from: 1, to: 104, length: EDGE_LENGTH_SUB});

      for (var i = 200; i <= 201; i++ ) {
        nodes.push({id: i, label: 'Smartphone', image: DIR + 'server.png', shape: 'image'});
        edges.push({from: 3, to: i, length: EDGE_LENGTH_SUB});
      }
	  
	  var container = document.getElementById('mynetwork');
      var data = {
        nodes: nodes,
        edges: edges
      };
      var options = {interaction:{hover:true}};
      network = new vis.Network(container, data, options);
	  
		
	}

draw();	
</script>

<!--body onload=""-->

<div id="mynetwork"></div>

<!--/body>
</html-->
