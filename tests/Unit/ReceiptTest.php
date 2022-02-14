<?php

namespace SalesTaxes\Unit;

use PHPUnit\Framework\TestCase;
use SalesTaxes\Cart\Cart;
use SalesTaxes\Product\Price;
use SalesTaxes\Product\Product;
use SalesTaxes\Receipt\Receipt;
use SalesTaxes\TaxRate\FreeTaxRate;

class ReceiptTest extends TestCase
{
	/** @test */
	public function it_prints()
	{
		$cart = Cart::createWithProducts([
			Product::create('book', Price::of(12.49), 2, [
				new FreeTaxRate()
			])
		]);

		$receipt = new Receipt($cart);

		$this->assertEquals("2 book: 24.98\n", $receipt->print());
	}
}
