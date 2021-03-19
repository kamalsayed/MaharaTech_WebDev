<html>
	<?php
	//check for errors
	$errors_arr = array();
	if(isset($_GET['error_feilds'])){
		$errors_arr = explode(",",$_GET['error_feilds']);
	}


	?>
	<body>
	<form action="./process.php" method="POST">
		<label for="name">Name</label>
		<input type="text" name="name" id="name"><br>
		<?php 
		if(in_array("name", $errors_arr))
			echo "* Please enter your name ";
		?>
		<br>
		<label for="email">Email</label>
		<input type="email" name="email" id="email"><br>
		<?php 
		if(in_array("email", $errors_arr))
			echo "* Please enter your email ";
		?>
		<br>
		<label for="password">Password</label>
		<input type="password" name="password" id="password"><br><?php 
		if(in_array("password", $errors_arr))
			echo "* Please enter your password ";
		?>
		<br>
		<label for="gender">Gender</label><br>
		<input type="radio" name="gender" value="male">Male
		<input type="radio" name="gender" value="female">Female
		<br>
		<input type="submit" name="submit" value="Register">


	</form>		


	</body>


</html>