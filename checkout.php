<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 1. Autoload thư viện PHPMailer
require 'vendor/autoload.php';

session_start();
require_once './models/beveragesRepository.php';

$beveragesRepository = new BeveragesRepository();

// 2. Tính tổng đơn hàng

$totalPrice = 0;

$cartEmpty = false;

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    $cart = $_SESSION['cart'];
    foreach ($cart as $id => $quantity) {
        $getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($id);
        $getPrice = $getBeveragesByBeverageId->getPrice();
        $totalPrice += $getPrice * $quantity;
    }
} else {
    $cartEmpty = true;
}

// 3. Xử lý khi người dùng nhấn “Xác Nhận”
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);

    if (!$email || !kiemTraEmailDomain($email)) {
        $error_message = "Địa chỉ email không hợp lệ hoặc không tồn tại.";
    } else {
        $to = "daovanhoang2004@gmail.com";
        $subject = "Đơn hàng từ $username";

        // 5. Nội dung email
        $message = "Thông tin đơn hàng:\n";
        foreach ($cart as $id => $quantity) {
            $getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($id);
            $getBeverageName = $getBeveragesByBeverageId->getBeverageName();
            $getPrice = $getBeveragesByBeverageId->getPrice();
            $message .= "Tên: $getBeverageName, Số lượng: $quantity, Giá: " . number_format($getPrice) . " VNĐ, Tổng giá: " . number_format($getPrice * $quantity) . " VNĐ\n";
        }
        $message .= "Tổng tiền: " . number_format($totalPrice) . " VNĐ\n\n";
        $message .= "Thông tin người mua:\n";
        $message .= "Họ tên: $username\nEmail: $email\nSố điện thoại: $phone\nĐịa chỉ: $address\n";

        //  4. Gửi email hóa đơn
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'daovanhoang2004@gmail.com';
            $mail->Password = 'nded bcsc leaw cnhi';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email gửi
            $mail->setFrom('daovanhoang2004@gmail.com', 'Đào Văn Hoàng');

            // Email người nhận
            $mail->addAddress($to, "Đào Văn Hoàng");

            // Email phản hồi 
            $mail->addReplyTo($email, $username);

            // Nội dung email
            $mail->Subject = $subject;
            $mail->Body = $message;

            // 6. Nếu gửi thành công
            // Gửi email
            $mail->send();
            unset($_SESSION['cart']);
            header("Location: reply.php");
        } catch (Exception $e) {
            $error_message = "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
        }
    }
}

function kiemTraEmailDomain($email)
{
    $domain = substr(strrchr($email, "@"), 1);
    if (!checkdnsrr($domain, "MX")) {
        return false;
    }
    if (strpos($domain, 'gmail.com') !== false) {
        return true;
    }
    return false;
}
?>

<?php require_once 'header.php'; ?>
<BR>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h2 class="mb-0 text-center">Hóa Đơn Thanh Toán</h2>
        </div>
        <div class="card-body">
            <?php if ($cartEmpty) { ?>
                <div class="alert alert-warning text-center mb-4">Giỏ hàng của bạn hiện tại trống. thêm đồ uống vào giỏ hàng trước khi thanh toán.</div>
            <?php } else { ?>
                <h4 class="mb-3 mt-2 fw-bold fs-4">Thông tin đồ uống</h4>
                <table class="table table-striped table-bordered mb-2">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Nước uống</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $id => $quantity) {
                            $getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($id);
                            $getPrice = $getBeveragesByBeverageId->getPrice();
                            $getBeverageName = $getBeveragesByBeverageId->getBeverageName();

                        ?>
                            <tr>
                                <td class="text-center"><?= $getBeverageName; ?></td>
                                <td class="text-center"><?= $quantity; ?></td>
                                <td class="text-center"><?= number_format($getPrice) . " VNĐ" ?> </td>
                                <td class="text-center"><?= number_format($getPrice * $quantity) . " VNĐ"; ?> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="text-end mt-4 mb-4">
                    <h4 class="text-dark fs-6 fw-bold">Tổng Tiền: <span class="text-dark"><?= number_format($totalPrice) . " VNĐ" ?></span></h4>
                </div>
                <h4 class="mb-3 fw-bold fs-4">Thông tin khách hàng</h4>
                <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger mb-4"><?= $error_message ?></div>
                <?php } ?>
                <form action="checkout.php" method="POST" class="checkout-form">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Họ Và Tên: </label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email: </label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="phone" class="form-label">Số điện thoại: </label>
                            <input type="number" name="phone" id="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="address" class="form-label">Địa chỉ: </label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-success fw-bold">Xác Nhận</button>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
<br>
<?php require_once 'footer.php'; ?>