<!DOCTYPE html >
<?php
session_start();
  if(!isset($_SESSION['pro2user']))
  {
   header("location:../login.php");
   echo "error";
  }
?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Project 2</title>
 <script type="text/javascript" src="./js/jquery.js"></script>
 <script type="text/javascript" src="./js/ajaxquery.js"></script>
<link rel="stylesheet" href="./css/styles.css" type="text/css" />
</head>
<body>
<div id="msg" style="display:none; border-radius:7px; width:700px; background: -webkit-linear-gradient(rgba(255,0,0,0.6),rgba(232,44,12,0.6)); padding:10px; text-align:center; font-size:20px; color:#fff; margin-left:auto; margin-right:auto;">
Page number out of bounds
</div>
<div id="wrap">
	<div id="header">
		<div id="header-text">
			
			<!-- page header - use <span></span> to colour text white, default color orange -->
			<h1><a href="#">NITR<span>Journals</span></a></h1>
		
			<!-- sub title here -->
			<h2>NIT Rourkela</h2>
			
			<div class="clear"></div>
		</div>
	</div>
	
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
	
	<!-- End of basic design -->
<div id="content">
	
	
<?php
require 'dbconnect.php';
$sql = 'select `name` ,`countids` from `authors` order by `countids` desc ';
$q = $pdo->prepare($sql);
$q->execute();
$authors=$q->fetchAll(PDO::FETCH_ASSOC);

echo '<div id="sidebar">
<form id="formlimit" name="formlimit" action="#" method="post">';
echo '
		
			<!-- sidebar h3: wrap text in <span></span> tags as shown -->
			<input type="button" class="limit" value="limit" onclick="submit_form()">
			<h3><span>Authors</span></h3>
			<div  style="overflow-y:auto; max-height: 200px;">
			<table>';
if(count($authors)>5)
{
for($i=0;$i<5 ;$i++)
echo '<tr><td>'.$authors[$i]['name'].'	('.$authors[$i]['countids'].')</td><td> <input type="checkbox" name="author[]" id="author" value="'.$authors[$i]['name'].'"></td></tr>';
echo '</table>';
echo '<table class="hiddenta" style="display:none; " >';
for($i=5;$i<count($authors) ;$i++)
echo '<tr><td>'.$authors[$i]['name'].'	('.$authors[$i]['countids'].')</td><td> <input type="checkbox" name="author[]" id="author" value="'.$authors[$i]['name'].'"></td></tr>';
echo '</table>';
echo '</div>';
echo '<a  class="hiddenba" onclick="show(1);"  style="cursor:pointer;">View More</a>';
echo '<a class="shownba" onclick="show(2);" style="cursor:pointer; display:none;" >Hide </a>';
}
else
{
for($i=0;$i<count($authors) ;$i++)
echo '<tr><td>'.$authors[$i]['name'].'	('.$authors[$i]['countids'].')</td><td> <input type="checkbox" name="author[]" id="author" value="'.$authors[$i]['name'].'"></td></tr>';
echo '</table>';
echo '</div>';
}
$sql = 'Select distinct `year`, count(year) from `journals` group by year order by `year` desc';
$q = $pdo->prepare($sql);
$q->execute();
$year=$q->fetchAll(PDO::FETCH_ASSOC);

echo '<h3><span>Years</span></h3>
<div  style="overflow-y:auto; max-height: 200px;">
			<table>';
if(count($year)>5)
{
for($i=0;$i<5;$i++)
echo '<tr><td>'.$year[$i]['year'].'  ('.$year[$i]['count(year)'].')</td><td> <input type="checkbox" name="year[]" id="year" value="'.$year[$i]['year'].'"> </td></tr>';
echo '</table>';
echo '<table class="hiddenty" style="display:none;" >';
for($i=5;$i<count($year);$i++)
echo '<tr><td>'.$year[$i]['year'].'  ('.$year[$i]['count(year)'].')</td><td> <input type="checkbox" name="year[]" id="year" value="'.$year[$i]['year'].'"> </td></tr>';
echo '</table></div>';
echo '<a  class="hiddenby" onclick="show(3);"  style="cursor:pointer;" >View More</a>';
echo '<a class="shownby" onclick="show(4);" style="cursor:pointer; display:none;" >Hide </a>';

}
else
{
for($i=0;$i<count($year);$i++)
echo '<tr><td>'.$year[$i]['year'].'  ('.$year[$i]['count(year)'].')</td><td> <input type="checkbox" name="year[]" id="year" value="'.$year[$i]['year'].'"> </td></tr>';
echo '</table></div>';
}
$sql = 'select distinct `name`, `code` , `countids` from `dept` order by `name` asc';
$q = $pdo->prepare($sql);
$q->execute();
$dept=$q->fetchAll(PDO::FETCH_ASSOC);

echo '<h3><span>Departments</span></h3>
			<div  style="overflow-y:auto; max-height: 200px;">
			<table>';
if(count($dept)>5)
{
for($i=0;$i<5;$i++)
echo '<tr><td>'.$dept[$i]['name'].'-('.$dept[$i]['code'].')  ('.$dept[$i]['countids'].')</td><td> <input type="checkbox" name="dept[]" id="dept" value="'.$dept[$i]['code'].'"></td></tr>';
echo '</table>';
echo '<table class="hiddentd" style="display:none;" >';
for($i=5;$i<count($dept);$i++)
echo '<tr><td>'.$dept[$i]['name'].'-('.$dept[$i]['code'].')  ('.$dept[$i]['countids'].')</td><td> <input type="checkbox" name="dept[]" id="dept" value="'.$dept[$i]['code'].'"></td></tr>';
echo '</table></div>';

echo '<a  class="hiddenbd" onclick="show(5);" style="cursor:pointer;" >View More</a>';
echo '<a class="shownbd" onclick="show(6);" style="cursor:pointer; display:none;" >Hide </a>';
}
else
{
for($i=0;$i<count($dept);$i++)
echo '<tr><td>'.$dept[$i]['name'].'-('.$dept[$i]['code'].')  ('.$dept[$i]['countids'].')</td><td> <input type="checkbox" name="dept[]" id="dept" value="'.$dept[$i]['code'].'"></td></tr>';
echo '</table></div>';
}
echo '<br /> 
<input type="button" class="limit" value="limit" onclick="submit_form()">
</form>
</div>
<div id="page">
   <div id="result" >
   </div>
  </div>
  <div class="clear"></div>

</div>
	<!-- start footer -->
		<div class="footer">
			<p class="left">&copy; 2014&nbsp;<a href="http://www.nitrkl.ac.in">NIT Rourkela</a></p>
			<div class="clear"></div>					
		</div>
		<!-- end footer -->
</div>
</body>
';

?>

