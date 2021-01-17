<?php 
include "include/config.php";
if($_POST){
	$newpass=md5(trim($_POST['newpassword']));
	$id=$_POST['id'];
	mysqli_query($con,"UPDATE `users` SET `password` = '$newpass',`recoverpass`='0' WHERE `id`='$id'");
	?><script>alert("Changed Successfully!");window.location.replace("index.php");</script><?php
}
if(!$_GET){
	header("Location: index.php");
}else{
$memail=$_GET['id'];
$result=mysqli_query($con,"SELECT * FROM `users` WHERE `recoverpass`='1'");
if(mysqli_num_rows($result)==0){
	?><script>alert("There's no active recovery password operations!");window.location.replace("index.php");</script><?php
exit();
}
	$exists = false;
	while($row=mysqli_fetch_array($result)){
		if(md5($row['email'])==$memail){
			?>
			<html>
			<head>
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
</head>
<form class="pure-form" action="" method="post">
    <fieldset style="margin:1%;">
		    <input type="password" name="newpassword" placeholder="Enter the new password" required pattern=".{6,15}" title="6 to 15 characters">
 			 <input name="id" hidden value="<?php print $row['id'];?>">
        <button type="submit" class="pure-button pure-button-primary">Change</button>
    </fieldset>
</form>
</html>
			 <?php
			$exists = true;
		}
	}
	if($exists==false){
		?><script>alert("That password recovery link doesn't exists!");window.location.replace("index.php");</script><?php
exit();	
	}
}
?>
