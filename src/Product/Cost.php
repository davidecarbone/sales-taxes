<?php

namespace SalesTaxes\Product;

interface Cost
{
	public function forQuantity(int $quantity): Cost;

	public function add(Cost $cost): Cost;

	public function toFloat(): float;

	public function __toString(): string;
}
