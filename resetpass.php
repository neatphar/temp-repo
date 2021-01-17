<?php
if($_POST==true){
	include "include/config.php";
	$email=$_POST['email'];
	$emailexist=mysqli_query($con,"SELECT * FROM `users` WHERE `email` = '$email';");
	if(mysqli_num_rows($emailexist)==0){
			?><script>alert("Email is not exists !");
				window.location.replace("resetpass.php");
				</script> <?php
		exit();
	}
	$emailexist=mysqli_fetch_array($emailexist);
	$pass=$emailexist['email'];
	$slash=" \ ";
	$msg = "You requested a password recovery ".title.".\n your password recovery link : http://".str_replace(trim($slash) ,"/",$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."reset.php?id=".md5($pass);
 	$msg = wordwrap($msg,70);
	if(mail($email,"Task Management System Recovery password mail",$msg)){
	mysqli_query($con,"UPDATE `users` SET `recoverpass` = '1' WHERE `email`='$email'");
	?><script>alert("Password recovery mail should be in your inbox (or spam box) now!");parent.Hide();</script> <?php
	
}
}
?>
<html style="background: #EEEEEE">
	<script>
function inIframe () {
try {return window.self !== window.top;
} catch (e) {return true;}}
if(inIframe()==false){window.location.href="index.php";}
</script>
	<head>
		<link rel="stylesheet" href="css/style.css" />
		</head>
<div style="background: #EEEEEE">
	<br>
		<form method="post" action=""><input style="background: #EEEEEE;border-bottom: 0px;" type="email" required name="email" placeholder="Your E-mail">
		<button class="button" style="background:#EEEEEE;min-width:100%;" type="submit" name="button" value="resetpassword">Go</button>
		</form>
</div>
</html>
