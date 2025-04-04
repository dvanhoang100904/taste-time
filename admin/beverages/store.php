<?php
require_once '../../models/BeveragesRepository.php';

$beverage_name = $_POST['beverage_name'];
$price = $_POST['price'];
$description = $_POST['description'];
$image = basename($_FILES["image"]["name"]);
$category_id = $_POST['category_id'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$target_dir = "../../assets/img/";
$target_file = $target_dir . $image;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
$beverages = new Beverages(null, $beverage_name, $price, $description, $image, $category_id);
$BeveragesRepository = new BeveragesRepository();
$BeveragesRepository->addBeverages($beverages);
header("location: read.php?page=" . $page);
