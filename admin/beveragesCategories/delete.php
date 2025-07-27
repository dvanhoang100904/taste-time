<?php

require_once '../../models/beveragesCategoriesRepository.php';
$category_id = $_GET['category_id'];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$beveragesCategoriesRepository = new BeveragesCategoriesRepository();
$getBeveragesCategoriesByCategoryId = $beveragesCategoriesRepository->getBeveragesCategoriesByCategoryId($category_id);
$beveragesCategoriesRepository->deleteBeveragesCategories($category_id);
header("location: read.php?page=" . $page);
