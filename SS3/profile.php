<?php
require "auth.php";
?>
<?php
session_start();

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}
?>

<h2>Edit Profile</h2>

<form action="update_profile.php" method="POST" enctype="multipart/form-data">

Bio:<br>
<textarea name="bio"></textarea><br><br>

Avatar:
<input type="file" name="avatar"><br><br>

<button type="submit">Update</button>

</form>

<a href="dashboard.php">Back</a>
