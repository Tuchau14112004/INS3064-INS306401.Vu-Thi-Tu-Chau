<?php session_start(); ?>

<h2>Register</h2>

<form action="process_register.php" method="POST">
Username:
<input type="text" name="username" required><br><br>

Password:
<input type="password" name="password" required><br><br>

Confirm Password:
<input type="password" name="confirm_password" required><br><br>

<button type="submit">Register</button>
</form>

<a href="login.php">Login</a>
