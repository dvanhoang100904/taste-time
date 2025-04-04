<?php
require_once './models/usersRepository.php';

$usersRepository = new UsersRepository();

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars(md5($_POST['password']));

    if ($usersRepository->kiemTraEmail($email)) {
        $login = $usersRepository->login($email, $password);
        if ($login != null) {
            session_start();
            $_SESSION['email'] = $login->getEmail();
            $_SESSION['username'] = $login->getUsername();
            $_SESSION['role_id'] = $login->getRoleId();
            if ($_SESSION['role_id'] == '100') {
                header('Location: ./admin/beverages/read.php');
            } else {
                header('Location: index.php');
            }
        } else {
            header('Location: login-form.php?error=Mật khẩu không chính xác');
        }
    } else {
        header('Location: login-form.php?error=Tài khoản không tồn tại, vui lòng tạo tài khoản!');
    }
}
