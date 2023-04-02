<?php 
	include("database.php");

	session_start();

	if (isset($_SESSION['name'])) {
		header("Location: index.php");
	}

	if (isset($_POST['name']) && isset($_POST['password'])) {

		$name = $_POST['name'];
		$password = $_POST['password'];
		$hash = password_hash($password, PASSWORD_DEFAULT);

		$q1 = "select * from users where name = '$name' ";
		$result = mysqli_query($conn,$q1);
		$found_users = mysqli_fetch_all($result,MYSQLI_ASSOC);

		if (!empty($found_users)) {
			echo "<h1 class='text-red-500 text-2xl' >name exists choose another one</h1>";
		}else {

			$q = "insert into users(name,password) values('$name','$hash')";
			mysqli_query($conn,$q);

			mysqli_close($conn);

			header("Location: login.php");
		}


	}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center">
	<div class="flex flex-col gap-3 w-max p-3 items-center border-2 border-black rounded-xl my-3">
		
		<h1 class="text-3xl">REGISTER</h1>
		<form class="flex flex-col gap-2" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
			<input class="p-1 border border-black rounded-xl" required type="text" name="name" placeholder="name">
			<input class="p-1 border border-black rounded-xl" required type="password" name="password" placeholder="password">
			<button class="p-1 border border-black rounded-xl">register</button>
		</form>

		<h1>or <a class="text-sky-500" href="login.php">login here</a></h1>

	</div>
</body>
</html>