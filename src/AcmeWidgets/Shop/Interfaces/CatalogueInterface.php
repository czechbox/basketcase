<?php
namespace AcmeWidgets\Shop\Interfaces;

/**
 *
 */
interface CatalogueInterface
{

  public function addProduct($id='',$name='',$price=0);

  public function removeProduct($id='');

  public function getProductByID($id='');

}
