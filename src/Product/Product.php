<?php

namespace SalesTaxes\Product;

use SalesTaxes\TaxRate\TaxRate;

final class Product
{
	/** @var string */
	private $name;

	/** @var Price */
	private $price;

	/** @var int */
	private $quantity;

	/** @var TaxRate[] */
	private $taxRates;

	private function __construct()
	{
	}

	/**
	 * @param TaxRate[] $taxRates
	 */
	public static function create(string $name, Price $price, int $quantity, array $taxRates): self
	{
		$product = new self();
		$product->name = $name;
		$product->price = $price;
		$product->quantity = $quantity;
		$product->taxRates = $taxRates;

		return $product;
	}

	public function taxes(): Cost
	{
		$taxes = Tax::of(0);

		foreach ($this->taxRates as $taxRate) {
			$taxes = $taxes->add(
				Tax::forPrice($this->price, $taxRate)
			);
		}

		return $taxes->forQuantity($this->quantity);
	}

	public function priceAfterTaxes(): Cost
	{
		return $this->price
			->forQuantity($this->quantity)
			->add($this->taxes());
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
