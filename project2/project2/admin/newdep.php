<!doctype html>
<html lang="en">
<head>
      <meta charset="utf-8">
	  <title>Project Journals</title>
	  <script type="text/javascript" src="js/jquery.js"></script>
	   <link rel="stylesheet" type="text/css" href="css/main.css" />
		 <link rel="icon"  type="image/png"   href="favicon.png" />
<?php
session_start();
  if(!isset($_SESSION['pro2user']))
  {
   header("location:../login.php");
   echo "error";
  }
require "dbconnect.php";
  if(isset($_POST['dcode']) && isset($_POST['dname']) )
{
$dcode = (string)$_POST['dcode'];
$dname = (string)$_POST['dname'];
$sql="Insert into  `dnames`  (`code`,`name`)  values  (:dcode,:dname) ";
	 $q=$pdo->prepare($sql);
	 $q->bindValue(":dcode",$dcode);
	 $q->bindValue(":dname",$dname);
	  if($q->execute())
	  echo '<script type="text/javascript">
 $(document).ready(function(){
 $("#msg").slideDown(1000).delay(3000).slideUp(1000);
 });
 </script>';
 else
echo '<script type="text/javascript">
$(document).ready(function(){
$("#msg").html("Error in insertion '.$q->errorInfo()[2].' ");
$("#msg").slideDown(1000).delay(3000).slideUp(1000);
});
</script>';
}
?>
</head>
<body>
<div id="msg" style="display:none; border-radius:7px; width:700px; background: -webkit-linear-gradient(rgba(255,0,0,0.6),rgba(232,44,12,0.6)); padding:10px; text-align:center; font-size:20px; color:#fff; margin-left:auto; margin-right:auto;">
 Successfully Updated
 </div>
		<!--start-- header-------------------------------------------------------------------------------------------------- -->
 <div id="wrap">
	<div id="header">
		<div id="header-text">
			
			
			<h1><a href="#">NITR<span> Journals</span></a></h1>
		
			
			<h2>NIT Rourkela</h2>
			
			<div class="clear"></div>
		</div>
	</div>
	<!-- end ------------------------------------------------------------------------------------------ -->
		<br />
<!--start---------navigation------------------------------------------------------------------------------------------- -->
	<div id="navigation">
		<div id="innernav">
			<ul>
				<!-- top navigation  -->
				<!-- add class navleft to first item and navright to last item as shown -->
				<li class="navleft"><a href="index.php">home</a></li>
				<li ><a href="upload.php">Upload</a></li>
				<li ><a href="newdep.php">New Department</a></li>
				<li class="navright"><a href="logout.php">Logout</a></li>
		
			</ul>
		</div>
	</div>
	<!-- end ------------------------------------------------------------------------------------------ --> 
				<br />	
	<div id="content">
				<!-- left hand main content -->
		<div id="page">

 <form method="post" class="smart-green" action=#>
 <h1>Add New Department
        <span>Enter New Department name and code</span>
 </h1>
<label><span>Department Code</span><input name="dcode" type="Text"   required /></label>
<label><span>Department name</span><input name="dname" type="Text"  required /></label>
<label>
        <span>&nbsp;</span> <input class="button" type="submit" value="Add Department">
</label>
 </form>
</div>
		<!-- end left hand main content -->
		
		<div class="clear"></div>		
	</div>
		<!-- start footer -->
		<div class="footer">
			<p class="left">&copy; 2014 <a href="http://www.nitrkl.ac.in">NIT Rourekla</a></p>
			<div class="clear"></div>					
		</div>
		<!-- end footer -->
</div>
</body> 
</html>