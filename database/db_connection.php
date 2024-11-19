<?php

class Database
{
	private SQLite3 $db;

	public function __construct()
	{
		$this->db = new SQLite3(__DIR__ . "/db.sqlite", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE, "");

		$gameQuery = "CREATE TABLE IF NOT EXISTS games (
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			title TEXT NOT NULL,
			category TEXT CHECK(category IN 
			('FPS', 'RPG', 'RTS', 'MOBA', 'MMO', 'Racing', 'Sports', 'Adventure', 'Puzzle', 'Horror')) NOT NULL,
			price INTEGER NOT NULL,
			description TEXTF
		)";

		$userQuery = "CREATE TABLE IF NOT EXISTS users (
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			username TEXT NOT NULL,
			password TEXT NOT NULL,
			role TEXT NOT NULL
		)";

		$this->db->exec($gameQuery);
		$this->db->exec($userQuery);
	}

	public function getGames(): array
	{
		$query = "SELECT * FROM games";
		$result = $this->db->query($query);
		$games = [];
		while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
			$games[] = $row;
		}

		return $games;
	}

	public function getGameById($id): false|array
	{
		$query = "SELECT * FROM games WHERE id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
		$result = $stmt->execute();

		return $result->fetchArray(SQLITE3_ASSOC);
	}

	public function createGame($title, $category, $price, $description): void
	{
		$query = "INSERT INTO games (title, category, price, description) VALUES (:title, :category, :price, :description)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':title', $title);
		$stmt->bindValue(':category', $category);
		$stmt->bindValue(':price', $price, SQLITE3_INTEGER);
		$stmt->bindValue(':description', $description);
		$stmt->execute();
	}

	public function updateGame($id, $title, $category, $price, $description): void
	{
		$query = "UPDATE games SET title = :title, category = :category, price = :price, description = :description WHERE id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
		$stmt->bindValue(':title', $title);
		$stmt->bindValue(':category', $category);
		$stmt->bindValue(':price', $price, SQLITE3_INTEGER);
		$stmt->bindValue(':description', $description);
		$stmt->execute();
	}

	public function deleteGame($id): void
	{
		$query = "DELETE FROM games WHERE id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(":id", $id);

		$stmt->execute();
	}

	/**
	 * Don't forget to hash the password
	 */
	public function registerUser($username, $password, $role): void
	{
		$query = "INSERT INTO users (username, password, role) VALUES (:name, :password, :role)";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':name', $username);
		$stmt->bindValue(':password', $password);
		$stmt->bindValue(':role', $role);

		$stmt->execute();
	}

	public function loginUser($username): false|array
	{
		$query = "SELECT * FROM users WHERE username = :name";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':name', $username);
		$result = $stmt->execute();
		return $result->fetchArray(SQLITE3_ASSOC);
	}

	public function closeConnection(): bool
	{
		return $this->db->close();
	}
}
