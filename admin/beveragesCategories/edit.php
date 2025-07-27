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
                <h4 class="card-title">Chỉnh sửa <strong>Loại đồ uống</strong></h4>
            </div>
            <form action="update.php?page=<?= $page ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="category_id" value="<?= $getBeveragesCategoriesByCategoryId->getCategoryId() ?>">
                    <div class="mb-3">
                        <label class="form-label">Tên loại đồ uống: </label>
                        <input type="text" class="form-control" required name="category_name" value="<?= $getBeveragesCategoriesByCategoryId->getCategoryName(); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả: </label>
                        <input type="text" class="form-control" required name="description" value="<?= $getBeveragesCategoriesByCategoryId->getDescription(); ?>">
                    </div>
                    <div class="card-footer text-end">
                        <a href="read.php?page=<?= $page ?>" class="btn btn-secondary">Quay lại</a>
                        <input type="submit" class="btn btn-warning" value="Lưu">
                    </div>
            </form>
        </div>
    </div>
</section>
<?php require_once('../footer.php'); ?>