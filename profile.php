<!DOCTYPE HTML>
<?php 
include("include/config.php");
ob_start();
session_start();
if(!isset($_SESSION['name'])){
	Header("Location: index.php");
	exit();
}
	$id=$_SESSION['id'];
	if($_POST){
		$mode=$_POST['button'];
		if($mode=="changepass"){
			$old=md5(trim($_POST['oldpassword']));
			$new=md5(trim($_POST['newpassword']));
			$user=$_SESSION['id'];
			$result = mysqli_query($con,"SELECT * FROM users");
			while($row = mysqli_fetch_array($result)) {
				if($row['id'] == $user){
					if($old == $row['password']){
						if($old==$new){
					?><script type="text/javascript">
					alert("It's the same password!");
					window.location.replace("profile.php");
					</script><?php			
						}
					mysqli_query($con,"UPDATE `users` SET `password`='$new' WHERE `id`='$user'");
					?><script type="text/javascript">
					alert("Your password changed successfully");
					window.location.replace("profile.php");
					</script><?php
					}
		else{
				?> <script text="text/javascript">alert("Incorrect password!");</script><?php
			}
	}
}			
		}else{
			//=========================
	$old=trim($_POST['oldmail']);
	$new=trim($_POST['newmail']);
	if($old==$new){
					?><script type="text/javascript">
					alert("It's the same Email!");
					window.location.replace("profile.php");
					</script><?php			
	}
	$emailexist=mysqli_query($con,"SELECT * FROM `users` WHERE `email` = '$new';");
	$emailoldexist=mysqli_query($con,"SELECT * FROM `users` WHERE `email` = '$old' AND `id`='".$id."';");
	if(mysqli_num_rows($emailexist)>=1){
			?><script>alert("The new Email is already exists !");
				window.location.replace("profile.php");
				</script> <?php
		exit();
	}if(mysqli_num_rows($emailoldexist)==0){
			?><script>alert("The old Email is not exists !");
				window.location.replace("profile.php");
				</script> <?php
		exit();		
	}

	
	$slash=" \ ";
	$msg = "You registered successfully in the ".title.".\n your activation link : http://".str_replace(trim($slash) ,"/",$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."activate.php?id=".md5($new);
	$msg = wordwrap($msg,70);
	if(mail($new,"Task Management System Activation mail",$msg)){
	mysqli_query($con,"UPDATE `users` SET `email`='$new', `activated`='0' WHERE `id`='$id'");
	?><script>alert("Changed successfully, Activation mail should be in your inbox (or spam box) now!");location.href = "logout.php";</script> <?php
//===============
			}
			  }
}
	
?><html>
	<head>
		<title><?php print title;?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="Task Management system" />
		<meta name="keywords" content="Task , Manage , Management" />
		<meta type="author" content="Omar Abou Elmagd" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/table.js"></script>
 		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body class="right-sidebar loading">
	<?php include "css/header.php"; ?>
			<article id="main">
				<header class="special container">
					<span class="icon fa-tablet"></span>
					<h2>Profile Management</strong></h2>
					Where you can edit your profile.
				</header>

<div class="wrapper special container" style="margin-left:30%;margin-right:30%; width:40%">
<div style="margin-left:10%;"><a style="border-bottom:0px;" id="an1" onclick="show('#tabs-1','#tabs-2');colors('#an1','#an2');">Change password</a> - 
<a id="an2" onclick="show('#tabs-2','#tabs-1');colors('#an2','#an1');">Change Email</a></div>
<div id="tabs-1">
					<form method="post" action="" id="changepassword">
						<input style="border-bottom:0px;" type="password" required pattern=".{6,15}" title="6 to 15 characters" name="oldpassword" placeholder="Enter the old password">
						<input type="password" style="border-bottom:0px;" required name="newpassword" pattern=".{6,15}" title="6 to 15 characters" placeholder="Enter the new password">
						<button class="button" style="min-width:100%;" type="submit" name="button" value="changepass">Change</button>
					</form>
</div>
<div id="tabs-2" hidden>
					<form method="post" action="" id="changeemail">
						<input style="border-bottom:0px;" type="email" required name="oldmail" placeholder="Enter the old E-mail">
						<input type="email" style="border-bottom:0px;" required name="newmail" placeholder="Enter the new E-mail">
						<button type="submit" class="button" style="min-width:100%;" name="button" value="changemail">Change</button>
					</form>
</div>
</div>

			</article>
			<script>
				function show(x,y){
				$(x).show();
				$(y).hide();
				}
				function colors(active,another){
					$(active).attr('style','border-bottom:0px;');
					$(another).attr('style','border-bottom:1px dotted;');
				}
	//			$(document).ready(function{
//				    $.ajax({ url: 'checktask.php' });
		//		});
			</script>


			<footer id="footer">
				<span class="copyright">&copy; <?php print date("Y",time());?> <a href='about.php'><?php print title;?></a> .<br> All rights reserved. Design: <a href="http://html5up.net">HTML5 UP</a>.</span>
			</footer>
			<?php
			if($_SESSION['name']){
	?><iframe src="tasks.php" style="display:none"></iframe><?php
}
			 ?>
	</body>
</html>