<?php

namespace SalesTaxes\TaxRate;

final class ImportTaxRate implements TaxRate
{
	/** @var float */
	private $rate;

	public function __construct()
	{
		$this->rate = 0.05;
	}

	public function toFloat(): float
	{
		return $this->rate;
	}
}
