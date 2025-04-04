<?php

require_once '../../models/beveragesCategoriesRepository.php';

$beveragesCategoriesRepository = new BeveragesCategoriesRepository();

$category_id = $_GET['category_id'];
$getBeveragesCategoriesByCategoryId = $beveragesCategoriesRepository->getBeveragesCategoriesByCategoryId($category_id);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>
<?php require_once('../header.php'); ?>
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
<?php require_once('../footer.php'); ?>