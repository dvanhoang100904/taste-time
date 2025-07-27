<?php
session_start();
require_once './models/beveragesRepository.php';
require_once './models/beveragesCategoriesRepository.php';

// Khởi tạo các Repository để truy xuất dữ liệu
$beveragesRepository = new BeveragesRepository();
$beveragesCategoriesRepository = new BeveragesCategoriesRepository();

// Lấy id đồ uống từ URL
$beverage_id = $_GET['beverage_id'];

// Lấy thông tin đồ uống theo id
$getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($beverage_id);

// Lấy thông tin danh mục (category) của đồ uống
$category_id = $getBeveragesByBeverageId->getCategoryId();
$getBeveragesCategoriesByCategoryId = $beveragesCategoriesRepository->getBeveragesCategoriesByCategoryId($category_id);

?>
<?php require_once 'header.php'; ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-start">
            <div class="col-md-6 detail" style="display: flex; justify-content: center; align-items: center;">
                <img class="img-fluid mb-5 mb-md-0 rounded" src="./assets/img/<?= $getBeveragesByBeverageId->getImage(); ?>" alt="Beverage Image" style="object-fit: cover; height: 400px; width: 100%;" />
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-between" style="min-height: 400px;">
                <div>
                    <div class="small mb-1 text-muted fs-5">Loại Đồ uống: <a href="result.php?category_id=<?= $getBeveragesCategoriesByCategoryId->getCategoryId() ?>" class="text-dark text-decoration-none"><?= $getBeveragesCategoriesByCategoryId->getCategoryName() ?></a></div>
                    <h1 class="display-5 fw-bolder"><?= $getBeveragesByBeverageId->getBeverageName(); ?></h1>
                    <div class="fs-5 mb-3">
                        <span><?= number_format($getBeveragesByBeverageId->getPrice()) . " VNĐ"; ?></span>
                    </div>
                    <p class="lead"><?= substr($getBeveragesByBeverageId->getDescription(), 0, 150) . "..."; ?></p>
                    <div class="d-flex align-items-center">
                        <form action="cart.php" method="post" class="d-flex align-items-center">
                            <input class="form-control text-center me-3" name="quantity" type="number" min="1" value="1" style="max-width: 4rem;" />
                            <input type="hidden" name="id" value="<?= $getBeveragesByBeverageId->getBeverageId(); ?>" />
                            <button type="submit" class="btn btn-dark rounded-pill cart">
                                <i class="fa fa-shopping-cart me-1"></i> Thêm Vào Giỏ
                            </button>
                        </form>
                    </div>
                </div>
                <div class="mt-auto">
                    <div class="reviews mt-5">
                        <h3 class="mb-3 fw-bold">Đánh giá </h3>
                        <div class="rating mb-3">
                            <span class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                        </div>
                        <p class="text-muted mb-4">Chưa có đánh giá nào.</p>
                        <form action="#!" method="POST">
                            <div class="mb-3">
                                <label for="rating" class="form-label">Chọn đánh giá:</label>
                                <select class="form-select" id="rating" name="rating" required>
                                    <option value="1">1 sao</option>
                                    <option value="2">2 sao</option>
                                    <option value="3">3 sao</option>
                                    <option value="4">4 sao</option>
                                    <option value="5">5 sao</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="review" class="form-label">Nhận xét:</label>
                                <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-lg btn-dark rounded-pill btn-sm">Gửi đánh giá</button>
                        </form>
                    </div>
                    <div class="similar-products mt-5">
                        <h3 class="text-dark fw-bold">Đồ uống tương tự</h3>
                        <div class="row">
                            <?php
                            $limit = 4;
                            $getBeveragesByCategoryId = $beveragesRepository->getBeveragesByCategoryId($category_id, $limit);
                            foreach ($getBeveragesByCategoryId as $beverages) {
                                if ($beverages->getBeverageId() != $getBeveragesByBeverageId->getBeverageId()) {
                            ?>
                                    <div class="col-12 col-md-3 col-lg-3 mb-4">
                                        <div class="card h-100">
                                            <a href="detail.php?beverage_id=<?= $beverages->getBeverageId() ?>">
                                                <img src="./assets/img/<?= $beverages->getImage() ?>" class="card-img-top" alt="Beverage Image"
                                                    style="object-fit: cover; width: 100%; height: 100px;">
                                            </a>
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title fs-6"><a class="text-dark text-decoration-none" href="detail.php?beverage_id=<?= $beverages->getBeverageId() ?>"><?= $beverages->getBeverageName() ?></a></h5>
                                                <p class="card-text fs-6"><?= number_format($beverages->getPrice()) . " VNĐ" ?></p>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="social-share mt-5">
                        <h4 class="mb-3 fw-bold">Chia sẻ</h4>
                        <!-- test ngrok thay url -->
                        <?php $url = "https://e6bc-113-185-78-210.ngrok-free.app"; ?>
                        <div class="d-flex gap-3">
                            <a href="https://facebook.com/sharer/sharer.php?u=<?= urlencode($url . '/taste-time/detail.php?beverage_id=' . $getBeveragesByBeverageId->getBeverageId()) ?>" target="_blank" class="btn btn-secondary text-white">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?= urlencode($url . '/taste-time/detail.php?ma=' . $getBeveragesByBeverageId->getBeverageId()) ?>" target="_blank" class="btn btn-secondary text-white">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text=<?= urlencode($url . '/taste-time/detail.php?ma=' . $getBeveragesByBeverageId->getBeverageId()) ?>" target="_blank" class="btn btn-secondary text-white">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once 'footer.php'; ?>