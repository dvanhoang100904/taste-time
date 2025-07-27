<?php
class Beverages
{
    private $beverage_id, $beverage_name, $price, $description, $image, $category_id;
    public function __construct($beverage_id, $beverage_name, $price, $description, $image, $category_id)
    {
        $this->beverage_id = $beverage_id;
        $this->beverage_name = $beverage_name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
        $this->category_id = $category_id;
    }

    public function getBeverageId()
    {
        return $this->beverage_id;
    }

    public function setBeverageId($beverage_id)
    {
        $this->beverage_id = $beverage_id;
    }

    public function getBeverageName()
    {
        return $this->beverage_name;
    }

    public function setBeverageName($beverage_name)
    {
        $this->beverage_name = $beverage_name;
    }


    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }


    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }
}
