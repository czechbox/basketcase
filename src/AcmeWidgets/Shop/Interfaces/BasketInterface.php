<?php

namespace AcmeWidgets\Shop\Interfaces;

interface BasketInterface
{
  // add an item to your basket
  public function add($id);

  // return the basket $total
  public function total();

}
