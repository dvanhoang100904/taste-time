<?php

require_once '../../models/beveragesRepository.php';

// Lấy dữ liệu từ biểu mẫu POST gửi lên
$beverage_id = $_POST['beverage_id'];
$beverage_name = $_POST['beverage_name'];
$price = $_POST['price'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];

// Lấy trang hiện tại để quay lại sau khi cập nhật
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Khởi tạo BeveragesRepository và lấy sản phẩm theo ID
$beveragesRepository = new BeveragesRepository();
$getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($beverage_id);

// Gán lại các giá trị mới từ form vào đối tượng sản phẩm
$getBeveragesByBeverageId->setBeverageName($beverage_name);
$getBeveragesByBeverageId->setPrice($price);
$getBeveragesByBeverageId->setDescription($description);
$getBeveragesByBeverageId->setCategoryId($category_id);

// Kiểm tra xem người dùng có upload ảnh mới hay không
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    // Lấy tên file ảnh
    $image = basename($_FILES["image"]["name"]);
    $target_dir = "../../assets/img/";
    $target_file = $target_dir . $image;

    // Di chuyển file ảnh từ thư mục tạm sang thư mục đích
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Cập nhật tên ảnh mới vào đối tượng
    $getBeveragesByBeverageId->setImage($image);
}

// Gọi phương thức cập nhật sản phẩm trong CSDL
$beveragesRepository->updateBeverages($getBeveragesByBeverageId);

// Quay lại trang danh sách sản phẩm
header("location: read.php?page=" . $page);
