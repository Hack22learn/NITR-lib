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
 echo '<table class="r">';
 foreach($result as $r)
 echo '<tr><td><a href="http://dx.doi.org/'.$r['doi'].'"> '.$r['sourcetitle'].'</a>    '.$r['year'].'    '.$r['department'].'    '.$r['authors'].' </tr></td>';
echo '</table>';
 }
?>