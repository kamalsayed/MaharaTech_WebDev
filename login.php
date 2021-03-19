
<?php 
session_start();
$error_feilds = array();

$conn = mysqli_connect("localhost","root", null ,"blog");

if(!$conn){
	echo mysqli_connect_error();
	exit;
}
if($_SERVER['REQUEST_METHOD']== 'POST'){
$email = mysqli_escape_string($conn,$_POST['email']);
$password = sha1($_POST['password']);


$query="SELECT * FROM `users` WHERE `users`.`email` ='".$email."' AND `users`.`password` = '".$password."' LIMIT 1";
$result = mysqli_query($conn , $query);

if($row = mysqli_fetch_assoc($result)){
	$_SESSION['id'] = $row['id'];
	$_SESSION['email'] = $row['email'];
	header("Location: Admin/list.php");
	exit;
}else{

	$error ='Invalid email or password';
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<?php
	if(isset($error)) echo $error;
	?>

	<form method="POST">
		<label for="email">Email</label>
		<input type="email" name="email" id="email"><br>
		<label for="password">Password</label>
		<input type="password" name="password" id="password"><br>
		<input type="submit" name="submit" value="Login">

	</form>
</body>
</html>