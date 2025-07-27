<?php
require_once  '../../models/usersRepository.php';

$usersRepository = new UsersRepository();

$page = 1;
$perPage = 3;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$getAllUsers = $usersRepository->getAllUsers();
$total = count($getAllUsers);
$pageMax = ceil($total / $perPage);
$getAllUsersPage = $usersRepository->getAllUsersPage($page, $perPage);
?>
<?php require_once '../header.php' ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="table-wrapper">
                <div class="table-title mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Quản lý <b>Người dùng</b></h2>
                        <a href="create.php?page=<?= $page ?>" class="btn btn-success">
                            <i class="bi bi-pencil"></i><span>Thêm mới người dùng</span>
                        </a>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên người dùng</th>
                            <th class="text-center">Mật khẩu</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Mã vai trò</th>
                            <th class="text-center">Ngày tạo</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getAllUsersPage as $users) { ?>
                            <tr>
                                <td class="text-center"><?= $users->getUserId() ?></td>
                                <td class="text-center"><?= $users->getUsername() ?></td>
                                <td class="text-center"><?= $users->getPassword() ?></td>
                                <td class="text-center"><?= $users->getEmail() ?></td>
                                <td class="text-center"><?= $users->getRoleId() ?></td>
                                <td class="text-center"><?= $users->getCreatedAt() ?></td>
                                <td class="d-flex justify-content-around">
                                    <a href="edit.php?user_id=<?= $users->getUserId() ?>&page=<?= $page ?>" class="btn btn-sm btn-warning">
                                        Chỉnh sửa
                                    </a>
                                    <a href="delete.php?user_id=<?= $users->getUserId() ?>&page=<?= $page ?>" onclick="return confirm('Có xác nhận xóa?')" class="btn btn-sm btn-danger">
                                        Xóa</i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="clearfix d-flex align-items-center mt-3">
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
                        <?= $usersRepository->createPageLinkUsers($total, $perPage, $page); ?>
                        <li class="page-item">
                            <a href="?page=<?= ($page < $pageMax) ? $page + 1 : $page; ?>" class="page-link">Tiếp</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../footer.php'; ?>

</body>

</html>