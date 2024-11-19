<?php

session_start();
require_once "../database/db_connection.php";
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$username = trim($_POST["username"]);
	$password = $_POST["password"];
	$role = $_POST["role"];

	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	$db->registerUser($username, $hashed_password, $role);
	echo "Successful registration! <a href='/pages/login.php'>Log in</a>";
}