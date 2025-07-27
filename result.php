<?php
require_once './models/beveragesRepository.php';
session_start();

// Khởi tạo đối tượng BeveragesRepository để truy xuất dữ liệu đồ uống
$beveragesRepository = new BeveragesRepository();

// Trang hiện tại
$page = 1;

// Số lượng sản phẩm mỗi trang
$perPage = 12;

// Từ khóa tìm kiếm mặc định
$key = "";

// Nếu có từ khóa tìm kiếm từ URL (GET), gán vào biến $key
if (isset($_GET['key'])) {
    $key = $_GET['key'];
}

// Nếu có tham số trang từ URL, gán vào biến $page
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

// Tìm tất cả sản phẩm phù hợp với từ khóa (dùng để tính tổng kết quả)
$searchBeverages = $beveragesRepository->searchBeverages($key);

// Tính tổng số kết quả tìm được
$total = count($searchBeverages);

// Tính tổng số trang (dùng cho phân trang)
$pageMax = ceil($total / $perPage);

// Lấy danh sách sản phẩm theo trang hiện tại (danh sách được phân trang)
$searchBeveragesPage = $beveragesRepository->searchBeveragesPage($key, $page, $perPage);

// Nếu có lọc theo danh mục (category_id), override danh sách sản phẩm theo danh mục đó
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Gọi hàm lấy sản phẩm theo category_id và giới hạn 8 sản phẩm
    $searchBeveragesPage = $beveragesRepository->getBeveragesByCategoryId($category_id, 8);
}

?>

<?php require_once 'header.php'; ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($searchBeveragesPage as $beverages) { ?>
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm">
                        <a href="detail.php?beverage_id=<?= $beverages->getBeverageId(); ?>">
                            <img class="card-img-top" src="./assets/img/<?= $beverages->getImage(); ?>" alt="Beverage Image" />
                        </a>
                        <div class="card-body p-4 text-center">
                            <h5 class="fw-bolder">
                                <a href="detail.php?beverage_id=<?= $beverages->getBeverageId(); ?>" class="text-dark text-decoration-none"><?= $beverages->getBeverageName(); ?></a>
                            </h5>
                            <p class="text-muted mb-2"><?= number_format($beverages->getPrice()) . " VNĐ"; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="clearfix d-flex align-items-center mt-2">
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
                <?= $beveragesRepository->createPageLinkSearchBeverages($total, $perPage, $page, $key); ?>
                <li class="page-item">
                    <a href="?page=<?= ($page < $pageMax) ? $page + 1 : $page; ?>" class="page-link">Tiếp</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<?php require_once 'footer.php'; ?>