<?php
require_once '../../models/beveragesRepository.php';
require_once  '../../models/beveragesCategoriesRepository.php';

$beveragesRepository = new BeveragesRepository();

$page = 1;
$perPage = 5;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$getAllBeverages = $beveragesRepository->getAllBeverages();
$total = count($getAllBeverages);
$pageMax = ceil($total / $perPage);
$getAllBeveragesPage = $beveragesRepository->getAllBeveragesPage($page, $perPage);

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $limit = 10;
    $getAllBeveragesPage = $beveragesRepository->getBeveragesByCategoryId($category_id, $limit);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/icon/icon-taste-time.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <title>Taste Time</title>
</head>

<body>
    <?php require_once '../header.php' ?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="table-wrapper">
                    <div class="table-title mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>Manage <b>Beverages</b></h2>
                            <a href="create.php?page=<?= $page ?>" class="btn btn-success">
                                <i class="bi bi-pencil"></i><span>Add New Beverages</span>
                            </a>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Beverage Id</th>
                                <th class="text-center">Beverage Name</th>
                                <th class="text-center">Price (VNĐ)</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Category id</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getAllBeveragesPage as $beverages) { ?>
                                <tr>
                                    <td class="text-center"><?= $beverages->getBeverageId() ?></td>
                                    <td class="text-center"><a class="text-dark text-decoration-none" href="show.php?beverage_id=<?= $beverages->getBeverageId() ?>?&page=<?= $page ?>"><?= $beverages->getBeverageName() ?></a></td>
                                    <td class="text-center"><?= number_format($beverages->getPrice()) . " VNĐ" ?></td>
                                    <td class="text-center"><?= substr($beverages->getDescription(), 0, 50) . "..." ?></td>
                                    <td class="text-center"><a href="show.php?beverage_id= <?= $beverages->getBeverageId() ?>?&page=<?= $page ?>"><img style="object-fit: cover;" width="100" height="100" src="../../assets/img/<?= $beverages->getImage() ?>" alt="..." class="img-fluid rounded" /></a></td>
                                    <td class="text-center"><?= $beverages->getCategoryId() ?></td>
                                    <td class="d-flex justify-content-around">
                                        <a href="edit.php?beverage_id=<?= $beverages->getBeverageId() ?>?&page=<?= $page ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                        <a href="delete.php?beverage_id=<?= $beverages->getBeverageId() ?>&page=<?= $page ?>" onclick="return confirm('Có xác nhận xóa?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
                            <?= $beveragesRepository->createPageLinkBeverages($total, $perPage, $page); ?>
                            <li class="page-item">
                                <a href="?page=<?= ($page < $pageMax) ? $page + 1 : $page; ?>" class="page-link">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once '../footer.php' ?>

</body>

</html>