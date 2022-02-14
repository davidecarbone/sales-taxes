<?php

namespace SalesTaxes\Cart;

use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Product\Tax;

final class Cart
{
	/** @var Product[] */
	private $products;

	private function __construct()
	{
	}

	/**
	 * @param Product[] $products
	 */
	public static function createWithProducts(array $products): self
	{
		$cart = new self();
		$cart->products = $products;

		return $cart;
	}

	public function totalPrice(): Price
	{
		$totalPrice = Price::of(0);

		foreach ($this->products as $product) {
			$totalPrice = $totalPrice->add($product->priceAfterTaxes());
		}

		return $totalPrice;
	}

	public function totalTaxes(): Tax
	{
		$totalTaxes = Tax::of(0);

		foreach ($this->products as $product) {
			$totalTaxes = $totalTaxes->add($product->taxes());
		}

		return $totalTaxes;
	}

	public function exportPrintableList(): string
	{
		$output = '';

		foreach ($this->products as $product) {
			$output .= $product . PHP_EOL;
		}

		return $output;
	}
}
