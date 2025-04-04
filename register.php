<?php
require_once './models/usersRepository.php';

if (isset($_POST['username']) && isset($_POST['email']) &&  isset($_POST['password'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(md5($_POST['password']));

    // Kiểm tra xem email đã tồn tại chưa
    $usersRepository = new UsersRepository();
    $kiemTraEmail = $usersRepository->kiemTraEmail($email);
    if ($kiemTraEmail) {
        header('Location: register-form.php?error=Email đã tồn tại');
    } else {
        $register = $usersRepository->register($username, $email, $password);
        if ($register) {
            header('Location: register-form.php?success=Đăng ký thành công');
        } else {
            header('Location: register-form.php?error=Đăng ký không thành công');
        }
    }
}
