<?php

namespace SalesTaxes\Tax;

use Brick\Money\Money;
use SalesTaxes\Product\Price;

final class BaseTax implements Tax
{
	public function forPrice(Price $price): Money
	{
		return Money::of($price->multipliedBy(0.1), 'EUR');
	}
}
