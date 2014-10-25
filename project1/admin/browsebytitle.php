<?php
			session_start();
			 if(!isset($_SESSION['user']))
  {
   header("location:../login.php");
   echo "error";
  }
			require 'dbconnect.php';
			$bselect=$_POST['Category'];
			$bspecific=$_POST['SubCategory'];
			$_SESSION['bselect']=$bselect;
			$_SESSION['bspecific']=$bspecific;
		if($bselect=='Title')
		{
			$q = $pdo->prepare('select count(id) from libcat where lower(title) like lower(?) order by title ;');
			$q->execute(array($bspecific."%"));
			$cresult=$q->fetchAll(PDO::FETCH_ASSOC);
			$q = $pdo->prepare('select id,title,url,publisher from libcat where lower(title) like lower(?) order by title limit 0,10 ;');
			$q->execute(array($bspecific."%"));
			$result=$q->fetchAll(PDO::FETCH_ASSOC);
		}
		$re = $cresult[0]['count(id)'];
		$_SESSION['re']=$re;
		$pgs = (int)($re / 10);
		$rem = $re % 10 ;
		if($rem > 0)
			$pgs++;
	echo '<div id="wholeresult">';
	echo '<br />number of results is '.$re.'<br />';
	echo '<div class="modal-box">';

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
					';	
		echo '</div>';	
echo '<div id="pgnos">';
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
		}
	echo '</div>';
		echo '</div>'	;		

?>