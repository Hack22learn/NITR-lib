<!doctype html>
<html lang="en">
<head>
      <meta charset="utf-8">
	  <title>Project Journals</title>
	  <script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>
		<script type="text/javascript" src="js/ajax2.js"></script>
		  <link rel="stylesheet" type="text/css" href="css/main.css" />
		 <link rel="icon"  type="image/png"   href="favicon.png" />
		

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
				<li class="navright"><a href="search.php">SEARCH</a></li>
				
			</ul>
		</div>
	</div>
	<!-- end ------------------------------------------------------------------------------------------ --> 
				<br />	
	<div id="content">
				<!-- left hand main content -->
		<div id="page">
				Browse by 
				<form method="post" action="#" class="item1">
				<select name="Category" id="Category">
					<option value='' disabled='' selected='' >--Select Category--</option>  
					<option >Title</option>
					<option >Subject</option >
					<option >Publisher</option >
				</select>
				<select name='SubCategory' id='SubCategory'>
					<option value='' disabled='' selected='' >--Select Sub Category--</option>  
				</select>
					<button id="submit" value="browse">browse</button>
				
				</form>
				<?php
				session_start();
				require 'dbconnect.php';
				echo '<div id="titleatoz" style="display:none;">';
				for($i=ord('A');$i<=ord('Z');$i++)
				echo '<button class="titlebtn" id="'.chr($i).'" value="'.chr($i).'">'.chr($i).'</button>&nbsp;';
				echo '</div>';
				?>
				
				<br />
		
	
		<br />

<?php

if(isset($_POST['Category']))
{
			$bselect=$_POST['Category'];
			if($bselect!="Title")
			$bspecific=$_POST['SubCategory'];
			$_SESSION['bselect']=$bselect;
			if($bselect!="Title")
			$_SESSION['bspecific']=$bspecific;
		if($bselect=='Subject')
		{
			$q = $pdo->prepare('select count(id) from libcat where lower(subject) = lower(?) order by title ;');
			$q->execute(array($bspecific));
			$cresult=$q->fetchAll(PDO::FETCH_ASSOC);
			$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(subject) = lower(?) order by title limit 0,10;');
			$q->execute(array($bspecific));
			$result=$q->fetchAll(PDO::FETCH_ASSOC);
		}
		if($bselect=='Publisher')
		{
			$q = $pdo->prepare('select count(id) from libcat where lower(publisher) = lower(?) order by title ;');
			$q->execute(array($bspecific));
			$cresult=$q->fetchAll(PDO::FETCH_ASSOC);
			$q = $pdo->prepare('select id,title,url,publisher  from libcat where lower(publisher) = lower(?) order by title limit 0,10 ;');
			$q->execute(array($bspecific));
			$result=$q->fetchAll(PDO::FETCH_ASSOC);
		}
	if($bselect!="Title")
	{
		$re = $cresult[0]['count(id)'];
		$_SESSION['re']=$re;
		$pgs = (int)($re / 10);
		$rem = $re % 10 ;
		if($rem > 0)
	$pgs++;
	
	echo '<div id=wholeresult >';
	echo '<br />number of results is '.$re.'<br />';
	echo '<div class="modal-box">';
if(isset($_POST['Category']))
{
if($bselect!="Title")
	{

for($j=0 ; $j<count($result) ; $j++)
		echo '
					<div id="Result">
						
						<p><a href="'.$result[$j]['url'].'" target="_blank">'.$result[$j]['title'].'</a></p>
					 
						 <p> '.$result[$j]['publisher'].'</p>

						
					</div>
					';	
					}}
echo '</div>';	
echo '<div id=pgnos>';
	
	echo 'number of pages is '.$pgs.'<br />';
	if($pgs<20)
		{
		for($i=1;$i<=$pgs;$i++)
		{	
			echo '<button class="pgbtn" onclick="pgclick('.$i.',false)" id="pgno'.$i.'">'.$i.'</button>&nbsp;&nbsp;';
		}
		echo '<br />';
		}
		else
		{
		for($i=1;$i<=20;$i++)
		{	
			echo '<button class="pgbtn" onclick="pgclick('.$i.',false)" id="pgno'.$i.'">'.$i.'</button>&nbsp;&nbsp;'; 
		}		
		echo '<input type="number" id="pggo" min="1" max="'.$pgs.'">';	
		echo '<button type="submit" class="pgbtngo" onclick="pgclickgo('.$pgs.',false)" id="go" value="go">GO</button>';
		}}
	echo '</div>';

echo '</div>';			}
else
		{
		echo '<div id=wholeresult>';
	echo '<div class="modal-box">';
	echo '</div></div>';
		}
					
					?>
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