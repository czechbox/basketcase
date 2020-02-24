# Acme Widgets Basket
A simple-ish Basket model implementation as well as Models for Catalogue, Product and Rules.

### The Catalogue is defined and Products added.
```
$catalogue = new Catalogue();
$catalogue->addProduct('R01','Red Widget',32.95);
$catalogue->addProduct('G01', 'Green Widget', 24.95);
$catalogue->addProduct('B01', 'Blue Widget', 7.95);
```
Product models are created within the Catalogue.

### The Rules are then created:
Each rule is appended to an array to be loaded in the Basket constructor

#### Shipping Rules
Shipping Rules take arguments for minimum cart value, maximum cart value and shipping cost. 
The name is set afterwards as it isn't required to function, but would be useful if we were to extend this for use beyond a PoC.
```
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
``` 
#### Product Rules
Product Rules take three arguements: productId, minimum qualifying purchase and the discount to be applied.
```
$productRuleBOBOHP = new ProductRuleBOGO('R01',2,0.50);
$productRuleBOBOHP->setName('BOGOHP');
$rules[] = $productRuleBOBOHP;
```


