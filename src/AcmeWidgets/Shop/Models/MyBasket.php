<?php

namespace AcmeWidgets\Shop\Models;
use AcmeWidgets\Shop\Interfaces\BasketInterface;
/**
 *
 */
class MyBasket implements BasketInterface
{

  private $catalogue;

  private $items;

  private $shipping_rules = array();

  private $product_rules = array();

  private $cart_rules = array();

  private $subtotal;

  private $shipping;

  private $total;

    /**
     * MyBasket constructor.
     * @param Catalogue $catalogue
     * @param array $rules
     */
    function __construct(Catalogue $catalogue, array $rules)
  {
    // build up the catalogue & rules
    // to set initial values
    $this->catalogue = $catalogue;

    //    this is pretty awful but running short of time, I'm sure there's a more elegant way to do it
    foreach ($rules as $rule) {
        switch ($rule->getType()){
            case 'shipping':
                $this->shipping_rules[] = $rule;
                break;
            case 'product':
                $this->product_rules[] = $rule;
                break;
            default:
//                unused, but thinking along the lines of PROMO codes or other discounts applied to the full purchase cost
                $this->cart_rules[] = $rule;
                break;
        }

    }
  }

    /**
     * @param $id
     */
    public function add($id)
      {
        // ordinarily would probably us an object model, but time...
        if(isset($this->items[$id]['quantity']))
        {

          $this->items[$id]['quantity']++;

        }else{

          $this->items[$id]['quantity'] = 1;

        }
      }


    /**
     * @return string
     * required interface calls methods required to calculate the total
     */
    public function total()
      {
          $cartTotal = $this->getSubTotal();
          $this->checkShippingRules();
          return $this->total = number_format( $cartTotal + $this->getShipping(),2) ;
      }

    /**
     * @return mixed
     * work through the items, the rules that apply and calculate the  subtotal
     * probably should refactor this as a different function, but it works
     */
    private function getSubTotal()
      {
          $itemTotal = 0.00;
          foreach ($this->items as $id => $item){
            $product = $this->catalogue->getProductByID($id);
            if($rule = $this->checkProductRules($product))
            {
                $rule->setItemSold($product);
                $rule->setItemSoldQuantity($item["quantity"]);
                $itemTotal += number_format($rule->applyRule(),2);
            }else{
                $itemTotal += number_format($product->getPrice() * $item["quantity"],2);
            }
          }
          $this->setSubtotal(number_format($itemTotal,2));
          return $this->subtotal;

      }

    /**
     * @param $product
     * @return bool|mixed
     * cycle through the available rules and return if valid
     */
    private function checkProductRules($product)
      {
          foreach ($this->product_rules as $rule){
            if($rule->getProductId() == $product->getId())
            {
                return $rule;
            }
          }
          return false;
      }

    /**
     * @return mixed
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param mixed $shipping
     */
    public function setShipping($shipping): void
    {
        $this->shipping = $shipping;
    }

    /**
     * cycle through the available rules and apply if valid
     */
    private function checkShippingRules()
      {
          foreach ($this->shipping_rules as $rule){

              $rule->setCartTotal($this->subtotal);

              if($cost = $rule->applyRule())
              {
                $this->setShipping($cost);
              }
          }
      }
    /**
     * @param mixed $subtotal
     */
    public function setSubtotal($subtotal): void
    {
        $this->subtotal = $subtotal;
    }

}
