<?php

namespace SalesTaxes\Product;

use Brick\Math\RoundingMode;
use Brick\Money\Money;

final class Price
{
	/** @var Money */
	private $value;

	private function __construct()
	{
	}

	public static function of(float $price): self
	{
		$instance = new self();
		$instance->value = Money::of($price, 'EUR', null, RoundingMode::UP);

		return $instance;
	}

	public function forQuantity(int $quantity): Price
	{
		return Price::of(
			$this->value
				->multipliedBy($quantity, RoundingMode::UP)
				->getAmount()
				->toFloat()
		);
	}

	public function add(Price $price): Price
	{
		return Price::of(
			$this->value
				->plus($price->toFloat(), RoundingMode::UP)
				->getAmount()
				->toFloat()
		);
	}

	public function multipliedBy(float $value): Price
	{
		return Price::of(
			$this->value
				->multipliedBy($value, RoundingMode::UP)
				->getAmount()
				->toFloat()
		);
	}

	public function plus(Money $value): Price
	{
		return Price::of(
			$this->value
				->plus($value, RoundingMode::UP)
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
		return (string) $this->toFloat();
	}
}
