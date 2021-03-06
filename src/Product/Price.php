<?php

namespace SalesTaxes\Product;

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use SalesTaxes\TaxRate\TaxRate;

final class Price implements Cost
{
	/** @var Money */
	private $value;

	private function __construct()
	{
	}

	public static function of(float $value): self
	{
		$instance = new self();
		$instance->value = Money::of($value, 'EUR', null, RoundingMode::UP);

		return $instance;
	}

	public function forQuantity(int $quantity): Cost
	{
		return Price::of(
			$this->value
				->multipliedBy($quantity)
				->getAmount()
				->toFloat()
		);
	}

	public function add(Cost $price): Cost
	{
		return Price::of(
			$this->value
				->plus($price->toFloat(), RoundingMode::UP)
				->getAmount()
				->toFloat()
		);
	}

	public function taxForRate(TaxRate $taxRate): Tax
	{
		return Tax::of(
			$this->value
				->multipliedBy($taxRate->toFloat(), RoundingMode::UP)
				->getAmount()
				->toFloat()
		);
	}

	public function toFloat(): float
	{
		return $this->value
			->getAmount()
			->toFloat();
	}

	public function __toString(): string
	{
		return number_format($this->toFloat(), 2);
	}
}
