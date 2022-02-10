<?php

namespace SalesTaxes\Tax;

use Brick\Money\Money;
use SalesTaxes\Product\Price;

interface Tax
{
	public function forPrice(Price $price): Money;
}
