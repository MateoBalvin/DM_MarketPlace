<?php

namespace App\Livewire\Forms;

use App\Models\Sale;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SaleForm extends Form
{
  public $customerSelected;
  public $productSelected;
  public $quantity = 1;
  
  public function createSale()
  {
    $sale = Sale::create([
      'customer_id' => $this->customerSelected?->id,
      'total' => null,
      'sold_at' => Carbon::now(),
      'status' => 'pending',
    ]);
    
    return $sale;
  }

  public function addProduct($sale)
  {
    $product = SaleDetail::create([
      'sale_id' => $sale->id,
      'product_id' => $this->productSelected->id,
      'quantity' => $this->quantity,
      'unit_price' => $this->productSelected->sale_price,
      'total' => $this->productSelected->sale_price * $this->quantity,
    ]);

    return $product;
  }
}
