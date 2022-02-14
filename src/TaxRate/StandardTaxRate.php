<?php

namespace SalesTaxes\TaxRate;

final class StandardTaxRate implements TaxRate
{
	/** @var float */
	private $rate;

	public function __construct()
	{
		$this->rate = 0.1;
	}

	public function toFloat(): float
	{
		return $this->rate;
	}
}
