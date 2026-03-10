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

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>

<a href="profile.php">Edit Profile</a><br>
<a href="logout.php">Logout</a>
