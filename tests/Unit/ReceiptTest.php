<?php

namespace SalesTaxes\Unit;

use PHPUnit\Framework\TestCase;
use SalesTaxes\Cart\Cart;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Receipt\Receipt;
use SalesTaxes\TaxRate\FreeTaxRate;
use SalesTaxes\TaxRate\ImportTaxRate;
use SalesTaxes\TaxRate\StandardTaxRate;

class ReceiptTest extends TestCase
{
	/** @test */
	public function it_prints()
	{
		$cart = Cart::createWithProducts([
			Product::create('book', Price::of(12.49), 2, [
				new StandardTaxRate()
			]),
			Product::create('imported cd', Price::of(19.99), 1, [
				new ImportTaxRate()
			]),
			Product::create('pills', Price::of(15.49), 3, [
				new FreeTaxRate()
			])
		]);

		$receipt = Receipt::fromCart($cart);

		$this->assertEquals(
			"2 book: 27.48\n1 imported cd: 20.99\n3 pills: 46.47\nSales Taxes: 3.50\nTotal: 94.94",
			$receipt->print()
		);
	}
}
