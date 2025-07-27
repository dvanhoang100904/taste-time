<?php

require_once '../../models/beveragesRepository.php';

$beveragesRepository = new BeveragesRepository();

// Lấy beverage_id từ URL (phương thức GET)
$beverage_id = $_GET['beverage_id'];

// Lấy số trang hiện tại (nếu có), phục vụ cho việc chuyển hướng sau khi xóa
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Lấy thông tin đồ uống theo ID
$getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($beverage_id);

if ($getBeveragesByBeverageId) {

    // Lấy tên file ảnh từ đối tượng
    $imageFileName = $getBeveragesByBeverageId->getImage();

    // Đường dẫn thư mục ảnh gốc và thư mục sao lưu
    $target_dir = "../../assets/img/";
    $backup_dir = "../../assets/img/backup/";

    // Tạo đường dẫn đầy đủ đến file ảnh
    $target_file = $target_dir . basename($imageFileName);
    $backup_file = $backup_dir . basename($imageFileName);

    // Kiểm tra nếu file ảnh tồn tại
    if (file_exists($target_file)) {
        // Sao lưu file trước khi xóa
        if (copy($target_file, $backup_file)) {
            // Sao lưu thành công, tiến hành xóa file
            if (unlink($target_file)) {
                echo "File deleted successfully!";
            } else {
                echo "Unable to delete the file!";
            }
        } else {
            echo "Failed to backup the file!";
        }
    } else {
        echo "File not found!";
    }

    // Gọi phương thức xóa sản phẩm trong CSDL
    $deleteBeverages = $beveragesRepository->deleteBeverages($beverage_id);
    if ($deleteBeverages) {
        echo "Deleted successfully!";

        // Chuyển hướng về trang danh sách sản phẩm
        header("location: read.php?page=" . $page);
    } else {
        echo "Failed to delete product!";
    }
} else {
    echo "Product not found!";
}
