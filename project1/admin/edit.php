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
 if(!isset($_SESSION['user']))
  {
   header("location:../login.php");
   echo "error";
  }
require 'dbconnect.php';
if(isset($_POST['id']))
{
$id = (int)$_POST['id'];
$q = $pdo->prepare('select title,url,publisher,subject,doctype from libcat where id = ?');
	 $q->execute(array($id));
	 $result=$q->fetchAll(PDO::FETCH_ASSOC); 
	
}
else
header("location:index.php");
if(isset($_POST['id']) && isset($_POST['upub']) && isset($_POST['uti']) && isset($_POST['udoc']) && isset($_POST['usub']) && isset($_POST['url']))
{
$uid = (int)$_POST['id'];
$upub = (string)$_POST['upub'];
$uti = (string)$_POST['uti'];
$udoc = (string)$_POST['udoc'];
$usub = (string)$_POST['usub'];
$url = $_POST['url'];
$sql="UPDATE `libcat`    SET `publisher` = :publisher,`title` = :title,`doctype` = :doctype, `subject` = :subject,  `url` = :url WHERE `id` = :id";
	 $q=$pdo->prepare($sql);
	 $q->bindValue(":publisher",$upub);
	 $q->bindValue(":title",$uti);
	 $q->bindValue(":doctype",$udoc);
	 $q->bindValue(":subject",$usub);
	 $q->bindValue(":url",$url);
	 $q->bindValue(":id",$uid);
	 $count=$q->execute();
if($count==2)
{	
$q = $pdo->prepare('select title,url,publisher,subject,doctype from libcat where id = ?');
	 $q->execute(array($id));
	 $result=$q->fetchAll(PDO::FETCH_ASSOC); 
	 
echo '<script type="text/javascript">
$(document).ready(function(){
$("#msg").slideDown(1000).delay(3000).slideUp(1000);
});
</script>';
}
}
echo '
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
				<li class="navleft"><a href="index.php">BROWSE</a></li>
				<li ><a href="search.php">SEARCH</a></li>
				<li ><a href="upload.php">UPLOAD</a></li>
				<li class="navright"><a href="logout.php">LOG OUT</a></li>
			</ul>
		</div>
	</div>
	<!-- end ------------------------------------------------------------------------------------------ --> 
				<br />	
	<div id="content">
				<!-- left hand main content -->
		<div id="page">

 <form method="post" class="smart-green" action=#>
 <h1>Update Form 
        <span>Please change the fields you want to update fields.</span>
 </h1>
 <input name="id" type="hidden" value="'.$id.'" /><br />
<label><span>Publisher</span><input name="upub" type="Text"  value="'.$result[0]["publisher"].'" required /></label>
<label><span>Title</span><input name="uti" type="Text"  value="'.$result[0]["title"].'" required /></label>
<label><span>Document Type</span><input name="udoc" type="Text"  value="'. $result[0]["doctype"].'" required /></label>
 <label><span>Subject</span><input name="usub" type="Text"  value="'.$result[0]["subject"].'" required /></label>
 <label><span>URL</span><input name="url" type="url"  value="'.$result[0]["url"].'" required pattern="https?://.+" title="url"/></label>
 <label>
        <span>&nbsp;</span> <input class="button" type="submit" value="Update">
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
</body> ';