<?php
session_start();
include_once("../dashboard/init.php");
if (isset($_POST["submit"])) {
$to =$_POST["email"];
$subject = 'password reset';
$message = 'hello'.$to.'click here to reset you password'; 
$from = 'peterparker@email.com';
$query="select password from user where id='98'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){
	$row=mysqli_fetch_assoc($result);
		$pass=$row['password'];

$link="<a href='http://localhost/willie_online_supermarket/auth/forgot password.php?key=".$to."&reset=".$pass."'>Click To Reset password</a>";
 
// Sending email
// if(mail($to, $subject, $message)){
//     echo 'Your mail has been sent successfull to'.$to.'<br>'.'click here'.$link;
// } else{
//     echo 'Unable to send email. Please try again.';
// }
// 	}

?>