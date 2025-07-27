<?php

// 1. Xử lý phiên bản và giỏ hàng
session_start();
require_once './models/beveragesRepository.php';

// Khởi tạo đối tượng BeveragesRepository để truy xuất dữ liệu đồ uống
$beveragesRepository = new BeveragesRepository();

// Nếu giỏ hàng chưa tồn tại trong session, khởi tạo mảng trống
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 2. Xử lý xóa sản phẩm khỏi giỏ
// Nếu URL có tham số remove, xóa sản phẩm theo id khỏi giỏ
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
}

// 3. Xử lý tăng / giảm số lượng sản phẩm
if (isset($_POST['action']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Tăng số lượng sản phẩm lên 1
    if ($_POST['action'] === 'cong') {

        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    } elseif ($_POST['action'] === 'tru') {

        // Giảm số lượng sản phẩm đi 1
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] -= 1;

            // Nếu số lượng <= 0 thì xóa luôn sản phẩm đó
            if ($_SESSION['cart'][$id] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
    }

    // Sau khi xử lý tăng/giảm thì chuyển hướng về trang cart
    header("Location: cart.php");
    exit();
}

// 4. Xử lý thêm sản phẩm với số lượng cụ thể
if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $id = $_POST['id'];
    $quantity = (int)$_POST['quantity'];

    // Nếu sản phẩm đã có trong giỏ thì cộng thêm
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] += $quantity;
    } else {

        // Nếu chưa có thì thêm mới
        $_SESSION['cart'][$id] = $quantity;
    }
    header("Location: cart.php");
}

// 5. Tính tổng số lượng sản phẩm trong giỏ
$totalCart = 0;
if (isset($_SESSION['cart'])) {

    // Lưu vào biến tạm để dễ xử lý
    $cart = $_SESSION['cart'];

    // Tổng số lượng sản phẩm trong giỏ
    $totalCart = array_sum($cart);
}
?>
<?php require_once 'header.php'; ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5 border border-secondary py-4 rounded">
        <h2 class="text-center mb-4">Giỏ Hàng <strong>Đồ Uống <span class="badge bg-dark text-white ms-1 rounded-pill"><?= isset($totalCart) ? $totalCart : 0 ?></span></strong></h2>
        <?php
        $totalPrice = 0;
        if ($_SESSION['cart'] != null) {
        ?>
            <div class="row">
                <?php
                // Lấy tất cả sản phẩm từ CSDL
                $getAllBeverages = $beveragesRepository->getAllBeverages();
                // Duyệt toàn bộ sản phẩm từ CSDL
                foreach ($getAllBeverages as $beverages) {
                    foreach ($cart as $id => $quantity) {
                        // Nếu sản phẩm trong giỏ trùng với sản phẩm trong CSDL => hiển thị
                        if ($beverages->getBeverageId() == $id) {
                ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="card shadow-sm border-0 rounded-3 d-flex flex-column align-items-center p-3 h-100" style="overflow: hidden;">
                                    <a href="detail.php?beverage_id=<?= $beverages->getBeverageId() ?>" class="text-center">
                                        <img src="./assets/img/<?= $beverages->getImage() ?>" alt="Beverage Image" class="img-fluid rounded mb-3" style="width: 100%; max-height: 150px; object-fit: cover;" alt="<?= $beverages->getBeverageName() ?>">
                                    </a>
                                    <div class="text-center mb-3">
                                        <h5 class="fw-bold"><a href="detail.php?beverage_id=<?= $beverages->getBeverageId() ?>" class="text-dark text-decoration-none"><?= $beverages->getBeverageName() ?></a></h5>
                                        <p class="text-muted small"><?= substr($beverages->getDescription(), 0, 30) . "..." ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                                        <h5 class="text-dark"><?= number_format($beverages->getPrice()) . " VNĐ" ?></h5>
                                        <div class="d-flex align-items-center">
                                            <form action="cart.php" method="post" class="d-inline">
                                                <input type="hidden" name="action" value="tru">
                                                <input type="hidden" name="id" value="<?= $beverages->getBeverageId() ?>">
                                                <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                                            </form>
                                            <span class="mx-3 fw-bold"><?= $quantity ?></span>
                                            <form action="cart.php" method="post" class="d-inline">
                                                <input type="hidden" name="action" value="cong">
                                                <input type="hidden" name="id" value="<?= $beverages->getBeverageId() ?>">
                                                <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="cart.php?remove=<?= $id ?>" class="btn btn-outline-danger btn-sm rounded"><i class="fa-solid fa-trash"></i> </a>
                                    </div>
                                </div>
                            </div>
                <?php
                            // Cộng tổng tiền
                            $totalPrice += $beverages->getPrice() * $quantity;
                        };
                    };
                };
                ?>
            </div>
            <!-- 7. Hiển thị tổng tiền và nút thanh toán -->
            <div class="text-end mt-4 mb-4">
                <h4 class="text-dark fw-bold fs-4">Tổng Tiền: <span class="text-dark"><?= number_format($totalPrice) . " VNĐ" ?></span></h4>
            </div>
        <?php
        } else {
            echo "<h6 class='text-center text-danger'>GIỎ HÀNG TRỐNG !!!</h6>";
        }
        ?>
    </div>
    <div class="text-center mt-3">
        <a href="checkout.php" class="btn btn-lg btn-success fw-bold">Tiến hành thanh toán</a>
    </div>
</section>
<?php require_once 'footer.php'; ?>