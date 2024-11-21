<?php

require_once '../../models/usersRepository.php';

$usersRepository = new UsersRepository();

$user_id = $_GET['user_id'];
$getUsersByUserId = $usersRepository->getUsersByUserId($user_id);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Taste Time</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/icon/icon-taste-time.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../assets/css/styles.css" rel="stylesheet" />
</head>

<body>

    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="card shadow-sm">
                <div class="card-header bg-warning ">
                    <h4 class="card-title">Edit <strong>Users</strong></h4>
                </div>
                <form action="update.php?page=<?= $page ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="<?= $getUsersByUserId->getUserId() ?>">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" required name="username" value="<?= $getUsersByUserId->getUsername() ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" required name="password" value="<?= $getUsersByUserId->getPassword() ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required name="email" value="<?= $getUsersByUserId->getEmail() ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role id</label>
                            <input type="number" class="form-control" required name="role_id" value="<?= $getUsersByUserId->getRoleId() ?>">
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="read.php?page=<?= $page ?>" class="btn btn-secondary">Cancel</a>
                        <input type="submit" class="btn btn-warning" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>

</html>