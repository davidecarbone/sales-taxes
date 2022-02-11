<?php

namespace SalesTaxes\Tax;

use Brick\Money\Money;
use SalesTaxes\Product\Price;

interface TaxRate
{
	public function forPrice(Price $price): Money;
}
