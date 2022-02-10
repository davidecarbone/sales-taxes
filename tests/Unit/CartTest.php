<?php

namespace SalesTaxes\Unit;

use Brick\Money\Money;
use PHPUnit\Framework\TestCase;
use SalesTaxes\Cart\Cart;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Tax\BaseTax;
use SalesTaxes\Tax\NoTax;

class CartTest extends TestCase
{
	/** @test */
	public function it_calculates_total_price()
	{
		$cart = Cart::createWithProducts([
			new Product('book 1', Price::of(12.49), 2, new NoTax()),
			new Product('book 2', Price::of(10.99), 1, new NoTax()),
		]);

		$this->assertEquals(35.97, $cart->totalPrice()->toFloat());
	}

	/** @test */
	public function it_calculates_total_taxes()
	{
		$cart = Cart::createWithProducts([
			new Product('cd', Price::of(12.49), 2, new BaseTax()),
			new Product('book 2', Price::of(10.99), 1, new NoTax()),
		]);

		$this->assertEquals(Money::of(2.50, 'EUR'), $cart->totalTaxes());
	}
}
