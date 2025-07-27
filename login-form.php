<?php session_start(); ?>
<?php require_once 'header.php'; ?>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6 mx-auto">
                <h1 class="text-center mb-4 fw-bold">Đăng Nhập</h1>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>
                <form action="login.php" method="POST" class="bg-light p-5 rounded shadow ">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control rounded-pill" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" name="password" id="password" class="form-control rounded-pill" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-dark rounded-pill fw-bold">Đăng Nhập</button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <p class="mb-0"><a href="register-form.php" class="text-dark text-decoration-none" href="register-register.php">Tạo Tài Khoản</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once 'footer.php'; ?>