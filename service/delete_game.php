<?php
require_once "../database/db_connection.php";
$db = new Database();
$gameId = $_POST['id'] ?? null;
if ($gameId) {
	$db->deleteGame($gameId);
} else {
	echo "Error with ID, did you send a POST method?";
	echo "<a href='/'>Go back</a>";
}

$db->closeConnection();
header("Location: /");