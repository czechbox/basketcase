<?php

namespace AcmeWidgets\Shop\Models;

/**
 * Class Product
 * @package AcmeWidgets\Shop\Models
 */
class Product
{
    private $id;

    private $name;

    private $price;


    /**
     * Product constructor.
     * @param string $id
     * @param string $name
     * @param float $price
     */
    function __construct($id = '', $name = '', $price = 0.00)
    {

        $this->id = $id;

        $this->name = $name;

        $this->price = number_format($price,2);


    }

// basic getters & setters

    /**
     * @param string $id
     */
    public function setId($id = '')
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;

    }

    /**
     * @param string $name
     */
    public function setName($name = '')
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;

    }

    /**
     * @param float $price
     */
    public function setPrice($price = 0.00)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;

    }


}
