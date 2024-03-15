<?php

require_once __DIR__ . 'classes/Task.php';
require_once __DIR__ . 'classes/User.php';

if (
    !empty($_POST) &&
    isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['email']) &&
    isset($_POST['password'])
) {
    $name = htmlspecialchars($_POST['firstname']);
    $surname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $newUser = new User(
        $firstname,
        $lastname,
        $email,
        $password
    );

    $User = new User();

    $User->create($newUser);

    header('Location: index.php');
}