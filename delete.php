<?php 
	include("database.php");
	$id = $_GET['ID'];

	$q = "delete from todos where tid = $id";

	mysqli_query($conn,$q);

	header("Location: index.php");

 ?>