<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Taste Time</title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="../../assets/icon/icon-taste-time.ico" />
	<!-- embed fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Sen:wght@700&display=swap"
		rel="stylesheet">
	<!-- bootstrap css -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
	<!-- my css -->
	<link rel="stylesheet" href="../../assets/css/style.css">
	<!-- font awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky">
		<div class="container px-4 px-lg-5">
			<a class="navbar-brand text-uppercase" href="read.php">Admin</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="read.php">Dashboard</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Quản lý
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item" href="../beverages/read.php">Đồ uống</a></li>
							<li><a class="dropdown-item" href="../beveragesCategories/read.php">Loại đồ uống</a></li>
							<li><a class="dropdown-item" href="../users/read.php">Người dùng</a></li>
						</ul>
					</li>
				</ul>
				<form class="d-flex align-items-center ms-3">
					<div class="dropdown">
						<?php
						if (isset($_SESSION['email']) && isset($_SESSION['username']) && $_SESSION['role_id'] == '100') {
						?>
							<button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi-person-fill me-1"></i> <?= $_SESSION['username']; ?>
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<li><a class="dropdown-item text-dark " href="../../index.php">Trang khách hàng</a></li>
								<li><a class="dropdown-item text-danger" href="../../logout.php">Đăng Xuất</a></li>
							</ul>
						<?php
						} else {
						?>
							<a href="login-form.php" class="btn btn-light position-relative "> <i class="bi-person-fill me-1"></i>Đăng Nhập</a>
						<?php } ?>
					</div>
				</form>
			</div>
		</div>
	</nav>