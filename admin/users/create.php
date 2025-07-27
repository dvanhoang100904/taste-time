<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
?>
<?php require_once('../header.php'); ?>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white">
                <h2 class="mb-0">Thêm mới <strong>Người dùng</strong></h2>
            </div>
            <form action="store.php?page=<?= $page ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên người dùng: </label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="mb-3">
                        <labe class="form-label">Mật khẩu: </labe>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email: </label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mã vai trò: </label>
                        <input type="number" class="form-control" name="role_id" required>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="read.php?page=<?= $page ?>" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-success">Thêm </button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php require_once('../footer.php'); ?>