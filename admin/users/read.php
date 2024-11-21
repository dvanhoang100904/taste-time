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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/icon/icon-taste-time.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <title>Taste Time</title>
</head>

<body>
    <?php require_once '../header.php' ?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="table-wrapper">
                    <div class="table-title mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>Manage <b>Users</b></h2>
                            <a href="create.php?page=<?= $page ?>" class="btn btn-success">
                                <i class="bi bi-pencil"></i><span>Add New Users</span>
                            </a>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">User Id</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Password</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Role id</th>
                                <th class="text-center">Created at</th>
                                <th class="text-center">Action</th>
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
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="delete.php?user_id=<?= $users->getUserId() ?>&page=<?= $page ?>" onclick="return confirm('Có xác nhận xóa?')" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="clearfix justify-content-center mt-3">
                        <div class="hint-text text-center ">
                            Showing <b>
                                <?= ($page - 1) * $perPage + 1 ?>
                            </b> to <b>
                                <?= min($page * $perPage, $total) ?>
                            </b> out of <b><?= $total ?></b> entries
                        </div>
                        <ul class="pagination d-flex justify-content-center mt-3">
                            <li class="page-item">
                                <a href="?page=<?= ($page > 1) ? $page - 1 : $page; ?>" class="page-link">Previous</a>
                            </li>
                            <?= $usersRepository->createPageLinkUsers($total, $perPage, $page); ?>
                            <li class="page-item">
                                <a href="?page=<?= ($page < $pageMax) ? $page + 1 : $page; ?>" class="page-link">Next</a>
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