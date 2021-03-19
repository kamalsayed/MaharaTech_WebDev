
<?php 
$error_feilds = array();
if($_SERVER['REQUEST_METHOD']== 'POST'){
// Validation




if(!(isset($_POST['name']) && !empty($_POST['name']))){
	$error_feilds[]="name";
}
if(!(isset($_POST['email']) && filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL))){
	$error_feilds[]="email";
}
if(!(isset($_POST['password'])&& strlen($_POST['password'])>5)){
	$error_feilds[]="password";
}
if(!$error_feilds){
	// header('Location: form.php?error_feilds='.implode(",", $error_feilds));
	


$conn = mysqli_connect("localhost","root", null ,"blog");

if(! $conn){
	echo mysqli_connect_error();
	exit;
}

///////-------UPLOAD FILE-------////////

// $uploads_dir =$_SERVER['DOCUMENT_ROOT'].'/uploads';
// $avatar='';
// if($_FILES["avatar"]['error'] == UPLOAD_ERROR_OK){
// 	$tmp_name = $_FILES["avatar"]["tmp_name"];
// 	$avatar = basename($FILEs["avatar"]["name"]);
// 	move_uploaded_file($tmp_name, "$uploads_dir/$avatar");
// }else{
// 	echo "File can't be uploaded";
// 	exit;
// }










$name = mysqli_escape_string($conn,$_POST['name']);
$email = mysqli_escape_string($conn,$_POST['email']);
$password = sha1($_POST['password']);
$admin =(isset($_POST['admin']))? 1 : 0;






$query = "INSERT INTO `users` (`name`,`email`,`password`,`admin`) VALUES ('".$name."' , '".$email."','".$password."','".$admin."')";
if (mysqli_query($conn,$query)) {
	header("Location: list.php");
}else{
	//echo $query;
	echo mysqli_error($conn);
}

mysqli_close($conn);
}
}
 ?>

<html>
	<body>
	<form method="POST" enctype="multipart/form-data">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>"><br>
		<?php 
		if(in_array("name", $error_feilds))
			echo "* Please enter your name ";
		?>
		<br>
		<label for="email">Email</label>
		<input type="email" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>"><br>
		<?php 
		if(in_array("email", $error_feilds))
			echo "* Please enter your email ";
		?>
		<br>
		<label for="password">Password</label>
		<input type="password" name="password" id="password"><br><?php 
		if(in_array("password", $error_feilds))
			echo "* password at least 6 characters ! ";
		?>
		<br>
		<label for="admin">Admin</label><br>
		<input type="checkbox" name="admin">Admin
		<br>
		<!-- <label for="avatar">Avatar</label>
		<input type="file" name="avatar" id="avatar"> -->
		<input type="submit" name="submit" value="Register">


	</form>		


	</body>


</html>