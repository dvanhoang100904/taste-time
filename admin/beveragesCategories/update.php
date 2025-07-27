<?php

require_once '../../models/beveragesCategoriesRepository.php';
$category_id = $_POST['category_id'];
$category_name = $_POST['category_name'];
$description = $_POST['description'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$BeveragesCategoriesRepository = new BeveragesCategoriesRepository();
$getBeveragesCategoriesByCategoryId = $BeveragesCategoriesRepository->getBeveragesCategoriesByCategoryId($category_id);
$getBeveragesCategoriesByCategoryId->setCategoryName($category_name);
$getBeveragesCategoriesByCategoryId->setDescription($description);
$BeveragesCategoriesRepository->updateBeveragesCategories($getBeveragesCategoriesByCategoryId);
header("location: read.php?page=" . $page);
