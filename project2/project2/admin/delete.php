
<?php
session_start();
  if(!isset($_SESSION['pro2user']))
  {
   header("location:../login.php");
   echo "error";
  }

require('dbconnect.php');
$id=(int)$_POST['del'];
$q = $pdo->prepare('SELECT `authors` , `department` from `journals` where `id` = ?');
	      $q->execute(array($id));
		 $result= $q->fetchAll(PDO::FETCH_ASSOC);
		 if(count($result)==0)
		  echo 'Wrong id ... This id is not in database ( maybe already deleted )';
		  else
		  {
		  $authors = explode(', ',$result[0]['authors']);
		  $department = explode(', ',$result[0]['department']);
		  if($department[0]=='')
		  $department[0] = 'NITR';
		   $sql =' SELECT `id` , `code` , `jids`  from `dept` where `code` in ("'.implode('","',$department).'") ';
		    $q=$pdo->prepare($sql);
		   $q->execute();
		   $result= $q->fetchAll(PDO::FETCH_ASSOC);
		   for($i= 0;$i<count($result);$i++) 
		   {
				
				$djids = explode('|',$result[$i]['jids']);
				for($j= 0;$j<count($djids);$j++)
				{
				  if($djids[$j]==(string)$id)
				  { 
					unset($djids[$j]);
					break;
				  }
				}
				$result[$i]['jids'] = implode('|',$djids);
		   }
		   
		   //authors
		    $sql =' SELECT `id` , `name` , `jids` from `authors` where `name` in ("'.implode('","',$authors).'") ';
		    $q=$pdo->prepare($sql);
		   $q->execute();
		   $result2= $q->fetchAll(PDO::FETCH_ASSOC);
		   for($i= 0;$i<count($result2);$i++) 
		   {
				$ajids = explode('|',$result2[$i]['jids']);
				for($j= 0;$j<count($ajids);$j++)
				{
				  if($ajids[$j]==(string)$id)
				  { 
					unset($ajids[$j]);
					break;
				  }
				}
				$result2[$i]['jids'] = implode('|',$ajids);
		   }
		   try
		    {    $pdo->beginTransaction();
				//delete from journals
				$sql = 'DELETE FROM `journals` where `id` = ?';
				$q=$pdo->prepare($sql);
				if(!$q->execute(array($id)))
				throw new Exception('error in deleting journals'.$q->errorInfo()[2]);
				//delete from authors
				for($i= 0;$i<count($result2);$i++) 
				{
					$sql = 'UPDATE `authors` SET `jids` = ?, `countids` = ? where `id` = ?';
					$q=$pdo->prepare($sql);
					if(!$q->execute(array($result2[$i]['jids'],count($ajids),$result2[$i]['id'])))
					throw new Exception('error in deleting authors '.$q->errorInfo()[2]);
					
				}
				//delete from dept
				for($i= 0;$i<count($result);$i++) 
				{
					$sql = 'UPDATE `dept` SET `jids` = ?, `countids` = ? where `id` = ?';
					$q=$pdo->prepare($sql);
					if(!$q->execute(array($result[$i]['jids'],count($djids),$result[$i]['id'])))
					throw new Exception('error in deleting dept '.$q->errorInfo()[2]);
				}
				$pdo->commit();
				echo 'Deleted Successfully';
		    }
			catch (Exception $e)
			{
				echo 'Error :'.$e->getMessage().' rolling back changes ..';
				$pdo->rollback();
			}
			}
?>