<?php

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

if ($password !== $confirm) {
    echo "Passwords do not match";
    exit;
}

$users = json_decode(file_get_contents("users.json"), true);

$newUser = [
    "username" => $username,
    "password" => password_hash($password, PASSWORD_DEFAULT),
    "bio" => "",
    "avatar" => ""
];

$users[] = $newUser;

file_put_contents("users.json", json_encode($users));

header("Location: login.php");
?>
