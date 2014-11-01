<?php
require 'dbconnect.php';
session_start();
if (isset($_POST['author']) )
{
	$q1 = 'select `jids` from `authors` where `name` in ("'.implode('","', $_POST["author"]).'")';
	
	$q1= $pdo->prepare($q1);
	$q1->execute();
	$r1=$q1->fetchAll(PDO::FETCH_ASSOC);
	$ids='';
    foreach($r1 as $a)
    $ids = $ids .'|'. $a['jids'];
	$ids = substr($ids, 1);
	$id1 = explode('|',$ids);
}
if (isset($_POST['dept']) )
{
	$q2 = 'select `jids` from `dept` where `code` in ("'.implode('","',$_POST["dept"]).'")';
	$q2= $pdo->prepare($q2);
	$q2->execute();
	$r2=$q2->fetchAll(PDO::FETCH_ASSOC);
	$ids='';
    foreach($r2 as $b)
    $ids = $ids .'|'. $b['jids'];
	$ids = substr($ids, 1);
	$id2 = explode('|',$ids);
}

if(isset($_POST['year']))
{
	$q3 = 'select `id` from `journals` where `year` in ('.implode(',', $_POST["year"]).')';
	$q3= $pdo->prepare($q3);
	$q3->execute();
	$r3=$q3->fetchAll(PDO::FETCH_ASSOC);
	$id3 = array();
	for($i=0;$i<count($r3);$i++)
	array_push($id3,$r3[$i]['id']);
}
if(isset($_POST['author']) && isset($_POST['dept']) && isset($_POST['year']))
	$id = array_intersect($id1,$id2,$id3);
else if(isset($_POST['author']) && isset($_POST['dept']))
	$id = array_intersect($id1,$id2);
else if(isset($_POST['author']) && isset($_POST['year']))
	$id = array_intersect($id1,$id3);
else if(isset($_POST['dept']) && isset($_POST['year']))
	$id = array_intersect($id2,$id3);
else if(isset($_POST['author']))
	$id = $id1;
else if( isset($_POST['dept']))
	$id = $id2;
else if(isset($_POST['year']))
	$id = $id3;
else if(!$_POST)
	$q4 = 'select * from `journals` ';
	
if($_POST)	
$q4 = 'select * from `journals` where id in ('.implode(",",$id).')';
$sql= $pdo->prepare($q4);
$sql->execute();
$cresult=$sql->fetchAll(PDO::FETCH_ASSOC);
$nre = count($cresult);
$_SESSION['q']=$q4;
$q4 = $q4 . ' limit 0,10 ';
$q4= $pdo->prepare($q4);
$q4->execute();
$result=$q4->fetchAll(PDO::FETCH_ASSOC);

$npgs= (int)($nre/10);
if($nre%10!=0)
$npgs++;
echo '
		<div class="query">
		<table class="r">';
		
foreach($result as $r)
echo '<tr><td><a href="http://dx.doi.org/'.$r['doi'].'" target="_blank"> '.$r['sourcetitle'].'</a> &nbsp;&nbsp;&nbsp;   '.$r['year'].'   &nbsp;&nbsp;&nbsp; '.$r['department'].'   &nbsp;&nbsp;&nbsp; '.$r['authors'].' &nbsp;&nbsp;&nbsp;  </td> </tr>';
         echo '</table></div>		 
		<div id="pgs">';
         
		echo 'number of pages is '.$npgs.'<br>';
		if($npgs<20)
		{
			for($i=1;$i<=$npgs;$i++)	
				echo '<button class="pgbtn" onclick="pgclick('.$i.')" id="pgno'.$i.'">'.$i.'</button>&nbsp;&nbsp;';
			echo '<br>';
		}
		else
		{
			for($i=1;$i<=20;$i++)
				echo '<button class="pgbtn" onclick="pgclick('.$i.')" id="pgno'.$i.'">'.$i.'</button>&nbsp;&nbsp;'; 		
			echo '<input type="number" id="pggo" min="1" max="'.$npgs.'">';	
			echo '<button type="submit" class="pgbtngo" onclick="pgclickgo('.$npgs.')" id="go" value="go">GO</button>';
		}
		echo'</div>';
?>