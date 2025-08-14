<?php
$redirect=false;
$cleartext=true;

include "inc.common.php";
include "inc.session.php";
include "inc.db.php";

$conn=connect();

$whr=($s_GRP=='')?"1=1":"(grp='$s_GRP')";

$rs=exec_qry($conn,"select if(prov='' or prov is null,'Undefined',prov) as prv, count(host) as cnt from core_node n left join core_location l on n.loc=l.locid where $whr group by prv order by prv");
$lists=fetch_all($rs);

disconnect($conn);
for($i=0;$i<count($lists);$i++){
?>
<tr class="border-bottom">
	<td class="p-2"><i class="flag flag-id mt-2 mr-2"></i><?php echo $lists[$i][0]?></td>
	<td class="p-2 pb-0 pt-3 text-right"><?php echo $lists[$i][1]?></td>
</tr>
<?php
}
?>
<script>
var dataku=<?php  echo json_encode($lists)?>;
function randomColor(){
	return "#"+(Math.random().toString(16)+"000000").slice(2, 8).toUpperCase();
}
//pie_chart("pie-loc",dataku);

var datas=[];
var label=[];
var color=[];
var col=randomColor();

for(var i=0;i<dataku.length;i++){
	datas.push(dataku[i][1]);
	label.push(dataku[i][0]);
	color.push(col);
}

var data = {
  labels: label,
  datasets: [{
    axis: 'y',
	label: 'Total Device',
    data: datas,
    backgroundColor: color,
    borderWidth: 1
  }]
};

const config = {
  type: 'bar',
  data: data,
  options: {
	indexAxis: 'y'
  },
};

function bar(){
const ctx = document.getElementById('pie-loc').getContext('2d');
const cart = new Chart(ctx, config);
}

bar();

function pie_chart(canvas,data,colors=[]){
	//-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var datas=[];
  var labels=[];
  if(colors.length==0){
	  for(var i=0;i<data.length;i++){
		  colors.push(randomColor());
		  labels.push(data[i][0]);
		  datas.push(data[i][1]);
	  }
  }
  
    var pieChartCanvas = document.getElementById(canvas).getContext('2d');
    var pieData        = {
      labels: labels,/*[
          'Chrome', 
          'IE',
          'FireFox', 
          'Safari', 
      ],*/
      datasets: [
        {
          data: datas,//[700,500,400,600,300,100],
          backgroundColor : colors,//['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var pieOptions = {
		
	};
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: "pie",
      data: pieData,
      options: pieOptions
    })

  //-----------------
  //- END PIE CHART -
  //-----------------
  
  return pieChart;
}
</script>