<?php

namespace SalesTaxes\Tax;

use Brick\Math\RoundingMode;
use Brick\Money\Context\CashContext;
use Brick\Money\Money;
use SalesTaxes\Product\Price;

final class ImportTaxRate implements TaxRate
{
	public function forPrice(Price $price): Money
	{
		return Money::of($price->multipliedBy(0.05), 'EUR', new CashContext(5), RoundingMode::UP);
	}
}
