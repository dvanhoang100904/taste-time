<?php

require_once '../../models/beveragesCategoriesRepository.php';

$beveragesCategoriesRepository = new BeveragesCategoriesRepository();

$category_id = $_GET['category_id'];
$getBeveragesCategoriesByCategoryId = $beveragesCategoriesRepository->getBeveragesCategoriesByCategoryId($category_id);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Taste Time</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/icon/icon-taste-time.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../assets/css/styles.css" rel="stylesheet" />
</head>

<body>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="card shadow-sm">
                <div class="card-header bg-warning ">
                    <h4 class="card-title">Edit <strong>Beverages Categories</strong></h4>
                </div>
                <form action="update.php?page=<?= $page ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="category_id" value="<?= $getBeveragesCategoriesByCategoryId->getCategoryId() ?>">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" required name="category_name" value="<?= $getBeveragesCategoriesByCategoryId->getCategoryName(); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" required name="description" value="<?= $getBeveragesCategoriesByCategoryId->getDescription(); ?>">
                        </div>
                        <div class="card-footer text-end">
                            <a href="read.php?page=<?= $page ?>" class="btn btn-secondary">Cancel</a>
                            <input type="submit" class="btn btn-warning" value="Save">
                        </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>