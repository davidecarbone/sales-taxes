<?php

namespace SalesTaxes\Unit;

use PHPUnit\Framework\TestCase;
use SalesTaxes\Cart\Cart;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Product\Tax;
use SalesTaxes\TaxRate\StandardTaxRate;
use SalesTaxes\TaxRate\FreeTaxRate;

class CartTest extends TestCase
{
	/** @test */
	public function it_calculates_total_price()
	{
		$cart = Cart::createWithProducts([
			Product::create('book 1', Price::of(12.49), 2, [
				new FreeTaxRate()
			]),
			Product::create('book 2', Price::of(10.99), 1, [
				new FreeTaxRate()
			])
		]);

		$this->assertEquals(Price::of(35.97), $cart->totalPrice());
	}

	/** @test */
	public function it_calculates_total_taxes()
	{
		$cart = Cart::createWithProducts([
			Product::create('cd', Price::of(12.49), 2, [
				new StandardTaxRate()
			]),
			Product::create('book 2', Price::of(10.99), 1, [
				new FreeTaxRate()
			])
		]);

		$this->assertEquals(Tax::of(2.50), $cart->totalTaxes());
	}
}
