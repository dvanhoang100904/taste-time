<?php

require_once '../../models/usersRepository.php';
$user_id = $_GET['user_id'];
$UsersRepository = new UsersRepository();
$getUsersByUserId = $UsersRepository->getUsersByUserId($user_id);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$UsersRepository->deleteUsers($user_id);
header("Location: read.php?page=" . $page);
