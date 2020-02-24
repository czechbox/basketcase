<?php

namespace AcmeWidgets\Shop\Models;
use AcmeWidgets\Shop\Interfaces\CatalogueInterface;
use AcmeWidgets\Shop\Models\Product;

class Catalogue implements CatalogueInterface
{

    private $products = array();


    /**
     * @param string $id
     * @param string $name
     * @param float $price
     * @return bool
     */
    public function addProduct($id = '', $name = '', $price = 0.00)
    {
        if(!$this->getProductByID($id)){
            $this->products[] = new Product($id, $name, $price);
        }
        else{
//            should probably add a bit more rubust error handling here, but time...
            return false;
        }
    }

    /**
     * @param string $id
     */
    public function removeProduct($id = '')
    {
        // TODO: Implement removeProduct() method.
    }

    /**
     * @param string $id
     * @return mixed|null
     */
    public function getProductByID($id = '')
    {
//        see if it's there
        foreach ($this->products as $product)
        {
            if($product->getId() == $id){
                return $product;
            }
        }
//        return false if not
        return false;
    }
}
