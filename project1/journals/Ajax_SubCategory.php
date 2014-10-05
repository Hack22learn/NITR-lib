<?php
session_start();
include('dbconnect.php');
if(isset($_POST['cat']))
 {
	$bselect=$_POST['cat'];
	if($bselect=='Title')
	{
		$result=array(array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"));
	}
	if($bselect=='Subject')
	{
		$q = $pdo->prepare('select distinct Subject from libcat order by Subject ;');
		$q->execute();
		$result=$q->fetchAll(PDO::FETCH_NUM);
	}
	if($bselect=='Publisher')
	{
		$q = $pdo->prepare('select distinct Publisher from libcat order by Publisher;');
		$q->execute();
		$result=$q->fetchAll(PDO::FETCH_NUM);
	}
	foreach($result as $i)
	{	
		foreach($i as $j)
		{	
				echo '<option>'.$j.'</option>';
		}
	
	}
 }
?>