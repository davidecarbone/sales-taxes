<?php

namespace SalesTaxes\TaxRate;

interface TaxRate
{
	public function toFloat(): float;
}
