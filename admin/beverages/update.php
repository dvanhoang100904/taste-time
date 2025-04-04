<?php

require_once '../../models/beveragesRepository.php';
$beverage_id = $_POST['beverage_id'];
$beverage_name = $_POST['beverage_name'];
$price = $_POST['price'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$beveragesRepository = new BeveragesRepository();
$getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($beverage_id);
$getBeveragesByBeverageId->setBeverageName($beverage_name);
$getBeveragesByBeverageId->setPrice($price);
$getBeveragesByBeverageId->setDescription($description);
$getBeveragesByBeverageId->setCategoryId($category_id);

// Kiểm tra có upload ảnh mới không
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $image = basename($_FILES["image"]["name"]);
    $target_dir = "../../assets/img/";
    $target_file = $target_dir . $image;

    // Di chuyển ảnh
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Gán ảnh mới
    $getBeveragesByBeverageId->setImage($image);
}


$beveragesRepository->updateBeverages($getBeveragesByBeverageId);
header("location: read.php?page=" . $page);
