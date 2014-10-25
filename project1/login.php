<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login Admin</title>

   <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="js/prefixfree.min.js"></script>
    <?php
	if(isset($_POST['user'])&&isset($_POST['password']))
{	
	
	 $host = 'localhost';
    $db_name = 'project1'; 
    $db_username = 'root'; 
    $db_password = 'root';
    try
    {
        $pdo = new PDO('mysql:host='. $host .';dbname='.$db_name, $db_username, $db_password);
    }
    catch (PDOException $e)
    {
        exit('Error Connecting To DataBase');
    }
  $user = htmlentities($_POST['user']);
  $pass = htmlentities($_POST['password']);
  $sql='select `username` from `users` where `username` = :user and `pass` = sha1(:pass) ; ';
  $q = $pdo->prepare($sql);
  $q->bindParam(':user',$user , PDO::PARAM_STR);
  $q->bindParam(':pass',$pass , PDO::PARAM_STR);
  $q->execute();
  $result=$q->fetchAll(PDO::FETCH_ASSOC);
  if(count($result)==1)
  {
  session_start();
  $_SESSION['user']=$user;
  header("location:./admin/index.php");
  }
  else
  {
  echo "wrong username password";
   
  }
}
	?>
</head>

<body>

  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>NIT<span>Rourkela</span></div>
		</div>
		<br>
		<div class="login">
		<form method="post" action="login.php"> 
				<input type="text" placeholder="username" name="user" required><br>
				<input type="password" placeholder="password" name="password" required><br>
				<input type="submit" value="Login">
		</form>
		</div>

 

</body>

</html>