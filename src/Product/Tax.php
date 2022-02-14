<?php

namespace SalesTaxes\Product;

use Brick\Math\RoundingMode;
use Brick\Money\Context\CashContext;
use Brick\Money\Money;
use SalesTaxes\TaxRate\TaxRate;

final class Tax implements Cost
{
	/** @var Money */
	private $value;

	private function __construct()
	{
	}

	public static function of(float $value): self
	{
		$instance = new self();
		$instance->value = Money::of($value, 'EUR', new CashContext(5), RoundingMode::UP);

		return $instance;
	}

	public static function forPrice(Price $price, TaxRate $taxRate): self
	{
		return Tax::of(
			$price->taxForRate($taxRate)
				->toFloat()
		);
	}

	public function forQuantity(int $quantity): Cost
	{
		return Tax::of(
			$this->value
				->multipliedBy($quantity, RoundingMode::UP)
				->getAmount()
				->toFloat()
		);
	}

	public function add(Cost $tax): Cost
	{
		return Tax::of(
			$this->value
				->plus($tax->value, RoundingMode::UP)
				->getAmount()
				->toFloat()
		);
	}

	public function toFloat(): float
	{
		return $this->value->getAmount()->toFloat();
	}

	public function __toString(): string
	{
		return number_format($this->toFloat(), 2);
	}
}
