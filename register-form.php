<?php session_start(); ?>
<?php require_once 'header.php';
?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6 mx-auto">
                <h1 class="text-center mb-4 fw-bold">Tạo Tài Khoản</h1>
                <!-- Hiển thị thông báo lỗi hoặc thành công -->
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php elseif (isset($_GET['success'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php endif; ?>
                <form action="register.php" method="POST" class="bg-light p-5 rounded shadow">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên người dùng</label>
                        <input type="text" name="username" id="username" class="form-control rounded-pill" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control rounded-pill" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" name="password" class="form-control rounded-pill " required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-dark rounded-pill fw-bold">Tạo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once 'footer.php'; ?>