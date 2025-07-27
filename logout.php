<?php
session_start();

// Xóa toàn bộ biến session (nhưng không hủy session ID)
session_unset();

// Hủy toàn bộ session (bao gồm cả session ID)
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập
header('Location: login-form.php');
exit();
