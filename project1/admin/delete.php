<?php
require "dbconnect.php";
$uid = (int)$_POST['del'];
$sql="DELETE FROM `libcat` WHERE  `id` = :ID";
	 $q=$pdo->prepare($sql);
	 $q->bindValue(":ID",$uid);
	 $q->execute();
	 echo "deleted";
	 ?>