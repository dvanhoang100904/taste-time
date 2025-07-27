<?php

require_once '../../models/beveragesCategoriesRepository.php';

$category_name = $_POST['category_name'];
$description = $_POST['description'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$beveragesCategories = new BeveragesCategories(null, $category_name, $description);
$beveragesCategoriesRepository = new BeveragesCategoriesRepository();
$beveragesCategoriesRepository->addBeveragesCategories($beveragesCategories);
header("location: read.php?page=".$page);
