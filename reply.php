<?php
session_start();
require_once 'header.php';
?>
<br>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg" style="max-width: 600px;">
        <div class="card-body text-center p-5">
            <!-- Biểu tượng checkmark xanh -->
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#28a745" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
            </div>

            <h2 class="mb-3 text-success">Thanh toán thành công!</h2>
            <p class="lead mb-4">Cảm ơn bạn đã đặt hàng. Chúng tôi đã nhận được đơn đặt hàng của bạn.</p>

            <div class="alert alert-info mb-4">
                <h5 class="alert-heading">Thông tin đơn hàng</h5>
                <p>Một email xác nhận đã được gửi đến địa chỉ email bạn cung cấp.</p>
                <p>Nhân viên của chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</p>
            </div>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="index.php" class="btn btn-success btn-lg px-4 gap-3">Tiếp tục mua hàng</a>
                <a href="#!" class="btn btn-outline-secondary btn-lg px-4">Liên hệ hỗ trợ</a>
            </div>

            <hr class="my-4">

            <div class="text-muted small">
                <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua:</p>
                <p>Email: support@example.com | Điện thoại: 0123.456.789</p>
            </div>
        </div>
    </div>
</div>
<br>
<?php require_once 'footer.php'; ?>