<?php 
require('connection.inc.php');
require('functions.inc.php');

$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$mobile=get_safe_value($con,$_POST['mobile']);
$password=get_safe_value($con,$_POST['password']);

$checkUser=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));
if($checkUser>0){
    echo "emailPresent";
}else{
    $addedOn=date('Y-m-d h:i:s');
    mysqli_query($con,"insert into users(name,email,mobile,password,addedOn) values('$name','$email','$mobile','$password','$addedOn')");
    echo "insert";
}
?>