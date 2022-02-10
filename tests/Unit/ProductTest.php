<?php

namespace SalesTaxes\Unit;

use Brick\Money\Money;
use PHPUnit\Framework\TestCase;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Tax\BaseTax;

class ProductTest extends TestCase
{
	/** @test */
	public function it_calculates_total_taxes()
	{
		$product = new Product('imported chocolates', Price::of(11.25), 3, new BaseTax());

		$this->assertEquals(Money::of(3.38, 'EUR'), $product->taxes());
	}

	/** @test */
	public function it_calculates_total_price_after_taxes()
	{
		$product = new Product('imported chocolates', Price::of(11.25), 3, new BaseTax());

		$this->assertEquals(Price::of(37.13), $product->priceAfterTaxes());
	}
}
