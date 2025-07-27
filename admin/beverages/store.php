<?php
require_once '../../models/BeveragesRepository.php';

// Lấy dữ liệu từ form gửi lên (method POST)
$beverage_name = $_POST['beverage_name'];
$price = $_POST['price'];
$description = $_POST['description'];
$image = basename($_FILES["image"]["name"]);
$category_id = $_POST['category_id'];

// Xác định số trang hiện tại (dùng khi quay lại trang danh sách sau khi thêm)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Thiết lập đường dẫn lưu ảnh
$target_dir = "../../assets/img/";
$target_file = $target_dir . $image;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Di chuyển file ảnh từ thư mục tạm sang thư mục lưu ảnh
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

// Khởi tạo BeveragesRepository và gọi hàm thêm đồ uống
$beverages = new Beverages(null, $beverage_name, $price, $description, $image, $category_id);
$BeveragesRepository = new BeveragesRepository();
$BeveragesRepository->addBeverages($beverages);

// Chuyển hướng về trang danh sách đồ uống (read.php) sau khi thêm thành công
header("location: read.php?page=" . $page);
