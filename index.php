<?php 
	include("database.php");
	session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Document</title>
</head>
<body class="flex flex-col items-center my-3">
	<div class="flex p-3 border-2 border-black rounded-full w-max gap-3 items-center justify-center">
		<h1 class="text-3xl">
			<?php echo "Hello ", $_SESSION['name']; ?>
		</h1>

		<a class="border text-red-600 border-red-600 rounded-full p-2" href="logout.php">LOGOUT</a>
	</div>

	<form class="flex my-4 gap-2" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
		<input required class="border border-black rounded-2xl px-2 py-1 text-2xl" type="text" name="todo" placeholder="create todo">
		<button class="border border-gray-600 rounded-full px-2 py-1 text-2xl">add todo</button>
	</form>
	
	<div class="flex flex-col gap-3">

	</div>

</body>
</html>

<?php 
	if (!isset($_SESSION['name'])) {
		header("Location:login.php");
	}


	if (isset($_POST['todo'])) {
		$body = $_POST['todo'];
		$uid = $_SESSION['id'];

		$q = "insert into todos(body,authorid) values('$body','$uid')";

		mysqli_query($conn,$q);
	}

	$q1 = "select body, authorid, tid from todos inner join users on todos.authorid = users.id";

	$result = mysqli_query($conn,$q1);
	$todos = mysqli_fetch_all($result,MYSQLI_ASSOC);

	if (!empty($todos)) {

		foreach ($todos as $todo) {
			if($todo['authorid'] == $_SESSION['id']){
				echo "
					<div class='flex gap-2 items-center justify-center border border-black w-max p-2 rounded-2xl'>
						<h1 class='text-2xl'>{$todo['body']}</h1>
						<a class='text-3xl cursor-pointer text-red-500' href='delete.php? ID={$todo['tid']}' '>&#120;</a>
					</div>
					<br>
				";
			}
		}

		mysqli_close($conn);
	}

 ?>