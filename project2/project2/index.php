<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>query</title>
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
				<li><a href="#">examples</a></li>
			</ul>
		</div>
	</div>
	
	<!-- End of basic design -->
<div id="content">
	
	
<?php
require 'dbconnect.php';
$sql = 'select `name` ,`countids` from `authors` order by `countids` desc limit 0,4';
$q = $pdo->prepare($sql);
$q->execute();
$authors=$q->fetchAll(PDO::FETCH_ASSOC);

echo '<div id="sidebar">
<form action="#" method="post">';
echo '
		
			<!-- sidebar h3: wrap text in <span></span> tags as shown -->
			<h3><span>Authors</span></h3>
			<p class="newsitem">';
foreach($authors as $a)
echo $a['name'].'	('.$a['countids'].')<input type="checkbox" name="author[]" id="author" value="'.$a['name'].'"><br />';
echo '</p>';

$sql = 'select distinct `year` , count(*) from `journals` order by `year` desc limit 0,4';
$q = $pdo->prepare($sql);
$q->execute();
$year=$q->fetchAll(PDO::FETCH_ASSOC);

echo '<h3><span>Years</span></h3>
			<p class="newsitem">';
foreach($year as $y)
echo $y['year'].'  ('.$y['count(*)'].')<input type="checkbox" name="year[]" id="year" value="'.$y['year'].'"> <br/>';
echo '</p>';


$sql = 'select distinct `name`, `code` , `countids` from `dept` order by `countids` desc limit 0,4';
$q = $pdo->prepare($sql);
$q->execute();
$dept=$q->fetchAll(PDO::FETCH_ASSOC);

echo '<h3><span>Departments</span></h3>
			<p class="newsitem">';
foreach($dept as $d)
echo $d['name'].'-('.$d['code'].')  ('.$d['countids'].')<input type="checkbox" name="dept[]" id="dept" value="'.$d['code'].'"></br />';

echo '</p><br /> 
<input type="button" value="limit" onclick="submit_form()">
</form>
</div>
<div id="page">
   <div id="result">
   </div>
  </div>
  <div class="clear"></div>

</div>
	<!-- start footer -->
		<div class="footer">
			<p class="left">&copy; 2014<a href="http://www.nitrkl.ac.in">NIT Rourkela</a></p>
			<div class="clear"></div>					
		</div>
		<!-- end footer -->
</div>
</body>
';

?>

