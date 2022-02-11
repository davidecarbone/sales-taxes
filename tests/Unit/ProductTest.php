<?php

namespace SalesTaxes\Unit;

use Brick\Math\RoundingMode;
use Brick\Money\Context\CashContext;
use Brick\Money\Money;
use PHPUnit\Framework\TestCase;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Tax\ImportTaxRate;
use SalesTaxes\Tax\StandardTaxRate;

class ProductTest extends TestCase
{
	/** @test */
	public function it_calculates_taxes_with_standard_rate()
	{
		$product = new Product('music cd', Price::of(11.25), 3, [
			new StandardTaxRate()
		]);

		$this->assertEquals(Money::of(3.45, 'EUR', new CashContext(5), RoundingMode::UP), $product->taxes());
	}

	/** @test */
	public function it_calculates_taxes_with_multiple_rates()
	{
		$product = new Product('imported perfume', Price::of(47.50), 3, [
			new StandardTaxRate(),
			new ImportTaxRate(),
		]);

		$this->assertEquals(Money::of(21.45, 'EUR', new CashContext(5), RoundingMode::UP), $product->taxes());
	}

	/** @test */
	public function it_calculates_total_price_after_taxes()
	{
		$product = new Product('imported chocolates', Price::of(11.25), 3, [
			new StandardTaxRate()
		]);

		$this->assertEquals(Price::of(37.20), $product->priceAfterTaxes());
	}
}
