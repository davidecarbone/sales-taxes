<?php

namespace SalesTaxes\Unit;

use Brick\Math\RoundingMode;
use Brick\Money\Context\CashContext;
use Brick\Money\Money;
use PHPUnit\Framework\TestCase;
use SalesTaxes\Product\Price;

class PriceTest extends TestCase
{
	/** @test */
	public function it_can_be_quantified()
	{
		$price = Price::of(11.25)
			->forQuantity(3);

		$this->assertEquals(Price::of(33.75), $price);
	}

	/** @test */
	public function it_can_be_multiplied()
	{
		$price = Price::of(11.25)
			->multipliedBy(0.1);

		$this->assertEquals(Price::of(1.13), $price);
	}

	/** @test */
	public function it_rounds_to_nearest_five_cents_when_summing_money()
	{
		$price = Price::of(11.25)
			->plus(Money::of(1.13, 'EUR', new CashContext(5), RoundingMode::UP));

		$this->assertEquals(Price::of(12.40), $price);
	}

	/** @test */
	public function it_does_not_round_to_nearest_five_cents_when_summing_another_price()
	{
		$price = Price::of(11.25)
			->add(Price::of(1.13));

		$this->assertEquals(Price::of(12.38), $price);
	}
}
