<?php

namespace SalesTaxes\Tax;

use Brick\Money\Money;
use SalesTaxes\Product\Price;

final class NoTax implements Tax
{
	public function forPrice(Price $price): Money
	{
		return Money::zero('EUR');
	}
}
