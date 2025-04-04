<?php

require_once '../../models/beveragesRepository.php';

$beveragesRepository = new BeveragesRepository();
$beverage_id = $_GET['beverage_id'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($beverage_id);

if ($getBeveragesByBeverageId) {
    $imageFileName = $getBeveragesByBeverageId->getImage();
    $target_dir = "../../assets/img/";
    $backup_dir = "../../assets/img/backup/";

    $target_file = $target_dir . basename($imageFileName);
    $backup_file = $backup_dir . basename($imageFileName);

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

    // Xóa sản phẩm khỏi cơ sở dữ liệu
    $deleteBeverages = $beveragesRepository->deleteBeverages($beverage_id);
    if ($deleteBeverages) {
        echo "Deleted successfully!";
        header("location: read.php?page=" . $page);
    } else {
        echo "Failed to delete product!";
    }
} else {
    echo "Product not found!";
}
