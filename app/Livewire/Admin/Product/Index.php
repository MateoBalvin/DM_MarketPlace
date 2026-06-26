<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['refresh' => 'refresh'];

    public $products;

    public function render()
    {
        $this->products = $this->loadProducts();
        return view('livewire.admin.product.index');
    }

    public function loadProducts()
  {
    $products = Product::all();
    return $products;
  }

  public function formModal()
  {
    $this->dispatch('OpenFormModal');
  }
}
