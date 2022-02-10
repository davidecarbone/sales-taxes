<?php

namespace SalesTaxes\Receipt;

final class ReceiptRow
{
	private $value;

	public function __construct(string $value)
	{
		$this->value = $value;
	}


}
