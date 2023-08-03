<?php
include('database.inc1.php');
$msg="";
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile'])  && isset($_POST['date'])  && isset($_POST['time'])  && isset($_POST['people']) && isset($_POST['comment'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	$date=mysqli_real_escape_string($con,$_POST['date']);
	$time=mysqli_real_escape_string($con,$_POST['time']);
	$people=mysqli_real_escape_string($con,$_POST['people']);
	$comment=mysqli_real_escape_string($con,$_POST['comment']);
	
	mysqli_query($con,"insert into contact_us(name,email,mobile,date,time,people,comment)
	 values('$name','$email','$mobile','$date','$time','$people','$comment')");
	$msg="Thanks message";
	
	$html="<table>
	<tr>
	<td>
	Name
	</td>
	<td>$name</td>
	</tr>

	<tr><td>Email</td><td>$email</td></tr>
	<tr><td>Mobile</td><td>$mobile</td></tr>
	<tr><td>Date</td><td>$date</td></tr>
	<tr><td>Time</td><td>$time</td></tr>
	<tr><td>People</td><td>$people</td></tr>
	<tr><td>Comment</td><td>$comment</td></tr>
	</table>";
	
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tsl";
	$mail->SMTPAuth=true;
	$mail->Username="nishabhardwaj0709@gmail.com";
	$mail->Password="xuseeqzowkkacoia";
	$mail->SetFrom("nishabhardwaj0709@gmail.com");
	$mail->addAddress("nishabhardwaj0709@gmail.com");
	$mail->IsHTML(true);
	$mail->Subject="New Contact Us";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		//echo "Mail send";
	}else{
		//echo "Error occur";
	}
	echo $msg;
}
?>