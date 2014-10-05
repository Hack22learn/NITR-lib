<?php
require 'dbconnect.php';
session_start();
if(isset($_POST['pgno']))
{
 $pgno=(int)$_POST['pgno'];
 $pgno=($pgno-1)*10;
 $q=$_SESSION['q'];
 $sql = $q . ' limit '.$pgno.' , 10 ';
 $q = $pdo->prepare($sql);
 $q->execute();
 $result=$q->fetchAll(PDO::FETCH_ASSOC);
 foreach($result as $r)
 echo '<br /><a href="http://dx.doi.org/'.$r['doi'].'"> '.$r['sourcetitle'].'</a>    '.$r['year'].'    '.$r['department'].'    '.$r['authors'].'    <br />';
}
?>