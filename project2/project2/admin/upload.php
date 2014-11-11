<?php
session_start();
 if(!isset($_SESSION['pro2user']))
  {
   header("location:../login.php");
   echo "error";
  }
?>
<html>
<head>
 <meta charset="utf-8">
	  <title>Upload</title>
	  <script type="text/javascript" src="js/jquery.js"></script>
	  <script type="text/javascript" src="js/upload_ajax.js"></script>
	   <link rel="stylesheet" type="text/css" href="css/upload.css" />
	    <link rel="stylesheet" type="text/css" href="css/main.css" />
		 <link rel="icon"  type="image/png"   href="favicon.png" />

</head>
<body>
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
		</ul>
		 </div>
	</div> 
	<!-- end ------------------------------------------------------------------------------------------ --> 
				<br />	
	<div id="content">
				<!-- left hand main content -->
		<div id="page"> 
	<form action="#" method="post" enctype="multipart/form-data">
		<label for="file">Filename:</label><input type="file" name="file" id="file"><br>
		<input type="submit" name="submit" value="Submit">
	</form>
 <?php
		require('dbconnect.php');
	// file upload start
	$cond = false;
if($_FILES)
{
	$allowedExts = array("sas");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ((($_FILES["file"]["type"] == "application/octet-stream"))&& ($_FILES["file"]["size"] < 2000000)&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	
  } 
  else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  
   if (file_exists($_FILES["file"]["name"])) {
      unlink($_FILES["file"]["name"]);
      #echo $_FILES["file"]["name"] . " already exists. ";
    }
	
	if (file_exists($_FILES["file"]["name"])) {
      echo $_FILES["file"]["name"] . " already exists. ";
	  }
	  else{
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $_FILES["file"]["name"]);
	  $cond = true;
      echo "Stored in: "  .$_FILES["file"]["name"] ."<br />";
     }
	 
  }
} else {
  echo "Invalid file";
}
if($cond)
{
$add =  $_FILES["file"]["name"];
	// file upload end
		$handle = fopen($add, "r");
		if ($handle) 
		{
			$Num_to_insert=0;
			while (($line = fgets($handle)) !== false) 
			{
				$row_data=explode("<!|!>",$line);
				$Num_to_insert++;
			}
			$_SESSION['total']=$Num_to_insert;
			echo '<button onclick="upload('.$Num_to_insert.')" >Click to start</button><br /> <br />';
		}
}		
}
		?>
<div id="result">
</div>

<div id="progress" class="meter animate red" style="width:500px;">
	<span style="width: 0%;"><span></span></span>
</div>
</div>
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
