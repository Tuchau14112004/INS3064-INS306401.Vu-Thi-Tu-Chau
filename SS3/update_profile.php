<?php
session_start();

$bio = htmlspecialchars($_POST['bio']);

$allowed = ['jpg','png','jpeg'];

$file=$_FILES['avatar']['name'];
$tmp=$_FILES['avatar']['tmp_name'];

$ext=strtolower(pathinfo($file,PATHINFO_EXTENSION));

if(!in_array($ext,$allowed)){
echo "Invalid file type";
exit;
}

move_uploaded_file($tmp,"uploads/".$file);

$users=json_decode(file_get_contents("users.json"),true);

foreach($users as &$user){

if($user['username']==$_SESSION['user']){

$user['bio']=$bio;
$user['avatar']=$file;

}

}

file_put_contents("users.json",json_encode($users));

header("Location: dashboard.php");
?>
