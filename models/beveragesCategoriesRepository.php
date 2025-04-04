<?php
require_once 'database.php';
require_once 'beveragesCategories.php';

class BeveragesCategoriesRepository extends Database
{
    public function getAllBeveragesCategories()
    {
        $sql = "SELECT * FROM `beverages_categories`";
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();
        $items = array();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $list = array();
        foreach ($items as $item) {
            $list[] = new BeveragesCategories($item['category_id'], $item['category_name'], $item['description']);
        }
        return $list;
    }

    public function getBeveragesCategoriesByCategoryId($category_id)
    {
        $sql = "SELECT * FROM `beverages_categories` WHERE `category_id` = ?";
        $stmt = self::$connection->prepare($sql);
        $stmt->bind_param('i', $category_id);
        $stmt->execute();
        $items = array();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $beveragesCategories = null;
        foreach ($items as $item) {
            $beveragesCategories = new BeveragesCategories($item['category_id'], $item['category_name'], $item['description']);
        }
        return $beveragesCategories;
    }

    public function addBeveragesCategories($beveragesCategories)
    {
        $sql = "INSERT INTO `beverages_categories`(`category_name`,`description`) VALUES(?,?)";
        $stmt = self::$connection->prepare($sql);
        $category_name = $beveragesCategories->getCategoryName();
        $description = $beveragesCategories->getDescription();
        $stmt->bind_param('ss', $category_name, $description);
        return $stmt->execute();
    }

    public function updateBeveragesCategories($beveragesCategories)
    {
        $sql = "UPDATE `beverages_categories` SET `category_name` = ?, `description` = ? WHERE `category_id` = ?";
        $stmt = self::$connection->prepare($sql);
        $category_name = $beveragesCategories->getCategoryName();
        $description = $beveragesCategories->getDescription();
        $category_id = $beveragesCategories->getCategoryId();
        $stmt->bind_param('ssi', $category_name, $description, $category_id);
        return $stmt->execute();
    }

    public function deleteBeveragesCategories($category_id)
    {
        $sql = "DELETE FROM `beverages_categories` WHERE `category_id` = ?";
        $stmt = self::$connection->prepare($sql);
        $stmt->bind_param('i', $category_id);
        return $stmt->execute();
    }

    public function getAllBeveragesCategoriesPage($page, $perPage)
    {
        $start = ($page - 1) * $perPage;
        $sql = "SELECT * FROM `beverages_categories` LIMIT $start, $perPage";
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();
        $items = array();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $list = array();
        foreach ($items as $item) {
            $list[] = new BeveragesCategories($item['category_id'], $item['category_name'], $item['description']);
        }
        return $list;
    }

    public function createPageLinkBeveragesCategories($total, $perPage, $currentPage)
    {
        $totalLink = ceil($total / $perPage);
        $link = "";
        for ($i = 1; $i <= $totalLink; $i++) {
            $active = ($i == $currentPage) ? "active" : "";
            $link .= '<li class="page-item ' . $active . '"><a href="?page=' . $i . '" class="page-link">' . $i . '</a></li>';
        }
        return $link;
    }
}
