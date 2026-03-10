<?php
session_start();

if(!isset($_SESSION['fail'])){
    $_SESSION['fail']=0;
}

if($_SESSION['fail']>=3){
    echo "Too many failed attempts";
    exit;
}

$username=$_POST['username'];
$password=$_POST['password'];

$users=json_decode(file_get_contents("users.json"),true);

foreach($users as $user){

if($user['username']==$username &&
password_verify($password,$user['password'])){

$_SESSION['user']=$username;
$_SESSION['fail']=0;

header("Location: dashboard.php");
exit;

}

}

$_SESSION['fail']++;

echo "Login failed. Attempt ".$_SESSION['fail'];
?>
