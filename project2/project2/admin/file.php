<?php
session_start();
  if(!isset($_SESSION['pro2user']))
  {
   header("location:../login.php");
   echo "error";
  }

require('dbconnect.php');
$handle = fopen("final.sas", "r");
if ($handle) {
	$lineno = (int)($_POST['start']);
    $Num_of_insert=0;
	$abc=0;
	while (($abc!=$lineno)&&(($line = fgets($handle)) !== false)) {
	$abc++;
	}
	
    while (($line = fgets($handle)) !== false) {
	   $row_data=explode("<!|!>",$line);
	   
	   try{$pdo->beginTransaction();
	       // Here we have to insert 5 data in each row
		   //Change this query according to you
		   
	      $q = $pdo->prepare('INSERT INTO `journals` (authors, title, year, sourcetitle, volume, issue, 
		  artno, pagestart, pageend, pagecount, citedby, link, department, affiliations, authorswithaffiliations, 
		  issn, isbn, coden, doi, doctype, source, eid) VALUES (?, ?, ?, ?, ?,?, ?, ?, ?, ?,?, ?, ?, ?, ?,?, ?, ?, ?, ?,?, ?);');
	      if(!$q->execute(array($row_data[1],$row_data[2],$row_data[3],$row_data[4],$row_data[5],$row_data[6],$row_data[7]
		  ,$row_data[8],$row_data[9],$row_data[10],$row_data[11],$row_data[12],$row_data[13],$row_data[14],$row_data[15],
		  $row_data[16],$row_data[17],$row_data[18],$row_data[19],$row_data[20],$row_data[21],$row_data[22]
		  )))
		  throw new Exception('Error in inserting in journals');
		  $id =  $pdo->lastInsertId();
		  
		  //Authors Updation 
		  $authors=explode('{|}',$row_data[23]);
	
		  
		  for($i=0;$i<count($authors);$i++)
		  {
		    //check author already in table
			$q=$pdo->prepare('SELECT id,countids,jids FROM `authors` where name=?');
			if(!$q->execute(array($authors[$i])))
			throw new Exception('Error in selecting in authors');
			$result= $q->fetchAll(PDO::FETCH_ASSOC);
			
			
			if(count($result)==1)
			{
			    $count = $result[0]['countids'] + 1;
				if($result[0]['jids']!='')
					$jid = $result[0]['jids'].'|'.$id;
				else
					$jid = (string)$id;
				$q=$pdo->prepare('UPDATE `authors`SET `jids`=?,`countids`=? where  `id`=?');
				if(!$q->execute(array($jid,$count,$result[0]['id'])))
				   throw new Exception('Error in authors updation111');
			}
			else{
			  $q=$pdo->prepare('INSERT INTO `authors` (`name`,`jids`,`countids`) values(?,?,?)');
				if(!$q->execute(array($authors[$i],(string)$id,1)))
				{	
					
				    throw new Exception('Error in authors updation222');
				}
			}
			
		  }
		  $dept = explode('|',$row_data[13]);
		  
		  for($i=0;$i<count($dept);$i++)
		  {
		    //check department already in table
			$q=$pdo->prepare('SELECT id,countids,jids FROM `dept` where code=?');
			$q->execute(array($dept[$i]));
			$result= $q->fetchAll(PDO::FETCH_ASSOC);

			if(count($result)==1)
			{
			    $count = $result[0]['countids'] + 1;
				if($result[0]['jids']!='')
					$jid = $result[0]['jids'].'|'.$id;
				else
					$jid = (string)$id;
				$q=$pdo->prepare('UPDATE `dept`SET `jids`=?,`countids`=? where  `id`=?');
				if(!$q->execute(array($jid,$count,$result[0]['id'])))
				   throw new Exception('Error in dept updation');
			}
			else{
			$q=$pdo->prepare('SELECT name FROM `dnames` where code=?');
			$q->execute(array($dept[$i]));
			$result= $q->fetchAll(PDO::FETCH_ASSOC);  
				if(count($result)!=1)
					throw new Exception('New Department Add Manually'.$dept[$i]);
			  $q=$pdo->prepare('INSERT INTO `dept` (`jids`,`name`,`countids`,`code`) values(?,?,?,?)');
				if(!$q->execute(array((string)$id,$result[0]['name'],1,$dept[$i])))
				   throw new Exception('Error in department updation');
			}
			
		  }
		  $pdo->commit();
         }
		 catch (Exception $e){
			 $pdo->rollback();
			 
            }
			
			 $Num_of_insert++;
		  if($Num_of_insert == 10 || ($Num_of_insert+$abc)>= $_SESSION['total'] )
		  {
		    echo $Num_of_insert+$abc;
			break;
		  }
    }
} 
fclose($handle);
?>