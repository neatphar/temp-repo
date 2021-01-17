<!DOCTYPE HTML>
<?php 
include("include/config.php");
ob_start();
session_start();
if(!isset($_SESSION['name'])){
	Header("Location: index.php");
	exit();
}
if($_POST==true){
	$mode=$_POST['button'];
	
	if ($mode=="addingone"){
	$tasktitle=$_POST['tasktitle'];
	$taskdesc=nl2br($_POST['taskdesc']);
	$taskpro=$_POST['taskpro'];
	$timeset=$_POST['year']."-".$_POST['month']."-".$_POST['day']." ".$_POST['hour'].":".$_POST['minute'].":00";
	$gener=mysqli_query($con,"SELECT * FROM `tasks` ORDER BY `taskid` DESC LIMIT 1");
	$gener=mysqli_fetch_array($gener);
	$newtaskid=$gener['taskid']+1;
	$userid=$_SESSION['id'];
	mysqli_query($con,"INSERT INTO `tasks`(`userid`, `taskid`, `title`, `desc`, `time`, `pr`, `done`) VALUES ('$userid','$newtaskid','$tasktitle','$taskdesc','$timeset','$taskpro',0)");
	header("Location: ");
	}
	else if($mode=="delete"){
	$mytaskid=$_POST['taskid'];
	$result=mysqli_query($con,"DELETE FROM `tasks` WHERE `taskid`=$mytaskid");
	header("Location: ");		
	}
	else if($mode=="done"){
	$mytaskid=$_POST['taskid'];
	$result=mysqli_query($con,"UPDATE `tasks` SET `done`='1' WHERE `taskid`=$mytaskid");
	header("Location: ");
	}
	else if($mode=="undone"){
	$mytaskid=$_POST['taskid'];
	$result=mysqli_query($con,"UPDATE `tasks` SET `done`='0' WHERE `taskid`='$mytaskid'");
	header("Location: ");
	}
}

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
	<div hidden style="position :fixed;top:50%;left:50%;  margin-top: -10%;  margin-left: -20%; border: 1px solid #ccc;border-radius: 4px;box-shadow: 0 1px 3px #ddd inset;box-sizing: border-box;padding: 0.5em 0.6em;width: 40%;height:40%;background:#eee;color:#777;border-color:#ccc ;z-index: 99999999999;overflow:auto;" id="showmore"></div>
	<div hidden style="position :fixed;top:50%;left:50%;  margin-top: -10%;  margin-left: -20%; border: 1px solid #ccc;border-radius: 4px;box-shadow: 0 1px 3px #ddd inset;box-sizing: border-box;padding: 0.5em 0.6em;width: 40%;height:40%;background:#eee;color:#777;border-color:#ccc ;z-index: 99999999999;overflow:auto;" id="editone">
		<img src='images/close.png' width=16 height=16 style='background-color:#EEEEEE;position:fixed;margin-left:37.5%; margin-top:-.42%;z-index:9879854986;' onclick='javascript:Hide();' title='Close'></img>
		<input type="text" id="editedtask" style="display: none">
		<iframe width="100%" height="100%" id="editframetask" src="edittask.php"></iframe>
		<script>$("#editframetask").attr("src","edittask.php?taskid="+$("#editedtask").value);</script>
	</div>
	<div hidden style="position :fixed;top:50%;left:50%;  margin-top: -10%;  margin-left: -20%; border: 1px solid #ccc;border-radius: 4px;box-shadow: 0 1px 3px #ddd inset;box-sizing: border-box;padding: 0.5em 0.6em;width: 40%;height:40%;background:#eee;color:#777;border-color:#ccc ;z-index: 99999999999;overflow:auto;" id="addnewone">
		<img src='images/close.png' width=16 height=16 style='background-color:#EEEEEE;position:fixed;margin-left:37.5%; margin-top:-.42%;z-index:9879854986;' onclick='javascript:Hide();' title='Close'></img>
		<form method="post" >
			<input type="text" name="tasktitle" maxlength="100" placeholder="The task title" title="8~100 characters" required pattern=".{8,100}">	
		<textarea type="text" name="taskdesc" placeholder="The task description (optional)" style="resize: none; height:80px;"></textarea>
		<label for="taskpro">The task priority :</label>
		<select name="taskpro">	
			<option value="Very high">Very high</option>
			<option value="High">High</option>
			<option value="Normal" selected="true">Normal</option>
			<option value="Low">Low</option>
			<option value="Very low">Very low</option>
		</select><br>
		Task will be at : <select id="year" name="year" title="Year"></select>-<select id="month" title="Month" name="month"></select>-<select title="Day" id="day" name="day"></select>
  / <select id="hour" name="hour" title="Hour"></select>:<select id="minute" name="minute" title="Minute"></select><br>
	 <script>
	 var d = new Date();
	 var hour = d.getHours();
	 var minute=d.getMinutes();
	 var year = d.getFullYear();
	 var month = d.getMonth()+1;
	 var day = d.getDate();
	 for(var i=0;i<24;i++){var lsd = "";
	 if(i==hour){lsd="selected";}
	 if(i>9){document.getElementById("hour").innerHTML += "<option value='" + i +"'" +lsd+ ">" + i +"</option>";}
	 else{ document.getElementById("hour").innerHTML += "<option value='0" + i +"'" +lsd+ ">0" + i +"</option>";
	 }}
	 for(var i=0;i<60;i++){var lsd = "";
	 if(i==minute){lsd="selected";}
	 if(i>9){document.getElementById("minute").innerHTML += "<option value='" + i +"'" +lsd+ ">" + i +"</option>";}
	 else{ document.getElementById("minute").innerHTML += "<option value='0" + i +"'" +lsd+ ">0" + i +"</option>";
	 }}
	 for(var i=1;i<13;i++){var lsd = "";
	 if(i==month){lsd="selected";}
	 if(i>9){document.getElementById("month").innerHTML += "<option value='" + i +"'" +lsd+ ">" + i +"</option>";}
	 else{ document.getElementById("month").innerHTML += "<option value='0" + i +"'" +lsd+ ">0" + i +"</option>";
	 }}
	 for(var i=year;i<year+5;i++){var lsd = "";
	 if(i==year){lsd="selected";}
	 document.getElementById("year").innerHTML += "<option value='" + i +"'" +lsd+ ">" + i +"</option>";}
	 for(var i=1;i<32;i++){var lsd = "";
	 if(i==day){lsd="selected";}
	 if(i>9){document.getElementById("day").innerHTML += "<option value='" + i +"'" +lsd+ ">" + i +"</option>";}
	 else{ document.getElementById("day").innerHTML += "<option value='0" + i +"'" +lsd+ ">0" + i +"</option>";
	 }}
    var monthh = $("#month option:selected").val();
    if ((monthh==4 || monthh==6 || monthh==9 || monthh==11)) {
		$("select option:contains('31')").attr("disabled","disabled");
		$("select option:contains('30')").removeAttr("disabled");
		$("select option:contains('29')").removeAttr("disabled");
    }	
    else{
		$("select option:contains('31')").removeAttr("disabled");
    	$("select option:contains('30')").removeAttr("disabled");
		$("select option:contains('29')").removeAttr("disabled");
		}
	 $( "#month" ).change(function() {
    var monthh = $("#month option:selected").val();
    if ((monthh==4 || monthh==6 || monthh==9 || monthh==11)) {
		$("select option:contains('31')").attr("disabled","disabled");
		$("select option:contains('30')").removeAttr("disabled");
		$("select option:contains('29')").removeAttr("disabled");
    }	
    else{
		$("select option:contains('31')").removeAttr("disabled");
		$("select option:contains('30')").removeAttr("disabled");
		$("select option:contains('29')").removeAttr("disabled");
	    }
    if ((monthh==2) && $("#year option:selected").val()%4===0) {
		$("select option:contains('31')").attr("disabled","disabled");
		$("select option:contains('30')").attr("disabled","disabled");
		$("select option:contains('29')").removeAttr("disabled");
    }	
    else if (monthh==2){
		$("select option:contains('31')").attr("disabled","disabled");
		$("select option:contains('30')").attr("disabled","disabled");
		$("select option:contains('29')").attr("disabled","disabled");
    }
    	 
});
$( "#year" ).change(function() {
    var monthh = $("#month option:selected").val();
    if ((monthh==4 || monthh==6 || monthh==9 || monthh==11)) {
		$("select option:contains('31')").attr("disabled","disabled");
    }	
    else{
		$("select option:contains('31')").removeAttr("disabled");
		$("select option:contains('30')").removeAttr("disabled");
		$("select option:contains('29')").removeAttr("disabled");
    }
    if ((monthh==2) && $("#year option:selected").val()%4===0) {
		$("select option:contains('31')").attr("disabled","disabled");
		$("select option:contains('30')").attr("disabled","disabled");
		$("select option:contains('29')").removeAttr("disabled");
    }	
    else if (monthh==2){
		$("select option:contains('31')").attr("disabled","disabled");
		$("select option:contains('30')").attr("disabled","disabled");
		$("select option:contains('29')").attr("disabled","disabled");
    }
		});
	 </script>
	  
	<button type="submit" name='button' value="addingone" onclick="return CheckDay();">Add</button>
	</form>
	</div>
	<div onclick='javascript:Hide();' hidden style="background-color:#000000 ;position :fixed; width:100%; height:100%;margin:0px 0px 0px 0px;opacity: 0.6;filter: alpha(opacity=60);z-index: 9999999;overflow:hidden" id="showmoreback"></div>
	<div hidden style="position :fixed;top:50%;left:50%;  margin-top: -10%;  margin-left: -20%; border: 1px solid #ccc;border-radius: 4px;box-shadow: 0 1px 3px #ddd inset;box-sizing: border-box;padding: 0.5em 0.6em;width: 40%;height:50%;background:#eee;color:#777;border-color:#ccc ;z-index: 99999999999;overflow:auto;" id="editone">
		<img src='images/close.png' width=16 height=16 style='background-color:#EEEEEE;position:fixed;margin-left:37.5%; margin-top:-.42%;z-index:9879854986;' onclick='javascript:Hide();' title='Close'></img>
		<input type="text" id="editedtask" value="0" style="display: none">
		<iframe width="100%" height="100%" id="editframetask" src="edittask.php"></iframe>
	</div>

		<!-- Header -->
	<?php include "css/header.php"; ?>
		<!-- Main -->
			<article id="main">

				<header class="special container">
					<span class="icon fa-tablet"></span>
					<h2>Tasks Management</strong></h2>
					Where you can manage your tasks.
				</header>
				<!-- One -->
					<section>
						<div class="row oneandhalf">
							<div class="8u">
								<!-- Content -->
									<div class="content">
										<section>
											<header>

<style type="text/css">

	table, caption, tbody, tfoot, thead, tr, th, td {
		margin:0;
		padding:0;
		border:0;
		outline:0;
		font-size:100%;
		vertical-align:baseline;
		background:transparent;
	}
	
	a {color:#666;}
	#content {width:100%;margin:6% auto 0;}
	th, td {padding:18px 28px 18px; text-align:center; }
	
	th {padding-top:22px; text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}
	
	td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}
	
	tr.odd-row td {background:#f6f6f6;}
	
	td.first, th.first {text-align:left}
	
	td.last {border-right:none;}
	
	td {
		background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
	}
	tr.odd-row td {
		background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
	}
	th {
		background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
		background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
	}
	tr:first-child th.first {
		border-top-left-radius:5px;
		-moz-border-radius-topleft:5px;
		-webkit-border-top-left-radius:5px; /* Saf3-4 */
	}
	
	tr:first-child th.last {
		border-top-right-radius:5px;
		-moz-border-radius-topright:5px;
		-webkit-border-top-right-radius:5px; /* Saf3-4 */
	}
	
	tr:last-child td.first {
		border-bottom-left-radius:5px;
		-moz-border-radius-bottomleft:5px;
		-webkit-border-bottom-left-radius:5px; /* Saf3-4 */
	}
	
	tr:last-child td.last {
		border-bottom-right-radius:5px;
		-moz-border-radius-bottomright:5px;
		-webkit-border-bottom-right-radius:5px; /* Saf3-4 */
	}
</style>

<script type="text/javascript">
var hoprgd;
function GetChangedValue(a) {
	$("#editframetask").attr("src","edittask.php?taskid="+ a);
	hoprgd=true;
}
function framedone(){
	if(hoprgd==true){
	hoprgd=false;
	$("#editone").show();$("#showmoreback").show();
}}
$(document).ready(function(){
	$(document).keypress(function(e) {if(e.which == 27 || e.keyCode == 27) {Hide();}});
});
function CheckDay() {
	var da = new Date();
	var hour = da.getHours();
	var minute=da.getMinutes();
	var year = da.getFullYear();
	var month = da.getMonth()+1;
	var day = da.getDate();
	var setday = $("#day option:selected").val();
    var setmonth = $("#month option:selected").val();
    var setyear = $("#year option:selected").val();
   	var sethour = $("#hour option:selected").val();
    var setminute = $("#minute option:selected").val();
    if(day>setday && month==setmonth && year==setyear){
    	alert("This day past !!");
    	return false;
    }
    if(month>setmonth && year==setyear){
    	alert("This month past !!");
    	return false;
    }
   //==========================
   if(day==setday && month==setmonth && year==setyear){
    if(minute==setminute && hour==sethour){
    	alert("Invaild time !!");
    	return false;
    	}
    if(hour>sethour){
    	alert("Invaild time !!");
    	return false;
    	}
    if(setminute<minute && hour==sethour){
    	alert("Invaild time !!");
    	return false;
    	}
	}
}
</script>
  <?php 

$id=$_SESSION['id'];
$result=mysqli_query($con,"SELECT * FROM `tasks` WHERE `userid`=$id ORDER BY `done` ASC, `time` ASC;");
$count=mysqli_num_rows($result);
if($count==0){
?>
<a onclick='$("#addnewone").show();$("#showmoreback").show();' style="left:38.3%;position:absolute;text-align: center;">You have no tasks. Click to create one</a>
 <?php
}else{
?>

											</header>
										</section>
									</div>
							</div>
						</div>					
					</section>
  <table id="mytable" class="sortable wrapper style4 container" style="margin-bottom:1.5em;" id="hop">
    <thead><tr><th>Task title</th><th>Description</th><th>Priority</th><th id="myowntime">Time</th><th>Done</th><th class="sorttable_nosort">Options</th></tr></thead>
    <tbody>
<?php
while($row=mysqli_fetch_array($result)){
	$title=$row['title'];
	$desc=$row['desc'];
	$time=$row['time'];
	$taskid=$row['taskid'];
	$isdone=$row['done'];
	$isdone=str_replace("0","No",$isdone);
	$isdone=str_replace("1","Yes",$isdone);
	$isdone=str_replace("2","Time out!",$isdone);
	$pr=$row['pr'];
	$nd=str_split($desc,42);
	$prn=str_replace("very high","5",strtolower($pr));
	$prn=str_replace("very low","1",strtolower($prn));
	$prn=str_replace("high","4",strtolower($prn));
	$prn=str_replace("normal","3",strtolower($prn));
	$prn=str_replace("low","2",strtolower($prn));
	$backcolor=" -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb))";
	$newredcolor="";
	$isitok = "enabled";
	if($isdone=="No"){
	if(strtotime($time)<=time()+43200 && strtotime($time)>time()+21600){$backcolor="rgb(28, 184, 65); ";}
	if(strtotime($time)<=time()+21600 && strtotime($time)>time()+3600){$backcolor="rgb(223, 117, 20);";}
	if(strtotime($time)<=time()+3600){$backcolor="rgb(202, 60, 60);";}
	if(strtotime($time)<time()){$backcolor="#999999";	
	mysqli_query($con,"UPDATE `tasks` SET `done`='2' WHERE `taskid`='$taskid'");
	$isdone="Time out!";
	}
	$isitok = "enabled";
	
	}
	else{
		$isitok = "disabled";
	}
	?>
     <tr>
      <td><?php print $title;?></td>
      <td><a href="javascript:MsgBox('<?php print $row['desc'];;?>');"><?php print isset($nd[1]) ? $nd[0]."..." : $nd[0]; ?></a></td>
      <td sorttable_customkey="<?php print $prn;?>"><?php print $pr;?></td>
      <td class="nope" id="div<?php print $taskid;?>" style="color: <?php print $backcolor;?>"></td>
      <td style="color: <?php $isdone=="Time out!" ? print "#DD514C" : print $isdone=="Yes" ? "#5EB95E" : "#F37B1D";?>"><?php print $isdone;?></td>
	<?php if($isdone=="Time out!"){
		?> <script>$('#div<?php print $taskid;?>').html("<?php print $row['time'];?>");</script><?php
	}else{?>
	  <script>
	   $(".nope").ready(function(){getcount($('#div<?php print $taskid;?>'),<?php print strtotime($row['time']);?>,"<?php print ($title);?>")});
	  </script>
	  <?php }?>
	  <td>
		<form method='POST' action=''>
<button type='button' <?php print $isitok;?> name="button" value="edit" title='Edit task' onclick='GetChangedValue(<?php print $taskid;?>);' alt='Edit'><img src='images/edit.png' title='Edit task' alt='Edit task' width=16 height=16></button>
<button type="submit" onclick="return confirm('Are you sure to delete this task (this cannot be undone)?');" name="button" value="delete" title='Delete task' alt='Delete task'><img src='images/delete.png' width=16 height=16 title='Delete task' alt='Delete task'></button>
<?php if($isdone=="No"){?>
<button type="submit" onclick="return confirm('Are you sure to make this task done?');" name="button" value="done" title='Mark as done' alt='Mark as done'><img src='images/done.png' width=16 height=16 title='Make it done' alt='Mark as done'></button>
<?php } else{
?>	
<button type="submit" <?php print $isdone=="Time out!" ? "disabled" : "";?> onclick="return confirm('Are you sure to make this task undone?');" name="button" value="undone" title='Mark as undone' alt='Mark as undone'><img src='images/undone.png' width=16 height=16 title='Make it undone' alt='Mark as undone'></button>
<?php }?>
  <input style="display:none" name="taskid" value="<?php print $row['taskid'];?>">
  </form> </td> </tr>
<?php	

}
?>
    </tbody>
  </table>
  <style>
  	#addone {
    background-color: #e6e6e6;
    border: 0 none rgba(0, 0, 0, 0);
    border-radius: 2px;
    color: rgba(0, 0, 0, 0.8);
    font-family: inherit;
    font-size: 100%;
    padding: 0.5em 1em;
    text-decoration: none;
    -moz-user-select: none;
    cursor: pointer;
    line-height: normal;
    text-align: center;
    vertical-align: baseline;
    white-space: nowrap;
    width:15%;
    margin-left:42.5%;

}
#addone:focus {
    outline: 0 none;
}
#addone:hover, #addone:focus {
    background-image: linear-gradient(transparent, rgba(0, 0, 0, 0.05) 40%, rgba(0, 0, 0, 0.1));
}
#addone:active{box-shadow:0 0 0 1px rgba(0,0,0,.15) inset,0 0 6px rgba(0,0,0,.2) inset}
  </style>
<input value="Add new task" type="button" style="margin-bottom=50%;" onclick='$("#addnewone").show();$("#showmoreback").show();' id="addone">
  <?php
 }
 ?>

			</article>
			<footer id="footer">
				<span class="copyright">&copy; <?php print date("Y",time());?> <a href='about.php'><?php print title;?></a> .<br> All rights reserved. Design: <a href="http://html5up.net">HTML5 UP</a>.</span>
			</footer>

<script type="text/javascript">
function MsgBox(text) {
document.getElementById("showmore").innerHTML = "<img src='images/close.png' width=16 height=16 style='position:fixed;margin-left:37.5%; margin-top:-.42%;z-index:9879854986;' onclick='javascript:Hide();' title='Close'></img>" + text ;
$("#showmore").show();
$("#showmoreback").show();
	}
	function Hide(){
		document.getElementById('showmore').style.display = "none";
		document.getElementById('showmoreback').style.display = "none";
		document.getElementById('addnewone').style.display = "none";
		document.getElementById('editone').style.display = "none";
	}
$('#editframetask').load(function() {
  $(this).contents().find('#editingform').submit(function() { 
		Hide();
      return true;
  });
});
function getcount(v,timstamp,titlee){
      	var timestamp = timstamp - <?php print time();?>;
		var msgdone=false;
		function component(x, v) {
		    return Math.floor(x / v);
		}
		setInterval(function() {
   		timestamp--;
   		var ho="";
   		var hop="";
   		var hopp="";
    	var days = component(timestamp,24 * 60 * 60),
        hours = component(timestamp,60 * 60) % 24,
        minutes = component(timestamp,60) % 60,
        seconds = component(timestamp,1) % 60;
    	if(seconds<=9){ho="0";}else{ho="";}
    	if(minutes<=9){hop="0";}else{hop="";}
    	if(hours<=9){hopp="0";}else{hopp="";}
    	v.html(days + " days, " + hopp + hours + ":" + hop + minutes + ":"  + ho + seconds);
    	 if(days==0 && hours<1 && msgdone==false){
    		alert("There's less than an hour left for task '" + titlee + "'.");
    		msgdone=true;
    	}
    	}, 1000);


}
      </script>
	</body>
</html>