<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-home";
$page_title="Attandance Report";
$modal_title="Title of Modal";
$menu="";

include "inc.db.php";

$conn=connect();
$df=post('df',$conn);
$dt=post('dt',$conn);
$nm=post('nikx',$conn);

$where="1=1";
if($df!='') $where.=" and dt>='$df'";
if($dt!='') $where.=" and dt<='$dt'";
if($nm!='') $where.=" and nama='$nm'";

$sql="select dt,l.nik,nama,edin,reasonin,edout,reasonout,typ,photoin,photoout from hr_attend l left join hr_kary k on k.nik=l.nik where $where order by l.nik,dt";
$recs=fetch_all(exec_qry($conn,$sql));

disconnect($conn);

if(count($recs)<1) die("no data found");

function getphoto($s){
	if(trim($s)!=''){
		return '<img style="height: 200px;width: auto;" src="files/'.$s.'" />';
	}else{
		return '';
	}
}

include "inc.head.php";
//include "inc.menutop.php";
?>
				<div class="app-content page-body">
					<div class="row"><div class="col-12" style="text-align:right;">
					<a href="#" id="btnpdf" onclick="CreatePDFfromHTML();" class="btn" title="PDF" style="border: 1px solid #aaa;"><i class="fa fa-file-pdf-o"></i></a>
					</div></div>

					<div class="container" style="text-align:center" id="prin">
					<div class="row"><div class="col-md-1"><img src="img/telk.png"></div>
					<div class="col-md-10"><h5><?php echo $page_title?></h5>
					<h6><?php echo "$df - $dt"?></h6>
					</div><div class="col-md-1"><img src="img/diknas.png"></div></div>
					<hr />
						<div class="row">
							<div class="col-md-12 col-sm-12">
							<table id="mytbl" class="table table-striped table-bordered w-100">
								<thead>
									<tr>
										<th>Date</th>
										<th>NIK</th>
										<th>Name</th>
										<th>IN</th>
										<th>Remark IN</th>
										<th>OUT</th>
										<th>Remark OUT</th>
										<th>Type</th>
										<th>Photo IN</th>
										<th>Photo OUT</th>
										
									</tr>
								</thead>
								<tbody>
						<?php foreach($recs as $r){?>
									<tr>
										<td><?php echo $r[0]?></td>
										<td><?php echo $r[1]?></td>
										<td><?php echo $r[2]?></td>
										<td><?php echo $r[3]?></td>
										<td><?php echo $r[4]?></td>
										<td><?php echo $r[5]?></td>
										<td><?php echo $r[6]?></td>
										<td><?php echo $r[7]?></td>
										<td><?php echo getphoto($r[8])?></td>
										<td><?php echo getphoto($r[9])?></td>
									</tr>
						<?php }?>
								</tbody>
							</table>
							</div>
						</div>
						&nbsp;
						<hr />
					</div>
				</div><!-- end app-content-->
				
			<!-- Main Content-->
			<div class="main-content side-content pt-0">
<?php 
//include "inc.foot.php";
include "inc.js.php";
?>

<script type="text/javascript" src="vendor/pdf/jspdf.min.js"></script>
<script type="text/javascript" src="vendor/pdf/html2canvas.js"></script>

<script>
$(document).ready(function(){
	page_ready();
})

//Create PDf from HTML...
function CreatePDFfromHTML() {
	
    var HTML_Width = $("#prin").width();
    var HTML_Height = $("#prin").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#prin")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("<?php echo $j?>.pdf");
        //$(".html-content").hide();
    });
}

</script>

  </body>
</html>