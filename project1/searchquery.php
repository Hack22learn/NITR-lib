<?php
session_start();
require 'dbconnect.php';
if(isset($_POST['pgno']))
{	

	$sword = $_SESSION['sword'] ;
	$sword ="%".$sword."%";
	$stype = strtolower($_SESSION['stype']) ;
	$pgno = $_POST['pgno'];
	$start = ($pgno - 1)*10;
    if($stype=="publisher")
	{
		$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(publisher) like lower(?) order by title limit '.$start.',10 ;');
		$q->execute(array($sword));
		$result=$q->fetchAll(PDO::FETCH_ASSOC);
	}
	if($stype=="title")
	{
		$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(title) like lower(?) order by title limit '.$start.',10 ;');
		$q->execute(array($sword));
		$result=$q->fetchAll(PDO::FETCH_ASSOC);
	}
	if($stype=="subject")
	{
		$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(subject) like lower(?) order by title limit '.$start.',10 ;');
		$q->execute(array($sword));
		$result=$q->fetchAll(PDO::FETCH_ASSOC);
	}  
	if($stype=="document type")
	{
		$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(doctype) like lower(?) order by title limit '.$start.',10 ;');
		$q->execute(array($sword));
		$result=$q->fetchAll(PDO::FETCH_ASSOC);
	}  
	if($stype=="keyword")
    {
		$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(publisher) like lower(?) or 
                                                     lower(title) like lower(?) or
													 lower(subject) like lower(?) or
                                                    lower(doctype) like lower(?)   order by title limit '.$start.',10 ;');
		$q->execute(array($sword,$sword,$sword,$sword));
		$result=$q->fetchAll(PDO::FETCH_ASSOC);
   }  
   
		for($j=0; $j<count($result) ; $j++)
		echo '
					<div id="Result">
						
						<p><a href="'.$result[$j]['url'].'" target="_blank">'.$result[$j]['title'].'</a></p>
					 
						 <p> '.$result[$j]['publisher'].'</p>
						
					</div>
					';
	}

	

?>