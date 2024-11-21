<?php
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
    <link rel="icon" type="image/x-icon" href="../../assets/icon/icon-taste-time.icobd268" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../assets/css/styles.css" rel="stylesheet" />
</head>

<body>

    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">
                    <h2 class="mb-0">Add New <strong>Users</strong></h2>
                </div>
                <form action="store.php?page=<?= $page ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <labe class="form-label">Password</labe>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role id</label>
                            <input type="number" class="form-control" name="role_id" required>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="read.php?page=<?= $page ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Add </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>

</html>