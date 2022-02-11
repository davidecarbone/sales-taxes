<?php

namespace SalesTaxes\Tax;

use Brick\Money\Context\CashContext;
use Brick\Money\Money;
use SalesTaxes\Product\Price;

final class TaxFreeRate implements TaxRate
{
	public function forPrice(Price $price): Money
	{
		return Money::zero('EUR', new CashContext(5));
	}
}
