<?php
require_once '../../models/beveragesRepository.php';
require_once '../../models/beveragesCategoriesRepository.php';

$beveragesRepository = new BeveragesRepository();
$beveragesCategoriesRepository = new BeveragesCategoriesRepository();

$beverage_id = $_GET['beverage_id'];
$getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($beverage_id);

$category_id = $getBeveragesByBeverageId->getCategoryId();
$getBeveragesCategoriesByCategoryId = $beveragesCategoriesRepository->getBeveragesCategoriesByCategoryId($category_id);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
?>
<?php require_once '../header.php'; ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img src="../../assets/img/<?= $getBeveragesByBeverageId->getImage() ?>" class="img-fluid rounded" alt="Beverage Image" style="border: 1px solid #ddd; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);" />
            </div>
            <div class="col-md-6">
                <p class="font-weight-bold fs-5 mb-3 text-muted">Beverages Categories:
                    <a href="read.php?category_id=<?= $getBeveragesCategoriesByCategoryId->getCategoryId() ?>" class="text-dark text-decoration-none"><?= $getBeveragesCategoriesByCategoryId->getCategoryName() ?></a>
                </p>
                <h2 class="display-4 text-dark"><?= $getBeveragesByBeverageId->getBeverageName() ?></h2>
                <p class="lead text-dark fs-4"><?= number_format($getBeveragesByBeverageId->getPrice()) . " VNĐ" ?></p>
                <p class="mb-4"><?= substr($getBeveragesByBeverageId->getDescription(), 0, 150) . "..." ?></p>
                <div class="d-flex mt-2">
                    <a href="edit.php?beverage_id=<?= $getBeveragesByBeverageId->getBeverageId() ?>&page=<?= $page ?>" class="btn btn-warning btn-lg">
                        <i class="bi bi-pencil"></i> Chỉnh sửa
                    </a>
                    <a href="delete.php?beverage_id=<?= $getBeveragesByBeverageId->getBeverageId() ?>&page=<?= $page ?>" class="btn btn-danger btn-lg ms-4 " onclick="return confirm('Có xác nhận xóa?')">
                        <i class="bi bi-trash"></i> Xóa
                    </a>
                    <a href="read.php?&page=<?= $page ?>" class="btn btn-secondary btn-lg ms-4 ">
                        Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once '../footer.php'; ?>