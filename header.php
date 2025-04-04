<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="./assets/icon/icon-taste-time.ico" />
    <!-- Nhúng style bootstrap -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">

    <link rel="stylesheet" href="./assets/css/main.css">
    <title>Taste Time</title>

</head>

<body>
    <?php
    require_once './models/beveragesCategoriesRepository.php';
    $beveragesCategoriesRepository = new BeveragesCategoriesRepository();
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand fw-bold text-dark text-uppercase" href="index.php">Taste Time</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="index.php">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#!">Tin Tức</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Đồ Uống</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="result.php">Tất cả đồ uống</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <?php
                            $getAllBeveragesCategories = $beveragesCategoriesRepository->getAllBeveragesCategories();
                            foreach ($getAllBeveragesCategories as $beveragesCategories) {
                            ?>
                                <li><a class="dropdown-item" href="result.php?category_id=<?= $beveragesCategories->getCategoryId() ?>"><?= $beveragesCategories->getCategoryName() ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex ms-auto me-3" action="result.php" method="get" style="max-width: 400px;">
                    <div class="input-group">
                        <input class="form-control border-0" type="search" placeholder="Tìm Kiếm" aria-label="Search" name="key">
                        <button class="btn btn-light" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
                <form class="d-flex ">
                    <a href="cart.php" class="btn btn-light position-relative">
                        <i class="bi-cart-fill me-1"></i>
                        Giỏ Hàng
                        <span class="badge bg-dark text-white ms-1 rounded-pill">
                            <?= isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>
                        </span>
                    </a>
                </form>
                <form class="d-flex align-items-center ms-3">
                    <div class="dropdown">
                        <?php if (isset($_SESSION['email']) && isset($_SESSION['username']) && $_SESSION['role_id'] == '100') { ?>
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-person-fill me-1"></i> <?= $_SESSION['username']; ?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item text-dark " href="./admin/beverages/read.php">Admin</a></li>
                                <li><a class="dropdown-item text-danger" href="logout.php">Đăng Xuất</a></li>
                            </ul>
                        <?php } else if (isset($_SESSION['email']) && isset($_SESSION['username']) && $_SESSION['role_id'] == '50') { ?>
                            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-person-fill me-1"></i><?= $_SESSION['username']; ?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item text-danger" href="logout.php">Đăng Xuất</a></li>
                            </ul>
                        <?php } else { ?>
                            <a href="login-form.php" class="btn btn-light position-relative "> <i class="bi-person-fill me-1"></i>Đăng Nhập</a>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </nav>