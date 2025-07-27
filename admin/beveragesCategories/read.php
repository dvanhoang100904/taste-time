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
<?php require_once '../header.php' ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="table-wrapper">
                <div class="table-title mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Quản lý <b>Loại đồ uống</b></h2>
                        <a href="create.php?page=<?= $page ?>" class="btn btn-success">
                            <i class="bi bi-pencil"></i><span>Thêm mới loại đồ uống</span>
                        </a>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên loại đồ uống</th>
                            <th class="text-center">Mô tả</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($getAllBeveragesCategoriesPage as $beveragesCategories) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $beveragesCategories->getCategoryId() ?></td>
                                <td class="text-center"><?= $beveragesCategories->getCategoryName() ?></td>
                                <td class="text-center"><?= substr($beveragesCategories->getDescription(), 0, 100) . "..." ?></td>
                                <td class="d-flex justify-content-around gap-2">
                                    <a href="edit.php?category_id=<?= $beveragesCategories->getCategoryId() ?>&page=<?= $page ?>" class="btn btn-sm btn-warning">
                                        Chỉnh sửa
                                    </a>
                                    <a href="delete.php?category_id=<?= $beveragesCategories->getCategoryId() ?>&page= <?= $page ?>" onclick="return confirm('Có xác nhận xóa?')" class="btn btn-sm btn-danger">
                                        Xóa
                                    </a>
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
                    <ul class="pagination d-flex justify-content-center ms-auto mt-3">
                        <li class="page-item">
                            <a href="?page=<?= ($page > 1) ? $page - 1 : $page; ?>" class="page-link">Trước</a>
                        </li>
                        <?= $beveragesCategoriesRepository->createPageLinkBeveragesCategories($total, $perPage, $page); ?>
                        <li class="page-item">
                            <a href="?page=<?= ($page < $pageMax) ? $page + 1 : $page; ?>" class="page-link">Tiếp</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once '../footer.php'; ?>