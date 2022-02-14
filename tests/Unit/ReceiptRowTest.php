<?php

namespace SalesTaxes\Unit;

use PHPUnit\Framework\TestCase;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Product\Tax;
use SalesTaxes\Receipt\ReceiptRow;
use SalesTaxes\TaxRate\StandardTaxRate;

class ReceiptRowTest extends TestCase
{
	/** @test */
	public function it_can_be_created_for_a_product()
	{
		$receiptRow = ReceiptRow::forProduct(
			Product::create('book', Price::of(12.49), 2, [
				new StandardTaxRate()
			])
		);

		$this->assertEquals('2 book: 27.48', (string)$receiptRow);
	}

	/** @test */
	public function it_can_be_created_for_taxes()
	{
		$receiptRow = ReceiptRow::forTaxes(
			Tax::of(2.50)
		);

		$this->assertEquals('Sales Taxes: 2.50', (string)$receiptRow);
	}

	/** @test */
	public function it_can_be_created_for_total()
	{
		$receiptRow = ReceiptRow::forTotal(
			Price::of(56.99)
		);

		$this->assertEquals('Total: 56.99', (string)$receiptRow);
	}
}
