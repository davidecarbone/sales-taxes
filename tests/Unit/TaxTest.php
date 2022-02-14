<?php

namespace SalesTaxes\Unit;

use PHPUnit\Framework\TestCase;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Tax;
use SalesTaxes\TaxRate\ImportTaxRate;
use SalesTaxes\TaxRate\StandardTaxRate;
use SalesTaxes\TaxRate\FreeTaxRate;

class TaxTest extends TestCase
{
	/**
	 * @test
	 * @dataProvider taxValues
	 */
	public function it_is_always_rounded_for_excess_to_nearest_five_cents($taxValue, $expectedTaxValue)
	{
		$tax = Tax::of($taxValue);

		$this->assertEquals(Tax::of($expectedTaxValue), $tax);
	}

	public function taxValues()
	{
		return [
			[0.99, 1.00],
			[1.01, 1.05],
			[1.03, 1.05],
			[1.04, 1.05],
			[1.06, 1.10],
		];
	}

	/** @test */
	public function it_can_be_built_with_a_price_and_a_standard_tax_rate()
	{
		$tax = Tax::forPrice(Price::of(10.99), new StandardTaxRate());

		$this->assertEquals(Tax::of(1.10), $tax);
	}

	/** @test */
	public function it_can_be_built_with_a_price_and_an_imported_tax_rate()
	{
		$tax = Tax::forPrice(Price::of(10.99), new ImportTaxRate());

		$this->assertEquals(Tax::of(0.55), $tax);
	}

	/** @test */
	public function it_can_be_built_with_a_price_and_a_free_tax_rate()
	{
		$tax = Tax::forPrice(Price::of(10.99), new FreeTaxRate());

		$this->assertEquals(Tax::of(0), $tax);
	}

	/** @test */
	public function it_can_be_quantified()
	{
		$tax = Tax::of(1.05)
			->forQuantity(3);

		$this->assertEquals(Tax::of(3.15), $tax);
	}

	/** @test */
	public function it_can_be_exported_to_float()
	{
		$tax = Tax::of(1);

		$this->assertSame(1.00, $tax->toFloat());
	}

	/** @test */
	public function it_can_be_exported_to_string()
	{
		$tax = Tax::of(1);

		$this->assertSame('1.00', (string)$tax);
	}
}
