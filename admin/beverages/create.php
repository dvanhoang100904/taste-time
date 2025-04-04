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
                <h2 class="mb-0">Add New<strong> Beverages</strong></h2>
            </div>
            <form action="store.php?page=<?= $page ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Beverage Name</label>
                        <input type="text" class="form-control" name="beverage_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price (VNĐ)</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image </label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category id</label>
                        <select class="form-select" name="category_id" required>
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
                    <a href="read.php?page=<?= $page ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Add </button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php require_once('../footer.php'); ?>