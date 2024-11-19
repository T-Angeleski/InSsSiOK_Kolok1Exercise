<?php
session_start();
require_once "../database/db_connection.php";
$db = new Database();
require_once "jwt_helper.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = trim($_POST["username"]);
	$password = $_POST["password"];

	$user = $db->loginUser($username);

	if ($user && password_verify($password, $user["password"])) {
		$token = createJWT($user["id"], $user["username"]);
		session_regenerate_id(true);
		$_SESSION['jwt'] = $token;

		header("Location: ../index.php");
		exit;
	} else {
		echo "Incorrect login";
		exit;
	}
}