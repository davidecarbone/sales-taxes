<?php

namespace SalesTaxes\Unit;

use PHPUnit\Framework\TestCase;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Product\Tax;
use SalesTaxes\TaxRate\FreeTaxRate;
use SalesTaxes\TaxRate\ImportTaxRate;
use SalesTaxes\TaxRate\StandardTaxRate;

class ProductTest extends TestCase
{
	/** @test */
	public function it_accumulates_taxes_with_multiple_rates()
	{
		$product = Product::create('imported perfume', Price::of(47.50), 3, [
			new StandardTaxRate(),
			new ImportTaxRate(),
			new FreeTaxRate()
		]);

		$this->assertEquals(Tax::of(21.45), $product->taxes());
	}

	/** @test */
	public function it_calculates_total_price_after_taxes()
	{
		$product = Product::create('imported chocolates', Price::of(11.25), 3, [
			new StandardTaxRate(),
			new ImportTaxRate(),
			new FreeTaxRate()
		]);

		$this->assertEquals(Price::of(39.00), $product->priceAfterTaxes());
	}
}
