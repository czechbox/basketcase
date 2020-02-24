<?php

use AcmeWidgets\Shop\Models\Catalogue;
use AcmeWidgets\Shop\Models\MyBasket;
use AcmeWidgets\Shop\Models\ProductRuleBOGO;
use AcmeWidgets\Shop\Models\ShippingRule;

require "autoloader.php";

// Normally this would sit in a datastore of some kind
$catalogue = new Catalogue();
// the addProduct method creates a Product object within the catalogue
$catalogue->addProduct('R01','Red Widget',32.95);
$catalogue->addProduct('G01', 'Green Widget', 24.95);
$catalogue->addProduct('B01', 'Blue Widget', 7.95);

//setup rules, normally would also put in a datastore of some sort

// an array to hold all our rules to pass to the Basket constructor
$rules = array();

// shipping rules
$shippingRuleDefault = new ShippingRule(0,49.99,4.95);
$shippingRuleDefault->setName('default');
$rules[] = $shippingRuleDefault;

$shippingRule50 = new ShippingRule(50.00,89.99,2.95);
$shippingRule50->setName('OVER50');
$rules[] = $shippingRule50;

// setting max to 0.00 which overrides it's consideration
$shippingRule90 = new ShippingRule(90.00, 0.00,0.00);
$shippingRule90->setName('OVER90');
$rules[] = $shippingRule90;

// product rule(s)

// The Rule I implemented is probably a little over cooked for what needs to be done, but it allows for some
// interesting options in future.
//

$productRuleBOBOHP = new ProductRuleBOGO('R01',2,0.50);
$productRuleBOBOHP->setName('BOGOHP');
$rules[] = $productRuleBOBOHP;


// Create and run the test case baskets
$basket1 = new MyBasket($catalogue, $rules);

$basket1->add('B01');
$basket1->add('G01');

echo "Basket 1 Contents: B01, G01 \n";
echo "Basket 1 Total: $".$basket1->total()."\n\n";

// Basket 2
$basket2 = new MyBasket($catalogue, $rules);

$basket2->add('R01');
$basket2->add('R01');

echo "Basket 2 Contents: R01, R01 \n";
echo "Basket 2 Total: $".$basket2->total()."\n\n";

// Basket 3
$basket3 = new MyBasket($catalogue, $rules);

$basket3->add('R01');
$basket3->add('G01');

echo "Basket 3 Contents: R01, G01 \n";
echo "Basket 3 Total: $".$basket3->total()."\n\n";


// Basket 4
$basket4 = new MyBasket($catalogue, $rules);

$basket4->add('B01');
$basket4->add('B01');
$basket4->add('R01');
$basket4->add('R01');
$basket4->add('R01');

echo "Basket 4 Contents: B01, B01, R01, R01, R01 \n";
echo "Basket 4 Total: $".$basket4->total()."\n\n";
