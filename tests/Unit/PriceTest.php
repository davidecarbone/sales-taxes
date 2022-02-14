<?php

namespace SalesTaxes\Unit;

use PHPUnit\Framework\TestCase;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Tax;
use SalesTaxes\TaxRate\StandardTaxRate;

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
	public function it_calculates_taxes()
	{
		$price = Price::of(10.99);
		$tax = $price->taxForRate(new StandardTaxRate());

		$this->assertEquals(Tax::of(1.10), $tax);
	}

	/** @test */
	public function it_does_not_round_to_nearest_five_cents_when_summing_another_cost()
	{
		$price = Price::of(11.25)
			->add(Price::of(1.13));

		$this->assertEquals(Price::of(12.38), $price);
	}

	/** @test */
	public function it_can_be_exported_to_float()
	{
		$price = Price::of(11);

		$this->assertSame(11.00, $price->toFloat());
	}

	/** @test */
	public function it_can_be_exported_to_string()
	{
		$price = Price::of(11);

		$this->assertSame('11.00', (string)$price);
	}
}
