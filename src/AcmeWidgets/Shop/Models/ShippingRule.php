<?php


namespace AcmeWidgets\Shop\Models;


class ShippingRule extends Rule
{

    private $cart_total;

    private $min_spend;

    private $max_spend;

    private $charge;

    public function __construct(float $min_spend,float $max_spend, float $charge)
    {
        $this->setType('shipping');
        $this->setMinSpend($min_spend);
        $this->setMaxSpend($max_spend);
        $this->setCharge($charge);
    }


    /**
     * @return bool|mixed|void
     * if the rule applies send back the cost, if not send back false
     */
    public function applyRule()
    {
        if($this->cart_total >= $this->min_spend && $this->cart_total <= $this->max_spend){
            return $this->getCharge();
        }
//      if you want to apply to everything over the min spend, set max to 0.00
        elseif ($this->cart_total >= $this->min_spend && $this->max_spend == 0.00)
        {
            return $this->getCharge();
        }
        else{
            return false;
        }
    }
    /**
     * @return mixed
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * @param mixed $charge
     */
    public function setCharge($charge): void
    {
        $this->charge = $charge;
    }

    /**
     * @return float
     */
    public function getMinSpend(): float
    {
        return $this->min_spend;
    }

    /**
     * @param float $min_spend
     */
    public function setMinSpend(float $min_spend): void
    {
        $this->min_spend = $min_spend;
    }

    /**
     * @return float
     */
    public function getCartTotal(): float
    {
        return $this->cart_total;
    }

    /**
     * @param float $cart_total
     */
    public function setCartTotal(float $cart_total): void
    {
        $this->cart_total = $cart_total;
    }

    /**
     * @return float
     */
    public function getMaxSpend(): float
    {
        return $this->max_spend;
    }

    /**
     * @param float $max_spend
     */
    public function setMaxSpend(float $max_spend): void
    {
        $this->max_spend = $max_spend;
    }


}