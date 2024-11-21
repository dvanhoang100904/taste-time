<?php

require_once '../../models/beveragesRepository.php';
require_once '../../models/beveragesCategoriesRepository.php';

$beveragesRepository = new BeveragesRepository();
$beveragesCategoriesRepository = new BeveragesCategoriesRepository();

$beverage_id = $_GET['beverage_id'];
$getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($beverage_id);
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
    <!-- Bootstrap 5 CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
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
                    <h4 class="card-title">Edit <strong>Beverages</strong></h4>
                </div>
                <form action="update.php?page=<?= $page ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="beverage_id" value="<?= $getBeveragesByBeverageId->getBeverageId() ?>">
                        <div class="mb-3">
                            <label class="form-label">Beverage Name</label>
                            <input type="text" class="form-control" required name="beverage_name" value="<?= $getBeveragesByBeverageId->getBeverageName() ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price (VNĐ)</label>
                            <input type="number" class="form-control" required name="price" value="<?= $getBeveragesByBeverageId->getPrice() ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" required name="description" value="<?= $getBeveragesByBeverageId->getDescription() ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category id</label>
                            <select name="category_id" class="form-select">
                                <?php
                                $getAllBeveragesCategories = $beveragesCategoriesRepository->getAllBeveragesCategories();
                                foreach ($getAllBeveragesCategories as $beveragesCategories) {
                                ?>
                                    <option value="<?= $beveragesCategories->getCategoryId() ?>"><?= $beveragesCategories->getCategoryName() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="read.php?page=<?= $page ?>" class="btn btn-secondary">Cancel</a>
                        <input type="submit" class="btn btn-warning" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>