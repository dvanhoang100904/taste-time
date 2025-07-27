<?php
require_once './models/usersRepository.php';

// Kiểm tra nếu form gửi lên đầy đủ 3 trường: username, email và password
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

    // Lấy dữ liệu từ form và xử lý an toàn đầu vào
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(md5($_POST['password']));

    // Tạo đối tượng usersRepository để truy xuất dữ liệu người dùng
    $usersRepository = new UsersRepository();

    // Kiểm tra xem email đã tồn tại trong hệ thống chưa
    $kiemTraEmail = $usersRepository->kiemTraEmail($email);
    if ($kiemTraEmail) {

        // Nếu email đã tồn tại, chuyển về trang đăng ký kèm thông báo lỗi
        header('Location: register-form.php?error=Email đã tồn tại');
    } else {

        // Nếu email chưa tồn tại, tiến hành đăng ký tài khoản
        $register = $usersRepository->register($username, $email, $password);
        if ($register) {

            // Nếu đăng ký thành công, chuyển về trang đăng ký kèm thông báo thành công
            header('Location: register-form.php?success=Đăng ký thành công');
        } else {

            // Nếu có lỗi trong quá trình đăng ký
            header('Location: register-form.php?error=Đăng ký không thành công');
        }
    }
}
