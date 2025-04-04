<?php

require_once '../../models/usersRepository.php';
$user_id = $_POST['user_id'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$role_id = $_POST['role_id'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$usersRepository = new UsersRepository();
$getUsersByUserId = $usersRepository->getUsersByUserId($user_id);
$getUsersByUserId->setUsername($username);
$getUsersByUserId->setPassword($password);
$getUsersByUserId->setRoleId($role_id);
$usersRepository->updateUsers($getUsersByUserId);
header("Location: read.php?page=" . $page);
