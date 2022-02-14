<?php

namespace SalesTaxes\Receipt;

use SalesTaxes\Cart\Cart;

final class Receipt
{
	/** @var ReceiptRow[] */
	private $rows;

	private function __construct()
	{
	}

	public static function fromCart(Cart $cart): self
	{
		$receipt = new self();
		$receipt->rows = self::rowsFromCart($cart);

		return $receipt;
	}

	public function print(): string
	{
		return implode(PHP_EOL, $this->rows);
	}

	/**
	 * @return ReceiptRow[]
	 */
	private static function rowsFromCart(Cart $cart): array
	{
		$rows = [];

		foreach ($cart->products() as $product) {
			$rows[] = ReceiptRow::forProduct($product);
		}

		$rows[] = ReceiptRow::forTaxes($cart->totalTaxes());
		$rows[] = ReceiptRow::forTotal($cart->totalPrice());

		return $rows;
	}
}
