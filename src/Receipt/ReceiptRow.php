<?php

namespace SalesTaxes\Receipt;

use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Product\Tax;

final class ReceiptRow
{
	/** @string */
	private $value;

	private function __construct()
	{
	}

	public static function forProduct(Product $product): self
	{
		$receiptRow = new self();
		$receiptRow->value = (string) $product;

		return $receiptRow;
	}

	public static function forTaxes(Tax $tax): self
	{
		$receiptRow = new self();
		$receiptRow->value = sprintf('Sales Taxes: %s', $tax);

		return $receiptRow;
	}

	public static function forTotal(Price $price): self
	{
		$receiptRow = new self();
		$receiptRow->value = sprintf('Total: %s', $price);

		return $receiptRow;
	}

	public function __toString(): string
	{
		return $this->value;
	}
}
