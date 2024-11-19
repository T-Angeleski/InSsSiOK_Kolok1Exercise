<h1>Register</h1>
<form action="/service/register_handler.php" method="post"
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

	<button type="submit">Register</button>
</form>