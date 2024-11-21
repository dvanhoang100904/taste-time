<?php
require_once '../../models/UsersRepository.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$role_id = $_POST['role_id'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$users = new Users(null, $username, $password, $email, $role_id, null);
$usersRepository = new UsersRepository();
$usersRepository->addUsers($users);
header("Location: read.php?page=" . $page);
