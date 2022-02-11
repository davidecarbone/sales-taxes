<?php

namespace SalesTaxes\Unit;

use Brick\Math\RoundingMode;
use Brick\Money\Context\CashContext;
use Brick\Money\Money;
use PHPUnit\Framework\TestCase;
use SalesTaxes\Cart\Cart;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Tax\StandardTaxRate;
use SalesTaxes\Tax\TaxFreeRate;

class CartTest extends TestCase
{
	/** @test */
	public function it_calculates_total_price()
	{
		$cart = Cart::createWithProducts([
			new Product('book 1', Price::of(12.49), 2, [
				new TaxFreeRate()
			]),
			new Product('book 2', Price::of(10.99), 1, [
				new TaxFreeRate()
			])
		]);

		$this->assertEquals(Price::of(35.97), $cart->totalPrice());
	}

	/** @test */
	public function it_calculates_total_taxes()
	{
		$cart = Cart::createWithProducts([
			new Product('cd', Price::of(12.49), 2, [
				new StandardTaxRate()
			]),
			new Product('book 2', Price::of(10.99), 1, [
				new TaxFreeRate()
			])
		]);

		$this->assertEquals(Money::of(2.50, 'EUR', new CashContext(5), RoundingMode::UP), $cart->totalTaxes());
	}
}
