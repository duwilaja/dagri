<?php
$redirect=false;
include "inc.common.php";
include "inc.session.php";
include 'inc.db.php';

//require_once('lib/SubnetCalculator.php');


require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


function sendmail($to,$sub,$bod){
	
	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
		//Server settings
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'mail.netter-universe.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'neo@netter-universe.com';                     //SMTP username
		$mail->Password   = 'Letmein2k22!.';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Recipients
		$mail->setFrom('neo@netter-universe.com', 'NMS');
		//$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
		$tos=explode(";",$to);
		foreach($tos as $t){
			$mail->addAddress($t);               //Name is optional
		}
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = $sub;//'Here is the subject';
		$mail->Body    = $bod;//'This is the HTML message body <b>in bold!</b>';
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		return 'Message has been sent to $tod';
	} catch (Exception $e) {
		return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	
}

function itung($conn,$tik,$dtm){
	$s="";
	$r=fetch_alla(exec_qry($conn,"select * from tick_note where ticketno='$tik' order by dtm,rowid"));
	$new=0; $open=0; $prog=0; $solv=0; $pend=0; $avg=0; $pas=0; $usr='';
	for($i=0;$i<count($r);$i++){
		if($s!=$r[$i]["stts"]){
			switch($s){
				case "": $new+=(strtotime($r[$i]["dtm"])-$dtm); break;
				case "new": $new+=(strtotime($r[$i]["dtm"])-$dtm); break;
				case "open": $open+=(strtotime($r[$i]["dtm"])-$dtm);
						$usr=($usr==''||$usr=='system')?$r[$i]['updby']:$usr; $solv=0;
						break;
				case "progress": $prog+=(strtotime($r[$i]["dtm"])-$dtm);
						$usr=($usr==''||$usr=='system')?$r[$i]['updby']:$usr; $solv=0;
						break;
				case "solved": $solv+=(strtotime($r[$i]["dtm"])-$dtm);
						$usr=($usr==''||$usr=='system')?$r[$i]['updby']:$usr;
						break;
				case "pending": $pend+=(strtotime($r[$i]["dtm"])-$dtm); break;
			}
			$s=$r[$i]["stts"];
			$dtm=strtotime($r[$i]["dtm"]);
		}
		$pas+=($r[$i]["updby"]=='system')?1:0;
		//$avg+=($r[$i]["updby"]!='system'&&$r[$i]["s"]=='progress')?1:0;
	}
	$avg=($avg==0)?0:($prog/$avg);
	$sql="update tick_ets set snew='$new',sopen='$open',sprogress='$prog',ssolved='$solv',spending='$pend' where ticketno='$tik'";
	//echo $sql."<br />";
	$rs=exec_qry($conn,$sql);
	return $sql;
}

$code='404';
$ttl='Error';
$msgs='Action not found';

$conn = connect();

$mn=post('mnu',$conn);

if($mn=='theme'){
	$theme='';
	if(isset($_SESSION['theme'])) $theme=$_SESSION['theme'];
	
	if($theme==''){
		$_SESSION['theme']='dark-theme';
	}else{
		$_SESSION['theme']='';
	}
}
if($mn=='passwd'){
	$opwd=post('op',$conn);
	$npwd=post('np',$conn);
	$sql=sql_update("core_user","","uid='$s_ID' and upwd=md5('$opwd')",$conn,"upwd","md5('$npwd')");
	$rs=exec_qry($conn,$sql);
	if(db_error($conn)==''){
		if(affected_row($conn)>0){
			$code='200'; $ttl='Success'; $msgs='Password changed';
		}else{
			$code='204'; $ttl='Failed'; $msgs='Invalid old password';
		}
	}else{
		$code='201'; $ttl='Error'; $msgs="Error accessing data";
		if(!$production){$msgs.=$sql;}
	}
}
if($mn=='user'){
	if($s_LVL==0){
		$passwd=post('pwd');
		$fcols=$passwd==''?'':'upwd';
		$fvals=$passwd==''?"":"md5('$passwd')";
		$res=crud($conn,$fcols,$fvals);
		$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
	}
}
if($mn=='user_batch'){
	if($s_LVL==0){
		$res=batch_input($conn,"uid");
		$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
		$x=exec_qry($conn,"update core_user set upwd=md5('1') where upwd=''");
	}
}
if($mn=='profile'){
	$up=upload_file("favatar","avatars/",$s_ID);
	$avatar=$up[0]&&$up[1]!=''?$up[1]:'';
	$favatar=$avatar==''?'':'uavatar';
	$res=crud($conn,"$favatar","'$avatar'");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
	if($s_AVATAR==''){
		$_SESSION['s_AVATAR']=$avatar;
	}
}
if($mn=='ravatar'){
	$files=glob("avatars/$s_ID.*");
	if(count($files)>0){
		if(unlink($files[0])){
			$res=array("200","Success","Picture removed");
		}else{
			$res=array("201","Error","Remove picture failed");
		}
	}else{
		$res=array("201","Error","Picture does not exist");
	}
	$_SESSION['s_AVATAR']='';
	$rx=exec_qry($conn,"update core_user set uavatar='' where uid='$s_ID'");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}


if($mn=='mkary'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mkary_batch'){
	$res=batch_input($conn,"nik");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='hrleav'||$mn=='myleav'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='hratt'){
	if(post('typ')=='Masuk'||post('typ')=='Terlambat'){
		$res=crud($conn,"status","'onsite'");
	}else{
		$res=crud($conn,"status","'offduty'");
	}
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='hrrem'||$mn=='myrem'){
	$fname=strtotime("now");
	$upload=upload_file("attc","remattc/",$fname);
	$attc=$upload[0]?$upload[1]:"";
	if($attc==''&&post('fattc')!='') $attc=post('fattc');
	$stts=post('status')==''?'pending':post('status');
	$res=crud($conn,"attc,status","'$attc','$stts'");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='cekin'){
	if(trim($s_NIK)==''){
		$msgs="NIK is blank";
	}else{
		$sql="select * from hr_attend where dt=date(now()) and nik='$s_NIK'";
		$rs=fetch_alla(exec_qry($conn,$sql));
		if(count($rs)>0){
			$sql="update hr_attend set tmin=time(now()),edin=time(now()),status='onsite',typ='Masuk' where tmin='00:00:00' and dt=date(now()) and nik='$s_NIK'";
		}else{
			$sql="insert into hr_attend (nik,dt,tmin,edin,status,typ) values ('$s_NIK',date(now()),time(now()),time(now()),'onsite','Masuk')";
		}
		$rs=exec_qry($conn,$sql);
		if(db_error($conn)==''){
			$code="200"; $ttl="success"; $msgs="Data updated";
		}
	}
}
if($mn=='cekout'){
	if(trim($s_NIK)==''){
		$msgs="NIK is blank";
	}else{
		$sql="select * from hr_attend where dt=date(now()) and nik='$s_NIK'";
		$rs=fetch_alla(exec_qry($conn,$sql));
		if(count($rs)>0){
			$sql="update hr_attend set tmout=time(now()),edout=time(now()),status='onsite',typ='Masuk' where tmout='00:00:00' and tmin<>'00:00:00' and dt=date(now()) and nik='$s_NIK'";
		}else{
			$sql="insert into hr_attend (nik,dt,tmin,edin,status,typ) values ('$s_NIK',date(now()),time(now()),time(now()),'onsite','Masuk')";
		}
		$rs=exec_qry($conn,$sql);
		if(db_error($conn)==''){
			$code="200"; $ttl="success"; $msgs="Data updated";
		}
	}
}

if($mn=='mport'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mportall'){
	$where = "(1=1)";
	$where.=post("host")!=""?" and host like '".post("host")."'":"";
	$where.=post("ifname")!=""?" and ifname like '".post("ifname")."'":"";
	$sql="update core_ports set traffic='".post("traffic")."' where $where";
	$rs=exec_qry($conn,$sql);
	if(db_error($conn)==''){
		$code="200"; $ttl="success"; $msgs="Data updated";
	}else{
		$msgs=db_error($conn);
	}
}
if($mn=='severity'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='sla'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='location'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='location_batch'){
	$res=batch_input($conn,"locid");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='location_ba'){
	$upload=upload_file("bai","bai/");
	$bai=$upload[0]?$upload[1]:"";
	$res=crud($conn,"bai","'$bai'");
	$code=$res[0]; $ttl=$res[1]; $msgs=$bai.$res[2];
}
if($mn=='mbg'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mev'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mdevice'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mdevice_batch'){
	$res=batch_input($conn,"host");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mtopo'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mlov'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mbrand'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mascat'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mass'){
	$upload=upload_file("imgx","assimg/");
	$img1=$upload[0]?$upload[1]:"";
	$img1=$img1==""?post("img1"):$img1;
	$upload=upload_file("imgy","assimg/");
	$img2=$upload[0]?$upload[1]:"";
	$img2=$img2==""?post("img2"):$img2;
	
	$res=crud($conn,"img1,img2","'$img1','$img2'");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mass_batch'){
	$res=batch_input($conn,"assid");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}

if($mn=='mticat'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='mserv'){
	$res=crud($conn);
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='tick'){
	$mmail='';
	
	if(post('sv')=='NEW'){
		$cat=post("cat");
		$fcols='ticketno,creby,updby,created'; $fvals="'$cat".date('YmdHis')."','$s_ID','$s_ID',NOW()";
		$res=crud($conn,"$fcols","$fvals");
	}else{
		if(post('sv')=='UPD'){
			$upload=upload_file("attc","tickattc/");
			$attc=$upload[0]?$upload[1]:"";
			$sq=sql_insert("tick_note","notes,stts,ticketno",$conn,"dtm,updby,attc","NOW(),'$s_ID','$attc'");
			$r=exec_qry($conn,$sq);
		}
		$fcols='updby,updated'; $fvals="'$s_ID',NOW()";
		$res=crud($conn,"$fcols","$fvals");
		if(post('stts')=='closed'){ $x=itung($conn,post('ticketno'),strtotime(post('created'))); }
		if(post('stts')=='pending'){
			$mailto=fetch_alla(exec_qry($conn,"select mailto from core_events where eventid='ticket_pending' and TRIM(mailto)<>''"));
			if(count($mailto)>0){
				$mmail=sendmail($mailto[0]['mailto'],'Notification Pending Ticket# '.post('ticketno'),post('notes'));
			}
		}
	}
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2].'. '.$mmail;
}
if($mn=='rgen'){
	if(post('sv')=='NEW'){
		$res=crud($conn,"job","UNIX_TIMESTAMP()");
	}else{
		$res=crud($conn);
	}
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}


if($mn=='ip'){
	$name=post('name');
	$mask=post('subnet');
	$subs = explode("/",$mask);
	if(count($subs)<2){
		$msgs="Wrong format"; $code="201"; $ttl="Error";
	}else{
		if (filter_var($subs[0], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)&&filter_var($subs[1], FILTER_VALIDATE_INT)) {
			$sub = new IPv4\SubnetCalculator($subs[0],$subs[1]);
			$res = $sub->getSubnetArrayReport();
			$s=$res['ip_address_range'][0]; $e=$res['ip_address_range'][1]; $t=$res['number_of_ip_addresses'];
			$res=crud($conn,"ipstart,ipstop,tot","'$s','$e','$t'");
			$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
			
		}else{
			$msgs="Invalid IP"; $code="202"; $ttl="Error";
		}
	}
}


if($mn=='attachment'){
	$up=upload_file("ffile","uploads/");
	$sv=post('sv');
	$fname=$up[0]&&$up[1]!=''?$up[1]:post('fname');
	if($sv=='NEW'){
		$fname=$up[0]&&$up[1]!=''?$up[1]:'';
	}
	$res=crud($conn,"fname,lastupd,updby","'$fname',now(),'$s_ID'");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}

if($mn=='posting'){
	$paydt=nullpost('paydt');
	$revdt=nullpost('reversedt');
	$res=crud($conn,"paydt,reversedt","$paydt,$revdt");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}
if($mn=='posting_batch'){
	$res=batch_input($conn,"sapdocid","paydt,reversedt,billdt");
	$code=$res[0]; $ttl=$res[1]; $msgs=$res[2];
}


disconnect($conn);

echo json_encode(array('code'=>$code,'ttl'=>$ttl,'msgs'=>$msgs));
?>