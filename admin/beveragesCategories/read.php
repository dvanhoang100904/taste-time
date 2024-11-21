<?php
require_once '../../models/BeveragesCategoriesRepository.php';

$beveragesCategoriesRepository = new BeveragesCategoriesRepository();
$page = 1;
$perPage = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$getAllBeveragesCategories = $beveragesCategoriesRepository->getAllBeveragesCategories();
$total = count($getAllBeveragesCategories);
$pageMax = ceil($total / $perPage);
$getAllBeveragesCategoriesPage = $beveragesCategoriesRepository->getAllBeveragesCategoriesPage($page, $perPage);

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
                            <h2>Manage <b>Beverages Categories</b></h2>
                            <a href="create.php?page=<?= $page ?>" class="btn btn-success">
                                <i class="bi bi-pencil"></i><span>Add New Beverages Categories</span>
                            </a>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Category Id</th>
                                <th class="text-center">Category Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($getAllBeveragesCategoriesPage as $beveragesCategories) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $beveragesCategories->getCategoryId() ?></td>
                                    <td class="text-center"><?= $beveragesCategories->getCategoryName() ?></td>
                                    <td class="text-center"><?= substr($beveragesCategories->getDescription(), 0, 150) . "..." ?></td>
                                    <td class="d-flex justify-content-around">
                                        <a href="edit.php?category_id=<?= $beveragesCategories->getCategoryId() ?>&page=<?= $page ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="delete.php?category_id=<?= $beveragesCategories->getCategoryId() ?>&page= <?= $page ?>" onclick="return confirm('Có xác nhận xóa?')" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
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
                            <?= $beveragesCategoriesRepository->createPageLinkBeveragesCategories($total, $perPage, $page); ?>
                            <li class="page-item">
                                <a href="?page=<?= ($page < $pageMax) ? $page + 1 : $page; ?>" class="page-link">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once '../footer.php'; ?>
</body>

</html>