<html>

	<script>
	function inIframe () {
    try {return window.self !== window.top;
    } catch (e) {return true;}}
if(inIframe()==false){window.location.href="index.php";}

</script>
<head><link rel="stylesheet" href="css/style.css" />
<script src="js/jquery.min.js"></script>
		<meta name="description" content="Task Management system" />
		<meta name="keywords" content="Task , Manage , Management" />
		<meta type="author" content="Omar Abou Elmagd" /></head>
	
<?php
include "include/config.php";
if($_GET['taskid']=="undefined"){
	header("Location: ");
}
if($_POST==true){
	$tasktitle=$_POST['tasktitle'];
	$taskdesc=nl2br($_POST['taskdesc']);
	$taskpro=$_POST['taskpro'];
	$timeset=$_POST['year']."-".$_POST['month']."-".$_POST['day']." ".$_POST['hour'].":".$_POST['minute'].":00";
	$oldtaskid=$_GET['taskid'];
	mysqli_query($con,"UPDATE `tasks` SET `title`='$tasktitle',`desc`='$taskdesc',`time`='$timeset',`pr`='$taskpro' WHERE `taskid`='$oldtaskid'");
	?><script>parent.location.reload();</script><?php
}

$con=mysqli_connect(hostname,username,password,dbname);
$result=mysqli_query($con,"SELECT * FROM `tasks` WHERE `taskid`='".$_GET['taskid']."' LIMIT 1;");
while($row=mysqli_fetch_array($result)){
	$oldtitle=$row['title'];
	$olddesc=$row['desc'];
	$oldpro=$row['pr'];
	$oldtime=strtotime($row['time']);
 } ?>
	<body style="background-color: #EEEEEE">
		<form method="post" action="" id="editingform">
			<input type="text" name="tasktitle" maxlength="100" placeholder="The task title" title="8~100 characters" value="<?php print $oldtitle;?>" required pattern=".{8,100}">	
		<textarea type="text" name="taskdesc" placeholder="The task description (optional)" style="resize: none; height:80px;"><?php print str_replace("<br />","",$olddesc);?></textarea>
		<label for="taskpro">The task priority :</label>
		<select id="taskpro" name="taskpro">	
			<option value="Very high">Very high</option>
			<option value="High">High</option>
			<option value="Normal">Normal</option>
			<option value="Low">Low</option>
			<option value="Very low">Very low</option>
		</select><br>
		Task will be at : <select id="year" name="year" title="Year"></select>-<select id="month" title="Month" name="month"></select>-<select title="Day" id="day" name="day"></select>
  / <select id="hour" name="hour" title="Hour"></select>:<select id="minute" name="minute" title="Minute"></select><br>
	<script>
	$('#taskpro option[value="<?php print trim($oldpro);?>"]').attr("selected", "selected");
	 var d = new Date(<?php print ($oldtime)*1000;?>);
	 var hour = d.getHours();
	 var minute=d.getMinutes();
	 var year = d.getFullYear();
	 var month = d.getMonth()+1;
	 var day = d.getDate();
	 //var n = d.getMonth()+1;	 
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
<script>
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
</script>	  
	<button type="submit" id='button' value="addingone" onclick="return CheckDay();">Edit</button>
	</form>
	</body>
</html>