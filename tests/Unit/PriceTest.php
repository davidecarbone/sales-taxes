<?php

namespace SalesTaxes\Unit;

use Brick\Money\Money;
use PHPUnit\Framework\TestCase;
use SalesTaxes\Product\Price;

class PriceTest extends TestCase
{
	/** @test */
	public function it_exports_to_float()
	{
		$price = Price::of(11.25);

		$this->assertEquals(11.25, $price->toFloat());
	}

	/** @test */
	public function it_quantifies()
	{
		$price = Price::of(11.25)
			->forQuantity(3);

		$this->assertEquals(33.75, $price->toFloat());
	}

	/** @test */
	public function it_multiplies()
	{
		$price = Price::of(11.25)
			->multipliedBy(0.1);

		$this->assertEquals(1.13, $price->toFloat());
	}

	/** @test */
	public function it_sums_money()
	{
		$price = Price::of(11.25)
			->plus(Money::of(1.13, 'EUR'));

		$this->assertEquals(12.38, $price->toFloat());
	}

	/** @test */
	public function it_adds_another_price()
	{
		$price = Price::of(11.25)
			->add(Price::of(1.13));

		$this->assertEquals(12.38, $price->toFloat());
	}
}
