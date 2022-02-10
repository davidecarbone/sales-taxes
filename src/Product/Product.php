<?php

namespace SalesTaxes\Product;

use Brick\Money\Money;
use SalesTaxes\Tax\Tax;

final class Product
{
	/** @var string */
	private $name;

	/** @var Price */
	private $price;

	/** @var int */
	private $quantity;

	/** @var Tax */
	private $tax;

	public function __construct(string $name, Price $price, int $quantity, Tax $tax)
	{
		$this->name = $name;
		$this->price = $price;
		$this->quantity = $quantity;
		$this->tax = $tax;
	}

	public function taxes(): Money
	{
		return $this->tax->forPrice(
			$this->price->forQuantity($this->quantity)
		);
	}

	public function priceAfterTaxes(): Price
	{
		return $this->price
			->forQuantity($this->quantity)
			->plus($this->taxes());
	}

	public function __toString(): string
	{
		return sprintf(
			"%s %s: %s",
			$this->quantity,
			$this->name,
			$this->priceAfterTaxes()
		);
	}
}
