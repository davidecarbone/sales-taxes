<?php

use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Tax\ImportTaxRate;
use SalesTaxes\Tax\StandardTaxRate;
use SalesTaxes\Tax\TaxFreeRate;

require __DIR__ . '/../vendor/autoload.php';

$carts = [
	[
		new Product('book', Price::of(12.49), 2, [
			new TaxFreeRate()
		]),
		new Product('music CD', Price::of(14.99), 1, [
			new StandardTaxRate()
		]),
		new Product('chocolate bar', Price::of(0.85), 1, [
			new TaxFreeRate()
		]),
		'Sales Taxes: 1.50',
		'Total: 42.32'
	],
	[
		new Product('imported box of chocolates', Price::of(10.00), 1, [
			new TaxFreeRate(),
			new ImportTaxRate()
		]),
		new Product('imported bottle of perfume', Price::of(47.50), 1, [
			new StandardTaxRate(),
			new ImportTaxRate()
		]),
		'Sales Taxes: 7.65',
		'Total: 65.15'
	],
	[
		new Product('imported bottle of perfume', Price::of(27.99), 1, [
			new StandardTaxRate(),
			new ImportTaxRate()
		]),
		new Product('bottle of perfume', Price::of(18.99), 1, [
			new StandardTaxRate()
		]),
		new Product('packet of headache pills', Price::of(9.75), 1, [
			new TaxFreeRate()
		]),
		new Product('imported box of chocolates', Price::of(11.25), 3, [
			new TaxFreeRate(),
			new ImportTaxRate()
		]),
		'Sales Taxes: 7.90',
		'Total: 98.38'
	]
];

if (count($argv) > 1) {
    $days = (int) $argv[1];
}
$i = 1;
foreach ($carts as $cart) {
	echo "-------- Output " , $i++ , " --------\n";
    foreach ($cart as $product) {
        echo $product . PHP_EOL;
    }
    echo PHP_EOL;
}
