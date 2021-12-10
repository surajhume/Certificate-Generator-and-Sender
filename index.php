<?php
 use PHPMAILER\PHPMAILER\PHPMailer;
 use PHPMAILER\PHPMAILER\Exception;
 use PHPMAILER\PHPMAILER\SMTP;
$con=mysqli_connect("localhost","root","","certificategendb");
$res=mysqli_query($con,"select * from studentlist where status=0 limit 1");
$count = 0;   // count for number of success mail sent
if(mysqli_num_rows($res)>0){
	// header('content-type:image/jpeg');
	
	while($row=mysqli_fetch_assoc($res)){
        $font="AGENCYR.TTF";
	    $image=imagecreatefromjpeg("certificate.jpg");
	    $color=imagecolorallocate($image,19,21,22);
		$name=$row['name'];
        $email=$row['email'];
		imagettftext($image,35,0,450,350,$color,$font,$name);
		$file=time().'_'.$row['sr'];
        $file_path="certificate/".$file.".jpg";
	    $file_path_pdf="certificate/".$file.".pdf";
        imagejpeg($image,$file_path);

        require_once('fpdf.php');
       $pdf=new FPDF();
	   $pdf->AddPage();
	   $pdf->Image($file_path,0,0,210,150);
	   $pdf->Output($file_path_pdf,"F");

       imagedestroy($image);
	  
       require_once ('PHPMAILER/Exception.php');
       require_once ('PHPMAILER/PHPMailer.php');
	   require_once ('PHPMAILER/SMTP.php');

	$mail=new PHPMailer();
	$mail->isSMTP();
	$mail->Host='smtp.gmail.com';
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="EMAIL_HERE";
	$mail->Password="PASSWORD_HERE";
	$mail->setFrom("EMAIL_HERE");
	$mail->addAddress($email);
	$mail->isHTML(true);
	$mail->Subject="Certificate of Webinar for " .$name. "";
	$mail->Body="Thanks for joining webinar. Here is your certificate!";
	$mail->addAttachment($file_path_pdf);
	$mail->SMTPOptions=array("ssl"=>array(
		"verify_peer"=>false,
		"verify_peer_name"=>false,
		"allow_self_signed"=>false,
	));
	if($mail->send()){
		$count = $count + 1;
		echo "Send";
	}else{
		echo $mail->ErrorInfo;
	}

		mysqli_query($con,"update studentlist set status=1 where sr='".$row['sr']."'");
		$res=mysqli_query($con,"select * from studentlist where status=0 limit 1");
	}
}
echo $count;
?>