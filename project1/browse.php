<?php
session_start();
include('dbconnect.php');
if(isset($_POST['pgno']))
{	$pgno=$_POST['pgno'];
    $bselect=$_SESSION['bselect'];
	$bspecific=$_SESSION['bspecific']; 
	$re=$_SESSION['re'];
	$pgno=$re/10;
	if($re%10!=0)
	$pgno++;
	$cpgno= $_POST['pgno'];
	$start = ($cpgno-1)*10;

		if($bselect=='Title')
		{
			$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(title) like lower(?) order by title limit '.$start.',10 ;');
			$q->execute(array($bspecific."%"));
			$result=$q->fetchAll(PDO::FETCH_ASSOC);
		}
		if($bselect=='Subject')
		{
			$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(subject) = lower(?) order by title limit '.$start.',10 ;');
			$q->execute(array($bspecific));
			$result=$q->fetchAll(PDO::FETCH_ASSOC);
		}
		if($bselect=='Publisher')
		{
			$q = $pdo->prepare('select id,title,url,publisher  from libcat where lower(publisher) = lower(?) order by title limit '.$start.',10 ;');
			$q->execute(array($bspecific));
			$result=$q->fetchAll(PDO::FETCH_ASSOC);
		}
	}
	

		for($j=0 ; $j<count($result) ; $j++)
		echo '
					<div id="Result">
						
						<p><a href="'.$result[$j]['url'].'" target="_blank">'.$result[$j]['title'].'</a></p>
					 
						 <p> '.$result[$j]['publisher'].'</p>

						
					</div>
					';	
	

	
?>