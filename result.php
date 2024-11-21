<?php

require_once './models/beveragesRepository.php';
session_start();
$beveragesRepository = new BeveragesRepository();

$page = 1;
$perPage = 12;
$key = "";

if (isset($_GET['key'])) {
    $key = $_GET['key'];
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$searchBeverages = $beveragesRepository->searchBeverages($key);

$total = count($searchBeverages);

$pageMax = ceil($total / $perPage);

$searchBeveragesPage = $beveragesRepository->searchBeveragesPage($key, $page, $perPage);

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $searchBeveragesPage = $beveragesRepository->getBeveragesByCategoryId($category_id, 8);
}

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
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($searchBeveragesPage as $beverages) { ?>
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
            <div class="clearfix justify-content-center mt-3">
                <div class="hint-text text-center ">
                    Showing <b>
                        <?= ($page - 1) * $perPage + 1 ?>
                    </b> to <b>
                        <?= min($page * $perPage, $total) ?>
                    </b> out of <b><?= $total ?></b> entries
                </div>
                <ul class="pagination d-flex justify-content-center mt-3">
                    <li class="page-item">
                        <a href="?page=<?= ($page > 1) ? $page - 1 : $page; ?>" class="page-link">Previous</a>
                    </li>
                    <?= $beveragesRepository->createPageLinkSearchBeverages($total, $perPage, $page, $key); ?>
                    <li class="page-item">
                        <a href="?page=<?= ($page < $pageMax) ? $page + 1 : $page; ?>" class="page-link">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <?php require_once 'footer.php'; ?>
</body>

</html>