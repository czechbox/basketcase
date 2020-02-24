<?php


namespace AcmeWidgets\Shop\Models;


/**
 * Class ProductRuleBOGO
 * @package AcmeWidgets\Shop\Models
 * Used for "Buy One Get One" type discounts
 * I've made it slightly more useful by allowing you to vary the purchase quantity
 * e.g. Buy 3 get 1 free or Buy 2 get 40% off the third
 */
class ProductRuleBOGO extends Rule
{
    private $productId;

    private $minQuantity; // this is the number of items required to qualify for the offer

    private $discount;

    private $itemSold;

    private $itemSoldQuantity;

    public function __construct(string $productId, int $minQuantity = 2, float $discount = 0.00)
    {
        $this->setType('product');
        $this->setProductId($productId);
        $this->setMinQuantity($minQuantity);
        $this->setDiscount($discount);

    }

    /**
     * @param $item
     * @param $quantity
     * @return bool|float|int|void
     */
    public function applyRule()
    {
       return $this->calculateCharge();
    }

    private function calculateCharge()
    {
        if($this->getItemSoldQuantity() >= $this->getMinQuantity()){

//          round down the discounted price (this is to make the tests pass, assuming that's the desired outcome)
            $discountedPrice = round($this->itemSold->getPrice() - ($this->itemSold->getPrice() * $this->getDiscount()),2, PHP_ROUND_HALF_DOWN);

//          determine groups of items
            $count = intdiv($this->getItemSoldQuantity(), $this->getMinQuantity());

//          how many discounted items do they get
            $discountedCount = $count;

//          number of items purchased at full price to qualify for the discount
            $qualifyingCount = $count * ($this->getMinQuantity() -1);

//          get the number of leftovers that need to be charged full price
            $remainderCount = $this->getItemSoldQuantity() % $this->getMinQuantity();

//          total number of items that are charged full price
            $fullPriceCount = $qualifyingCount + $remainderCount;

            return ($discountedCount * $discountedPrice) + ($this->itemSold->getPrice() * $fullPriceCount);
        }else{
//          if they don't have a qualifying purchase, return the full price total
            return $this->getItemSoldQuantity() * $this->itemSold->getPrice();
        }
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    private function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    private function getMinQuantity()
    {
        return $this->minQuantity;
    }

    /**
     * @param mixed $minQuantity
     */
    private function setMinQuantity($minQuantity): void
    {
        $this->minQuantity = $minQuantity;
    }

    /**
     * @return mixed
     */
    private function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    private function setDiscount($discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return mixed
     */
    public function getItemSold()
    {
        return $this->itemSold;
    }

    /**
     * @param mixed $itemSold
     */
    public function setItemSold($itemSold): void
    {
        $this->itemSold = $itemSold;
    }

    /**
     * @return mixed
     */
    public function getItemSoldQuantity()
    {
        return $this->itemSoldQuantity;
    }

    /**
     * @param mixed $itemSoldQuantity
     */
    public function setItemSoldQuantity($itemSoldQuantity): void
    {
        $this->itemSoldQuantity = $itemSoldQuantity;
    }


}