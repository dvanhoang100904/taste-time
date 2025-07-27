<?php

require_once '../../models/usersRepository.php';

$usersRepository = new UsersRepository();

$user_id = $_GET['user_id'];
$getUsersByUserId = $usersRepository->getUsersByUserId($user_id);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>
<?php require_once('../header.php'); ?>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-warning ">
                <h4 class="card-title">Chỉnh sửa <strong>Người dùng</strong></h4>
            </div>
            <form action="update.php?page=<?= $page ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="user_id" value="<?= $getUsersByUserId->getUserId() ?>">
                    <div class="mb-3">
                        <label class="form-label">Tên người dùng: </label>
                        <input type="text" class="form-control" required name="username" value="<?= $getUsersByUserId->getUsername() ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu: </label>
                        <input type="password" class="form-control" required name="password" value="<?= $getUsersByUserId->getPassword() ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email: </label>
                        <input type="email" class="form-control" required name="email" value="<?= $getUsersByUserId->getEmail() ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mã vai trò: </label>
                        <input type="number" class="form-control" required name="role_id" value="<?= $getUsersByUserId->getRoleId() ?>">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="read.php?page=<?= $page ?>" class="btn btn-secondary">Quay lại</a>
                    <input type="submit" class="btn btn-warning" value="Lưu">
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('../footer.php'); ?>