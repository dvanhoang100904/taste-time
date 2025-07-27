<?php
require_once '../../models/beveragesCategoriesRepository.php';
$beveragesCategoriesRepository = new BeveragesCategoriesRepository();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
?>
<?php require_once('../header.php'); ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white">
                <h2 class="mb-0">Thêm mới<strong> Đồ uống</strong></h2>
            </div>
            <form action="store.php?page=<?= $page ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="beverage_name" class="form-label">Tên đồ uống: </label>
                        <input type="text" class="form-control" required id="beverage_name" name="beverage_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá (VNĐ): </label>
                        <input type="number" class="form-control" required id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả: </label>
                        <input type="text" class="form-control" required id="description" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh: </label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Loại đồ uống: </label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <?php
                            $getAllBeveragesCategories = $beveragesCategoriesRepository->getAllBeveragesCategories();
                            foreach ($getAllBeveragesCategories as $beverages) {
                            ?>
                                <option value="<?= $beverages->getCategoryId() ?>"><?= $beverages->getCategoryName() ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="read.php?page=<?= $page ?>" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-success">Thêm </button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php require_once('../footer.php'); ?>