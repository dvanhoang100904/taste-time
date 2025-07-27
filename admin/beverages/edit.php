<?php

require_once '../../models/beveragesRepository.php';
require_once '../../models/beveragesCategoriesRepository.php';

$beveragesRepository = new BeveragesRepository();
$beveragesCategoriesRepository = new BeveragesCategoriesRepository();

$beverage_id = $_GET['beverage_id'];
$getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($beverage_id);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
?>
<?php require_once('../header.php'); ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-warning ">
                <h4 class="card-title">Chỉnh sửa <strong>Đồ uống</strong></h4>
            </div>
            <form action="update.php?page=<?= $page ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="beverage_id" value="<?= $getBeveragesByBeverageId->getBeverageId() ?>">
                    <div class="mb-3">
                        <label for="beverage_name" class="form-label">Tên đồ uống: </label>
                        <input type="text" class="form-control" required id="beverage_name" name="beverage_name" value="<?= $getBeveragesByBeverageId->getBeverageName() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá (VNĐ): </label>
                        <input type="number" class="form-control" required id="price" name="price" value="<?= $getBeveragesByBeverageId->getPrice() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả: </label>
                        <input type="text" class="form-control" required id="description" name="description" value="<?= $getBeveragesByBeverageId->getDescription() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh: </label>
                        <input type="file" class="form-control" id="image" name="image">
                        <small class="text-muted">Để trống nếu muốn giữ hình hiện tại.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label w-80">Hình ảnh hiện tại: </label><br>
                        <img src="../../assets/img/<?= $getBeveragesByBeverageId->getImage() ?>" width="120" height="120" style="object-fit: cover;" class="rounded border">
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Loại đồ uống: </label>
                        <select id="category_id" name="category_id" class="form-select">
                            <?php
                            $getAllBeveragesCategories = $beveragesCategoriesRepository->getAllBeveragesCategories();
                            $currentCategoryId = $getBeveragesByBeverageId->getCategoryId();
                            foreach ($getAllBeveragesCategories as $beveragesCategories) {
                                $selected = ($beveragesCategories->getCategoryId() == $currentCategoryId) ? 'selected' : '';
                            ?>
                                <option value="<?= $beveragesCategories->getCategoryId() ?>" <?= $selected ?>><?= $beveragesCategories->getCategoryName() ?></option>
                            <?php } ?>
                        </select>
                    </div>
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