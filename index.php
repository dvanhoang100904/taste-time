<?php
session_start();
require_once './models/beveragesRepository.php';
$beveragesRepository = new BeveragesRepository();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="./assets/icon/icon-taste-time.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>Taste Time</title>
</head>

<body>
    <?php require_once 'header.php'; ?>
    <header class="bg-dark py-5" style="background-image: url('./assets/img/banner.jpg'); object-fit: cover; background-size: cover; background-position: center;">
        <div class="overlay"></div>
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Khám Phá Thế Giới Đồ uống Giải Khát</h1>
                <p class="lead fw-normal text-white-50 mb-0">Cùng thưởng thức những loại đồ uống giải khát tươi mới và hấp dẫn nhất, giúp bạn thư giãn và tận hưởng cuộc sống.</p>
                <a href="result.php" class="btn btn-light btn-lg mt-4">Chọn Đồ Uống</a>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $limit = 8;
                $getBeveragesRandom = $beveragesRepository->getBeveragesRandom($limit);
                foreach ($getBeveragesRandom as $beverages) {
                ?>
                    <div class="col mb-5">
                        <div class="card h-100 shadow-sm">
                            <a href="detail.php?beverage_id=<?= $beverages->getBeverageId(); ?>">
                                <img class="card-img-top" src="./assets/img/<?= $beverages->getImage(); ?>" alt="Beverage Image" />
                            </a>
                            <div class="card-body p-4 text-center">
                                <h5 class="fw-bolder">
                                    <a href="detail.php?beverage_id=<?= $beverages->getBeverageId(); ?>" class="text-dark text-decoration-none"><?= $beverages->getBeverageName(); ?></a>
                                </h5>
                                <p class="text-muted mb-2"><?= number_format($beverages->getPrice()) . " VNĐ"; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php require_once 'footer.php'; ?>

</body>

</html>