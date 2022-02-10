<?php

namespace SalesTaxes\Receipt;

use SalesTaxes\Cart\Cart;

final class Receipt
{
	/** @var Cart */
	private $cart;

	public function __construct(Cart $cart)
	{
		$this->cart = $cart;
	}

	public function print(): string
	{
		return $this->cart->exportPrintableList();
	}
}
