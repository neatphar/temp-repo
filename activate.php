<?php
if($_GET!=true){
	header("Location:index.php");
}
else{
	$reduct=false;
	include("include/config.php");
	$resut=mysqli_query($con,"SELECT * FROM `users`");
	while($row=mysqli_fetch_array($resut)){
		if(md5($row['email'])==$_GET['id']){
			if($row['activated']=="1"){
					?><script>alert("Already activated.");
						location.href = "index.php";
						</script><?php
			$reduct=true;
			break;
			}
			mysqli_query($con,"UPDATE `users` SET `activated`='1' WHERE `id`='".$row['id']."'");
				session_start();
				session_regenerate_id();
				$_SESSION['name']=$row['username'];
				$_SESSION['password']=$row['password'];
				$_SESSION['admin']=$row['isAdmin'];
				$_SESSION['id']=$row['id'];
				session_write_close();
			?><script>alert("Activated Successfully (redirect).");location.href = "index.php";</script><?php
			$reduct=true;
		
		}
	}
	if($reduct==false){
	?><script>alert("Wrong Activation ID.");location.href = "index.php";</script><?php

}
	
}
?>