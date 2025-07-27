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
<?php require_once('../header.php'); ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="table-wrapper">
                <div class="table-title mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Quản lý <b>Đồ uống</b></h2>
                        <a href="create.php?page=<?= $page ?>" class="btn btn-success">
                            <i class="bi bi-pencil"></i><span>Thêm mới đồ uống</span>
                        </a>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên đồ uống</th>
                            <th class="text-center">Giá (VNĐ)</th>
                            <th class="text-center">Mô tả</th>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-center">Mã loại đồ uống</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getAllBeveragesPage as $beverages) { ?>
                            <tr>
                                <td class="text-center"><?= $beverages->getBeverageId() ?></td>
                                <td class="text-center"><?= $beverages->getBeverageName() ?></a></td>
                                <td class="text-center"><?= number_format($beverages->getPrice()) . " VNĐ" ?></td>
                                <td class="text-center"><?= substr($beverages->getDescription(), 0, 50) . "..." ?></td>
                                <td class="text-center"><img style="object-fit: cover;" width="100" height="100" src="../../assets/img/<?= $beverages->getImage() ?>" alt="..." class="img-fluid rounded" /></a></td>
                                <td class="text-center"><?= $beverages->getCategoryId() ?></td>
                                <td class="d-flex justify-content-around ">
                                    <a href="show.php?beverage_id=<?= $beverages->getBeverageId() ?>?&page=<?= $page ?>" class="btn btn-sm btn-info">Xem</a>
                                    <a href="edit.php?beverage_id=<?= $beverages->getBeverageId() ?>?&page=<?= $page ?>" class="btn btn-sm btn-warning">Chỉnh sửa</a>
                                    <a href="delete.php?beverage_id=<?= $beverages->getBeverageId() ?>&page=<?= $page ?>" onclick="return confirm('Có xác nhận xóa?')" class="btn btn-sm btn-danger">Xóa</i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="clearfix d-flex align-items-center mt-3">
                    <div class="hint-text text-center">
                        Hiển thị <b>
                            <?= ($page - 1) * $perPage + 1 ?>
                        </b> đến <b>
                            <?= min($page * $perPage, $total) ?>
                        </b> trong <b><?= $total ?></b> đồ uống
                    </div>
                    <ul class="pagination d-flex justify-content-center ms-auto mt-4">
                        <li class="page-item">
                            <a href="?page=<?= ($page > 1) ? $page - 1 : $page; ?>" class="page-link">Trước</a>
                        </li>
                        <?= $beveragesRepository->createPageLinkBeverages($total, $perPage, $page); ?>
                        <li class="page-item">
                            <a href="?page=<?= ($page < $pageMax) ? $page + 1 : $page; ?>" class="page-link">Tiếp</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('../footer.php'); ?>