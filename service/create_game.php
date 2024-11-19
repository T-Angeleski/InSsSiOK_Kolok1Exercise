<?php
require_once "../database/db_connection.php";
$db = new Database();

$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? '';
$category = $_POST['category'] ?? '';
$price = $_POST['price'] ?? '';
$description = $_POST['description'] ?? '';

if ($id) {
	$db->updateGame($id, $title, $category, $price, $description);
} else {
	$db->createGame($title, $category, $price, $description);
}

header("Location: /");