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
 echo '<tr><td><i>'.$r['authors'].'</i>,<br /><a href="http://dx.doi.org/'.$r['doi'].'" target="_blank"> &ldquo;'.$r['title'].'&rdquo;</a>,&nbsp;'.$r['sourcetitle'].',&nbsp;'.$r['volume'].'('.$r['issue'].')&nbsp;'.$r['pagestart'].'-'.$r['pageend'].',&nbsp;'.$r['year'].',&nbsp;'.str_replace("|",", ",$r['department']).'</td></tr>';
echo '</table>';
 }
?>