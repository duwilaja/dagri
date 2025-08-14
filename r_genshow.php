<?php 
include "inc.common.php";
include "inc.session.php";

$page_icon="fa fa-home";
$page_title="Report";
$modal_title="Title of Modal";
$menu="";

include "inc.db.php";

$conn=connect();
$j=get('j',$conn);
$sql="select  * from core_bgrpt where job='$j'";
$rpt=fetch_alla(exec_qry($conn,$sql));
$sql="select  * from core_bgrptjob where job='$j'";
$recs=fetch_alla(exec_qry($conn,$sql));
disconnect($conn);

if(count($rpt)<1 && count($recs)<1) die("no data found");
 
include "inc.head.php";
//include "inc.menutop.php";

$img_ext=($rpt[0]['rpt']=='ping')?".png":$trf_img;
?>
				<div class="app-content page-body">
					<div class="row"><div class="col-12" style="text-align:right;">
					<a href="#" id="btnpdf" onclick="CreatePDFfromHTML();" class="btn" title="PDF" style="border: 1px solid #aaa;"><i class="fa fa-file-pdf-o"></i></a>
					</div></div>

					<div class="container" style="text-align:center" id="prin">
					<div class="row"><div class="col-md-1"><img src="img/telk.png"></div>
					<div class="col-md-10"><h5><?php echo $rpt[0]['ttl']?></h5>
					<h6><?php echo str_ireplace("\n","<br />",$rpt[0]['dscr'])?></h6>
					</div><div class="col-md-1"><img src="img/diknas.png"></div></div>
					<hr />
						<div class="row">
						<?php foreach($recs as $r){?>
							<div class="col-md-12 col-sm-12">
							<br />
							<?php echo $r['host']?> - <?php echo $r['nm']?> / <?php echo $rpt[0]['dtf']?> to <?php echo $rpt[0]['dtt']?><br />
							<img style="width:100%" src="<?php echo $rpt_dir.$r['job'].'/'.$r['host'].$img_ext?>" />
							</div>
						<?php }?>
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