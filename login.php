<?php
require_once './models/usersRepository.php';



// Kiểm tra nếu người dùng đã gửi email và mật khẩu từ form
if (isset($_POST['email']) && isset($_POST['password'])) {

    // Lấy dữ liệu từ form và làm sạch đầu vào
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars(md5($_POST['password']));

    // Khởi tạo đối tượng UsersRepository để truy xuất dữ liệu người dùng
    $usersRepository = new UsersRepository();

    // Kiểm tra xem email đã tồn tại trong hệ thống chưa
    if ($usersRepository->kiemTraEmail($email)) {

        // Nếu email tồn tại, tiếp tục kiểm tra đăng nhập
        $login = $usersRepository->login($email, $password);
        if ($login != null) {

            // Nếu thông tin đăng nhập chính xác → tạo session
            session_start();
            $_SESSION['email'] = $login->getEmail();
            $_SESSION['username'] = $login->getUsername();
            $_SESSION['role_id'] = $login->getRoleId();

            // Điều hướng dựa trên quyền (role_id)
            if ($_SESSION['role_id'] == '100') {

                // Admin đăng nhập chuyển tới trang quản trị
                header('Location: ./admin/beverages/read.php');
            } else {

                // Người dùng thường về trang chủ
                header('Location: index.php');
            }
        } else {

            // Nếu sai mật khẩu
            header('Location: login-form.php?error=Mật khẩu không chính xác');
        }
    } else {

        // Nếu email chưa tồn tại trong hệ thống
        header('Location: login-form.php?error=Tài khoản không tồn tại, vui lòng tạo tài khoản!');
    }
}
