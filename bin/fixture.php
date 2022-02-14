<?php

use SalesTaxes\Cart\Cart;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Receipt\Receipt;
use SalesTaxes\TaxRate\ImportTaxRate;
use SalesTaxes\TaxRate\StandardTaxRate;
use SalesTaxes\TaxRate\FreeTaxRate;

require __DIR__ . '/../vendor/autoload.php';

$carts = [
	// Input 1
	Cart::createWithProducts([
		Product::create('book', Price::of(12.49), 2, [
			new FreeTaxRate()
		]),
		Product::create('music CD', Price::of(14.99), 1, [
			new StandardTaxRate()
		]),
		Product::create('chocolate bar', Price::of(0.85), 1, [
			new FreeTaxRate()
		])
	]),

	// Input 2
	Cart::createWithProducts([
		Product::create('imported box of chocolates', Price::of(10.00), 1, [
			new FreeTaxRate(),
			new ImportTaxRate()
		]),
		Product::create('imported bottle of perfume', Price::of(47.50), 1, [
			new StandardTaxRate(),
			new ImportTaxRate()
		])
	]),

	// Input 3
	Cart::createWithProducts([
		Product::create('imported bottle of perfume', Price::of(27.99), 1, [
			new StandardTaxRate(),
			new ImportTaxRate()
		]),
		Product::create('bottle of perfume', Price::of(18.99), 1, [
			new StandardTaxRate()
		]),
		Product::create('packet of headache pills', Price::of(9.75), 1, [
			new FreeTaxRate()
		]),
		Product::create('imported box of chocolates', Price::of(11.25), 3, [
			new FreeTaxRate(),
			new ImportTaxRate()
		])
	])
];

$i = 1;
foreach ($carts as $cart) {
	echo "-------- Output " , $i++ , " --------\n";
    echo Receipt::fromCart($cart)->print();
    echo PHP_EOL, PHP_EOL;
}
