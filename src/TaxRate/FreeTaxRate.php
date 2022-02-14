<?php

namespace SalesTaxes\TaxRate;

final class FreeTaxRate implements TaxRate
{
	/** @var float */
	private $rate;

	public function __construct()
	{
		$this->rate = 0;
	}

	public function toFloat(): float
	{
		return $this->rate;
	}
}
