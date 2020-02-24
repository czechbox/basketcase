# Acme Widgets Basket
A simple-ish Basket model implementation as well as models for Catalogue, Product and Rules.

#### Assumptions:
* No data store or persistence is required
* No UI is required
* Items will be added to the Basket one at a time
* The provided test output is sufficient test coverage in this PoC
* When discount values are created, the output is rounded down. This was needed to make the output match the expected totals. It would be trivial to change this if required.

### The Catalogue is defined and Products added
```
$catalogue = new Catalogue();
$catalogue->addProduct('R01','Red Widget',32.95);
$catalogue->addProduct('G01', 'Green Widget', 24.95);
$catalogue->addProduct('B01', 'Blue Widget', 7.95);
```
Product models are created within the Catalogue.

### The Rules are then created
Each rule is appended to an array to be loaded in the Basket constructor.

#### Shipping Rules
Shipping Rules take arguments for minimum cart value, maximum cart value and shipping cost. 
The name is set afterwards as it isn't required to function, but would be useful if we were to extend this for use beyond a PoC. As noted in the comments, setting the max cart value to '0.00' removes it from consideration.
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
The Product Rule being used takes three arguments: productId, minimum qualifying purchase and the discount to be applied. Like the Shipping rules, the name is added, but not required.
```
$productRuleBOBOHP = new ProductRuleBOGO('R01',2,0.50);
$productRuleBOBOHP->setName('BOGOHP');
$rules[] = $productRuleBOBOHP;
```
A quick note: product & shipping rules are differentiated by type in their constructor. I'm sure there's a better way to do this, but it works for now.
### The Basket
Now that we've built up the Catalogue, Product and Rules we can populate the Basket model. It takes two arguments, the Catalogue object and the array of Rules.
```
$basket = new MyBasket($catalogue, $rules);
```
Once that's created, we can then add items to it by their product ID. These are stored in a multi-dimensional array in the Basket object using the product ID as the key and keeping track of the quantity in another level of the array. Again, a datastore of some sort would be better, but for the PoC this should be sufficient.

```$xslt
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');
$basket->add('G01');
```
**Assumption:** _Only single items will be added to the basket at a time._

We could easily change this if it was determined that multiple items were desired.

## Running the application
The application was built with no UI considerations, so is best run via CLI. For simplicity, I've developed it using a basic PHP Docker image. This is probably the easiest way to run it locally without worrying about versions and platform quirks. 

Executing the command below from the root of this repository will run the test cases and output the results expected in the specification.
```
docker run --rm --name basket -v $PWD:/opt/basket -w /opt/basket php:7.2 php ./index.php
```

If you don't have Docker installed, but do have a local PHP install, you can run it there. It requires PHP 7.1 though may work with lower versions (I haven't tested to be certain).
```
php ./index.php 
``` 