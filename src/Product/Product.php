<?php

namespace SalesTaxes\Product;

use Brick\Money\Context\CashContext;
use Brick\Money\Money;
use SalesTaxes\Tax\TaxRate;

final class Product
{
	/** @var string */
	private $name;

	/** @var Price */
	private $price;

	/** @var int */
	private $quantity;

	/** @var TaxRate[] */
	private $taxes;

	/**
	 * @param TaxRate[] $taxes
	 */
	public function __construct(string $name, Price $price, int $quantity, array $taxes)
	{
		$this->name = $name;
		$this->price = $price;
		$this->quantity = $quantity;
		$this->taxes = $taxes;
	}

	public function taxes(): Money
	{
		$taxes = Money::zero('EUR', new CashContext(5));

		foreach ($this->taxes as $tax) {
			$taxes = $taxes->plus($tax->forPrice($this->price));
		}

		return $taxes->multipliedBy($this->quantity);
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
