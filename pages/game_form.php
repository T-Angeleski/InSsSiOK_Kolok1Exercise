<?php
require_once "../database/db_connection.php";
$db = new Database();

$id = $_POST["id"] ?? null;
$isEdit = $id !== null;

$game = [
	"title" => "",
	"category" => "",
	"price" => "",
	"description" => ""
];
if ($id) {
	$game = $db->getGameById($id);
}
?>

<form action="/service/create_game.php" method="post">
  <input type="hidden" name="id" value="<?= $id ?>"/>

  <div>
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="<?= $game["title"] ?>" required/>
  </div>

  <div>
    <label for="category">Category</label>
    <select id="category" name="category" required>
      <option value="FPS" <?= $game["category"] === "FPS" ? "selected" : "" ?>>FPS</option>
      <option value="RPG" <?= $game["category"] === "RPG" ? "selected" : "" ?>>RPG</option>
      <option value="RTS" <?= $game["category"] === "RTS" ? "selected" : "" ?>>RTS</option>
      <option value="MOBA" <?= $game["category"] === "MOBA" ? "selected" : "" ?>>MOBA</option>
      <option value="MMO" <?= $game["category"] === "MMO" ? "selected" : "" ?>>MMO</option>
      <option value="Racing" <?= $game["category"] === "Racing" ? "selected" : "" ?>>Racing</option>
      <option value="Sports" <?= $game["category"] === "Sports" ? "selected" : "" ?>>Sports</option>
      <option value="Adventure" <?= $game["category"] === "Adventure" ? "selected" : "" ?>>Adventure</option>
      <option value="Puzzle" <?= $game["category"] === "Puzzle" ? "selected" : "" ?>>Puzzle</option>
      <option value="Horror" <?= $game["category"] === "Horror" ? "selected" : "" ?>>Horror</option>
    </select>

    <label for="price">Price</label>
    <input type="number" id="price" name="price" value="<?= $game['price'] ?>" required/>

    <label for="description">Description</label>
    <input type="text" id="description" name="description" value="<?= $game['description'] ?>"/>

    <button type="submit"><?= $isEdit ? "Edit" : "Create" ?></button>
  </div>
</form>


