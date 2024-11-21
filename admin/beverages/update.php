<?php

require_once '../../models/beveragesRepository.php';
$beverage_id = $_POST['beverage_id'];
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
$beveragesRepository = new BeveragesRepository();
$getBeveragesByBeverageId = $beveragesRepository->getBeveragesByBeverageId($beverage_id);
$getBeveragesByBeverageId->setBeverageName($beverage_name);
$getBeveragesByBeverageId->setPrice($price);
$getBeveragesByBeverageId->setDescription($description);
$getBeveragesByBeverageId->setImage($image);
$getBeveragesByBeverageId->setCategoryId($category_id);
$beveragesRepository->updateBeverages($getBeveragesByBeverageId);
header("location: read.php?page=" . $page);
