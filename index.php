<!DOCTYPE HTML>
<?php 
include("include/config.php");
ob_start();
session_start();
?>
<html>
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
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>			<link rel="stylesheet" href="css/login.css" />

		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body class="index loading">
	<div onclick='javascript:Hide();' hidden style="background-color:#000000 ;position :fixed; width:100%; height:100%;margin:0px 0px 0px 0px;opacity: 0.6;filter: alpha(opacity=60);z-index: 9999999;overflow:hidden" id="vbackv"></div>
	<div hidden style="position :fixed;top:50%;left:50%;  margin-top: -10%;  margin-left: -20%; border: 1px solid #ccc;border-radius: 4px;box-shadow: 0 1px 3px #ddd inset;box-sizing: border-box;padding: 0.5em 0.6em;width: 40%;height:40%;background:#eee;color:#777;border-color:#ccc ;z-index: 99999999999;overflow:auto;" id="resetpassword">
		<img src='images/close.png' width=16 height=16 style='background-color:#EEEEEE;position:fixed;margin-left:37.5%; margin-top:-.42%;z-index:9879854986;' onclick='javascript:Hide();' title='Close'></img>
		<iframe width="100%" height="100%" style="background: #EEEEEE" id="resetpassframe" src="resetpass.php"></iframe>
	</div>

			<header id="header" class="alt reveal">
				<h3 id="logo"><a style="font-weight: bold;" href="index.php"><span>Task Management software</span> <a style="font-size:12px">by omareco14</a></a></h3>
				<nav id="nav">
					<ul>
						<?php if(isset($_SESSION['name'])){
								?>
						<li class="current"><a href="index.php">Welcome <?php print $_SESSION['name'];?></a></li>
							<li class="submenu">
							<a href="">Account</a>
							<ul>
								<li><a href="tasks.php">Manage tasks</a></li>
								<li><a href="profile.php">Edit profile</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
						<?php } else{ ?>
						<li class="current"><a href="index.html">Welcome</a></li>
						<li><a href="" id="toggle-login">Login</a></li>
						<li><a href="" id="toggle-register">Signup</a></li><?php }?>
						<li><a href="about.php">About us</a></li>
<div id="login" hidden>
 <div id="triangle"></div>
  <h1>Login</h1>
  <form id="loginform" action='' method="POST">
    <input type="text" name="username" placeholder="Username or Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input name="type" value="login"  style="display:none">
    <input type="submit" value="Login">
    <a onclick='$("#vbackv").show();$("#resetpassword").show();'>Forgot your password?</a>
  </form>
</div>
<script>
	function Hide(){
		document.getElementById('resetpassword').style.display = "none";
		document.getElementById('vbackv').style.display = "none";
	}

	$(document).ready(function(){
	$(document).keypress(function(e) {if(e.which == 27 || e.keyCode == 27) {Hide();}});
});
</script>
<div id="register" hidden>
 <div id="triange"></div>
  <h1>Signup</h1>
  <form id="registerform" action='' method="POST">
    <input type="text" name="username" placeholder="Username" pattern=".{4,15}" maxlength="15" title="4 to 15 characters" required>
    <input type="password" name="password" placeholder="Password" required pattern=".{6,15}" title="6 to 15 characters">
    <input type="email" name="email" placeholder="Email" required>
    <input name="type" value="register" style="display:none">
    <input type="submit" value="Signup">
  </form>
</div>
					</ul>
				</nav>
			</header>
			<section id="banner">
				<div class="inner">
	
					<header>
						<h2>Task Management</h2>
					</header>
					<p>this website built for students and teacher to manage their<br>
					assignment easily or assigned task easily. User can create task,<br>
					manage their task etc from this online task management system.</p>
					<footer>
						<ul class="buttons vertical">
							<li><a href="#main" class="button fit scrolly">Tell Me More</a></li>
						</ul>
					</footer>
				
				</div>
				
			</section>
			<article id="main">

				<header class="special container">
					<span class="icon fa-bar-chart-o"></span>
					<h2>Some desciption about the site.</h2>
					<p>
						<strong>Task management</strong> is the process of managing a task through its life cycle. It involves planning, testing, tracking and reporting. Task management can help either individuals achieve goals, or groups of individuals collaborate and share knowledge for the accomplishment of collective goals. Tasks are also differentiated by complexity, from low to high.
						Effective task management requires managing all aspects of a task, including its status, priority, time, human and financial resources assignments, recurrency, notifications and so on. These can be lumped together broadly into the basic activities of task management.
						Managing multiple individual or team tasks may require specialised software, for example workflow or project management software. In fact, many people believe that task management should serve as a foundation for project management activities.
						Task management may form part of project management and process management and can serve as the foundation for efficient workflow in an organisation. Project managers adhering to task-oriented management have a detailed and up-to-date project schedule, and are usually good at directing team members and moving the project forward.
						<br><strong>See more about our site's system in <a href="http://en.wikipedia.org/wiki/Task_management"  target="_blank">Wikipedia</a></strong></p>
				</header>
					
				<!-- One -->
					<section class="wrapper style2 container special-alt">
						<div class="row half">
							<div class="8u">
						<?php if(!isset($_SESSION['name'])){
								?>
								<header>
								<h2><strong>Who are we ?</strong></h2>
								</header>
								<p>We are Developers.</p>
								<header>
								<h2><strong>What we do ?</strong></h2>
								</header>
								<p>We make Websites.</p>
								<h2><strong>What we want ?</strong></h2>
								</header>
								<p>We want Money.</p>
								<h2><strong>When we want it ?</strong></h2>
								</header>
								<p>We want it NOW!</p>
								<footer>									<ul class="buttons">
										<li><a href="about.php" class="button">Find Out More</a></li>
									</ul>
								</footer>
								<?php } else{?> 
								<header>
									<h2><strong>Tasks List</strong></h2>
								</header>
								<p>
								<?php
								
								$id=$_SESSION['id'];
								$result=mysqli_query($con,"SELECT * FROM `tasks` WHERE `userid`=$id ORDER BY `done` ASC ,`time` ASC");
								if(mysqli_num_rows($result)==0){
									echo "You have no tasks";
								}else{
								while($row=mysqli_fetch_array($result)){
								echo "- ".$row['title']."<br>";
								}}
								?>
	
									
								</p>
								<footer>
									<ul class="buttons">
										<li><a href="tasks.php" class="button">Tasks Management</a></li>
									</ul>
								</footer>
									<?php } ?>
							
							</div>
							<div class="4u skel-cell-important">
							
								<ul class="feature-icons">
									<li><span class="icon fa-clock-o"><span class="label"></span></span></li>
									<li><span class="icon fa-volume-up"><span class="label"></span></span></li>
									<li><span class="icon fa-laptop"><span class="label"></span></span></li>
									<li><span class="icon fa-inbox"><span class="label"></span></span></li>
									<li><span class="icon fa-lock"><span class="label"></span></span></li>
									<li><span class="icon fa-cog"><span class="label"></span></span></li>
								</ul>
							
							</div>				
						</div>
					</section>

				</article>
			<footer id="footer">
				<span class="copyright">&copy; <?php print date("Y",time());?> <a href='about.php'><?php print title;?></a> .<br> All rights reserved. Design: <a href="http://html5up.net">HTML5 UP</a>.</span>
			</footer>
    		<script src="js/login.js"></script>
</body>
</html>
<?php 
if($_POST==true){
	$user=trim($_POST['username']);
	$pass=md5(trim($_POST['password']));
	$email=trim($_POST['email']);
	
	if($_POST['type']=="login"){
	$resultuser=mysqli_query($con,"SELECT * FROM `users` WHERE `username` = '$user' AND `password` = '$pass';");
	$resultemail=mysqli_query($con,"SELECT * FROM `users` WHERE `email` = '$user' AND `password` = '$pass';");
	if(mysqli_num_rows($resultuser)==0){if(mysqli_num_rows($resultemail)==0){
		?><script>alert("Wrong username or password !");</script> <?php
		exit();}}
	$arruser=mysqli_fetch_array($resultuser);
	$arremail=mysqli_fetch_array($resultemail);
	$suser = isset($arruser['username']) ? $arruser['username'] : $arremail['username'];
	$spass = isset($arruser['password']) ? $arruser['password'] : $arremail['password'];
	$sid = isset($arruser['id']) ? $arruser['id'] : $arremail['id'];
	$sadmin = isset($arruser['isAdmin']) ? $arruser['isAdmin'] : $arremail['isAdmin'];
	$activated = isset($arruser['activated']) ? $arruser['activated'] : $arremail['activated'];
		if($activated=="0"){
		?><script>alert("Your account is not activated. Please activate your account !");</script> <?php
		exit();}
	session_regenerate_id();
	$_SESSION['name']=$suser;
	$_SESSION['password']=$spass;
	$_SESSION['admin']=$sadmin;
	$_SESSION['id']=$sid;
	session_write_close();
	header("Location: index.php");
	}else if($_POST['type']=="register"){
	$userexist=mysqli_query($con,"SELECT * FROM `users` WHERE `username` = '$user';");
	$emailexist=mysqli_query($con,"SELECT * FROM `users` WHERE `email` = '$email';");
	if(mysqli_num_rows($userexist)>=1){
			?><script>alert("Username is already exists !");</script> <?php
		exit();
	}
	if(mysqli_num_rows($emailexist)>=1){
			?><script>alert("Email is already exists !");</script> <?php
		exit();
	}
	$gener=mysqli_query($con,"SELECT * FROM `users` ORDER BY `id` DESC LIMIT 1");
	$gener=mysqli_fetch_array($gener);
	$id=$gener['id']+1;
	$slash=" \ ";
	$msg = "You registered successfully in the ".title.".\n your activation link : http://".str_replace(trim($slash) ,"/",$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."activate.php?id=".md5($email);
 	$msg = wordwrap($msg,70);
	if(mail($email,"Task Management System Activation mail",$msg)){
	mysqli_query($con,"INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES ('$id', '$user', '$pass', '$email'); ");
	?><script>alert("Registered successfully, Activation mail should be in your inbox (or spam box) now!");location.href = "index.php";</script> <?php

}}
else{
	?><script>alert("There's an error!");location.href = "index.php";</script> <?php
}
}
if(isset($_SESSION['name'])){
	?><iframe src="tasks.php" style="display:none"></iframe><?php
}
?>
