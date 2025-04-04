<?php

class BeveragesCategories
{
    private $category_id, $category_name, $description;
    public function __construct($category_id, $category_name, $description)
    {
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->description = $description;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function getCategoryName()
    {
        return $this->category_name;
    }

    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
