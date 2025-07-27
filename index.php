<?php
session_start();
require_once './models/beveragesRepository.php';
$beveragesRepository = new BeveragesRepository();
?>

<?php require_once 'header.php'; ?>

<header class="hero-banner bg-dark py-5 position-relative">
    <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
    <div class="container px-4 px-lg-5 my-5 position-relative z-index-1">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder mb-3 animate__animated animate__fadeInDown">Khám Phá Thế Giới Đồ Uống Giải Khát</h1>
            <p class="lead fw-normal text-white-50 mb-4 animate__animated animate__fadeIn animate__delay-1s">Cùng thưởng thức những loại đồ uống tươi mới và hấp dẫn nhất, giúp bạn thư giãn và tận hưởng cuộc sống.</p>
            <a href="result.php" class="btn btn-light btn-lg mt-3 animate__animated animate__fadeInUp animate__delay-1s">
                <i class="fas fa-glass-cheers me-2"></i> Chọn Đồ Uống Ngay
            </a>
        </div>
    </div>
</header>

<section class="py-5 featured-products">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="section-header text-center mb-5">
            <h2 class="fw-bold section-title">Đồ Uống Nổi Bật</h2>
            <p class="text-muted">Những lựa chọn phổ biến nhất của chúng tôi</p>
            <div class="divider mx-auto"></div>
        </div>

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            $limit = 8;
            $getBeveragesRandom = $beveragesRepository->getBeveragesRandom($limit);
            foreach ($getBeveragesRandom as $beverages) {
            ?>
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm product-card">
                        <!-- Badge giảm giá -->
                        <?php if (rand(0, 1)) { ?>
                            <div class="badge bg-danger text-white position-absolute sale-badge">Giảm 20%</div>
                        <?php } ?>

                        <a href="detail.php?beverage_id=<?= $beverages->getBeverageId(); ?>">
                            <img class="card-img-top product-image" src="./assets/img/<?= $beverages->getImage(); ?>" alt="<?= $beverages->getBeverageName(); ?>" />
                        </a>
                        <div class="card-body p-4 text-center">
                            <div class="product-category text-muted small mb-1">Đồ uống giải khát</div>
                            <h5 class="fw-bolder product-title">
                                <a href="detail.php?beverage_id=<?= $beverages->getBeverageId(); ?>" class="text-dark text-decoration-none"><?= $beverages->getBeverageName(); ?></a>
                            </h5>
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <!-- Rating stars -->
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= rand(3, 5)): ?>
                                        <i class="fas fa-star"></i>
                                    <?php else: ?>
                                        <i class="far fa-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            <div class="product-price">
                                <?php if (rand(0, 1)): ?>
                                    <span class="text-muted text-decoration-line-through me-2"><?= number_format($beverages->getPrice() * 1.2) ?> VNĐ</span>
                                <?php endif; ?>
                                <span class="fw-bold text-primary"><?= number_format($beverages->getPrice()) ?> VNĐ</span>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="text-center mt-4">
            <a href="result.php" class="btn btn-warning btn-lg">
                <i class="fas fa-list me-2"></i> Xem Tất Cả Đồ Uống
            </a>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="./assets/img/about.jpg" alt="Về chúng tôi" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Về Thương Hiệu Của Chúng Tôi</h2>
                <p class="lead text-muted mb-4">Mang đến những trải nghiệm đồ uống tuyệt vời nhất</p>
                <p>Chúng tôi tự hào là địa chỉ cung cấp các loại đồ uống giải khát chất lượng cao, nguyên liệu tươi ngon và công thức độc đáo. Mỗi sản phẩm là sự kết hợp hoàn hảo giữa hương vị truyền thống và nét hiện đại.</p>
                <ul class="list-unstyled mb-4">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Nguyên liệu tự nhiên, an toàn</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Quy trình chế biến đạt chuẩn</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Phục vụ tận tâm, chuyên nghiệp</li>
                </ul>
                <a href="#!" class="btn btn-outline-dark">Tìm hiểu thêm</a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>