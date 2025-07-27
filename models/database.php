<?php
require_once 'config.php';

// Định nghĩa lớp Database để quản lý kết nối đến cơ sở dữ liệu
class Database
{
    // Thuộc tính tĩnh để giữ đối tượng kết nối dùng chung cho tất cả các instance
    public static $connection;

    // Hàm khởi tạo - gọi khi khởi tạo đối tượng từ lớp Database
    public function __construct()
    {
        // Nếu chưa có kết nối nào được tạo
        if (!self::$connection) {
            // Tạo kết nối mới đến cơ sở dữ liệu bằng MySQLi
            self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, PORT);
            // Thiết lập bảng mã ký tự cho kết nối
            self::$connection->set_charset(DB_CHARSET);
        }
        // Trả về đối tượng kết nối
        return self::$connection;
    }
}
