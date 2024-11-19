<?php
include "../service/jwt_helper.php";
session_start();

if (isset($_SESSION["jwt"]) && decodeJWT($_SESSION["jwt"])) {
	header("Location: /index.php");
	exit;
}
?>

<h1>Login</h1>
<form action="/service/login_handler.php" method="post"
      style="display: flex; flex-direction: column; width: 200px">
  <label for="username">Username</label>
  <input type="text" id="username" name="username"/>

  <label for="password">Password</label>
  <input type="password" id="password" name="password"/>

  <label for="role">Select role</label>
  <select id="role" name="role">
    <option value="role">Admin</option>
    <option value="role">User</option>
  </select>

  <button type="submit">Login</button>
  <a href="/pages/register.php">Register</a>
</form>