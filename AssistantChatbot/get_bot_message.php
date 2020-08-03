<?php
date_default_timezone_set('Asia/Kathmandu');
include('database.inc.php');
$txt=mysqli_real_escape_string($con,$_POST['txt']);
$sql="select reply from chatbotHints where question like '%$txt%'";
$res=mysqli_query($con,$sql);
if(mysqli_num_rows($res)>0){
	$row=mysqli_fetch_assoc($res);
	$html=$row['reply'];
}else{
	$html="Sorry I am not programmed to answer this";
}
$addedon=date('Y-m-d h:i:s');
mysqli_query($con,"insert into message(message,type,addedon) values('$txt','user','$addedon')");
$addedon=date('Y-m-d h:i:s');
mysqli_query($con,"insert into message(message,type,addedon) values('$html','bot','$addedon')");
echo $html;
?>