<?php
session_start();
  if(!isset($_SESSION['user']))
  header("location:../login.php");
  ?>
 <html>
 <head>
 <title>search</title>
 <link rel="stylesheet" type="text/css" href="css/main.css" />
 <link rel="icon"  type="image/png"   href="favicon.png" />
 <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/ajax3.js"></script>
 <script type="text/javascript" src="js/ajax4.js"></script>
 </head>
 <body>
 <div id="error" style="display:none; border-radius:7px; width:700px; background: -webkit-linear-gradient(rgba(255,0,0,0.6),rgba(232,44,12,0.6)); padding:10px; text-align:center; font-size:20px; color:#fff; margin-left:auto; margin-right:auto;">
 Page number out of bounds
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
 <form method="post" action=#>
 Search box <input type="search" name="sword" placeholder="Enter your Query"/>
 <select name="stype">
 <option>Title</option>
 <option>Publisher</option>
 <option>Subject</option>
 <option>Document Type</option>
 <option>Keyword</option>
 </select>
 <input type="submit" class="searchbtn" value="Search">
 </form> 
 <br>

			<div class="main">
			
 <?php 
  require 'dbconnect.php';
  if(isset($_POST['sword']) && isset($_POST['stype']))
 {
	$sword = $_POST['sword'] ;
	$sword ="%".$sword."%";
	$stype = strtolower($_POST['stype']) ;
    if($stype=="publisher")
	{
		$q = $pdo->prepare('select count(id) from libcat where lower(publisher) like lower(?) order by title ;');
		$q->execute(array($sword));
		$cresult=$q->fetchAll(PDO::FETCH_ASSOC);
		$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(publisher) like lower(?) order by title limit 0,10 ;');
		$q->execute(array($sword));
		$result=$q->fetchAll(PDO::FETCH_ASSOC);
	}
	if($stype=="title")
	{
		$q = $pdo->prepare('select count(id) from libcat where lower(title) like lower(?) order by title ;');
		$q->execute(array($sword));
		$cresult=$q->fetchAll(PDO::FETCH_ASSOC);
		$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(title) like lower(?) order by title limit 0,10 ;');
		$q->execute(array($sword));
		$result=$q->fetchAll(PDO::FETCH_ASSOC);
	}
	if($stype=="subject")
	{
		$q = $pdo->prepare('select count(id) from libcat where lower(subject) like lower(?) order by title ;');
		$q->execute(array($sword));
		$cresult=$q->fetchAll(PDO::FETCH_ASSOC);
		$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(subject) like lower(?) order by title limit 0,10 ;');
		$q->execute(array($sword));
		$result=$q->fetchAll(PDO::FETCH_ASSOC);
	}  
	if($stype=="document type")
	{
		$q = $pdo->prepare('select count(id) from libcat where lower(doctype) like lower(?) order by title ;');
		$q->execute(array($sword));
		$cresult=$q->fetchAll(PDO::FETCH_ASSOC);
		$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(doctype) like lower(?) order by title limit 0,10 ;');
		$q->execute(array($sword));
		$result=$q->fetchAll(PDO::FETCH_ASSOC);
	}  
	if($stype=="keyword")
    {
		$q = $pdo->prepare('select count(id) from libcat where lower(publisher) like lower(?) or 
                                                     lower(title) like lower(?) or
													 lower(subject) like lower(?) or
                                                    lower(doctype) like lower(?)   order by title ;');
		$q->execute(array($sword,$sword,$sword,$sword));
		$cresult=$q->fetchAll(PDO::FETCH_ASSOC);
		$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(publisher) like lower(?) or 
                                                     lower(title) like lower(?) or
													 lower(subject) like lower(?) or
                                                    lower(doctype) like lower(?)   order by title limit 0,10 ;');
		$q->execute(array($sword,$sword,$sword,$sword));
		$result=$q->fetchAll(PDO::FETCH_ASSOC);
   }  
   $_SESSION['stype']=$stype;
   $_SESSION['sword']=$sword;
   $nre = $cresult[0]['count(id)'];
    $pgno = $nre/10;
	if($nre%10 > 0)
	$pgno++;
	$pgno=(int)$pgno;
		echo '<br>number of results is '.$nre.'<br>';
		
	echo '<div id="searchresults">';
		
		for($j=0 ; $j<count($result) ; $j++)
		echo '
					<div id="Result">
						<div id="r'.$result[$j]['id'].'">
						<p><a href="'.$result[$j]['url'].'" target="_blank">'.$result[$j]['title'].'</a></p>
					 
						 <p> '.$result[$j]['publisher'].'</p>

						<form method="post" action="edit.php">
						  <input name="id" id="id" type="hidden" value="'.$result[$j]['id'].'" / >
						  <input type="submit" class="Edit" value="Edit" />
						   </form>
						     <input id="del" type="button" onclick="con('.$result[$j]['id'].')"  class="Delete" value="Delete" />
					</div>
					</div>
					'	;
	
	
	echo '</div>';
echo 'number of pages is '.$pgno.'<br>';
		if($pgno<20)
		{
		for($i=1;$i<=$pgno;$i++)
		{	
			echo '<button class="spgbtn" onclick="spgclick('.$i.')" id="pgno'.$i.'">'.$i.'</button>&nbsp;&nbsp;';
		}
		echo '<br>';
		}
		else
		{
		for($i=1;$i<=20;$i++)
		{	
			echo '<button class="spgbtn" onclick="spgclick('.$i.')" id="pgno'.$i.'">'.$i.'</button>&nbsp;&nbsp;'; 
		}		
		echo '<input type="number" id="spggo" min="1" max="'.$pgno.'">';	
		echo '<button type="submit" class="spgbtngo" onclick="spgclickgo('.$pgno.')" id="go" value="go">GO</button>';
		}

}
?>
</div>
<!-- end left hand main content -->
		
		<div class="clear"></div>		
	</div>
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

 
