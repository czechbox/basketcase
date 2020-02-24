<?php

namespace AcmeWidgets\Shop\Models;

class Product
{
    private $id;

    private $name;

    private $price;


    function __construct($id = '', $name = '', $price = 0.00)
    {

        $this->id = $id;

        $this->name = $name;

        $this->price = number_format($price,2);


    }

// basic getters & setters
    public function setId($id = '')
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;

    }

    public function setName($name = '')
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;

    }

    public function setPrice($name = 0.00)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;

    }


}
