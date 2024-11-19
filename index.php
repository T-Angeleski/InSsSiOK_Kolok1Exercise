<?php
require_once "./database/db_connection.php";
include "./service/jwt_helper.php";
session_start();

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
	header("Location: pages/login.php");
	exit;
}

$db = new Database();
$games = $db->getGames();
?>

<a href="pages/game_form.php">Create a new game</a>
<a href="/service/logout_handler.php">Logout</a>
<hr>

<table>
  <tr>
    <td>Title</td>
    <td>Category</td>
    <td>Price</td>
    <td>Description</td>
    <td>Actions</td>
  </tr>
	<?php foreach ($games as $game): ?>
    <tr>
      <td><?php echo $game["title"] ?></td>
      <td><?php echo $game["category"] ?></td>
      <td><?php echo $game["price"] ?></td>
      <td><?php echo $game["description"] ?></td>
      <td>
				<?php if ($game["price"] <= 100) : ?>
          <form action="/service/delete_game.php" method="post" style="display: inline">
            <input type="hidden" name="id" value="<?= $game["id"] ?>">
            <button type="submit" style="color: red">Delete</button>
          </form>
				<?php endif; ?>

        <form action="pages/game_form.php" method="post" style="display: inline">
          <input type="hidden" name="id" value="<?= $game["id"] ?>">
          <button type="submit">Edit</button>
        </form>
      </td>
    </tr>
	<?php endforeach; ?>
</table>


