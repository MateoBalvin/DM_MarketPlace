<?php

namespace App\Livewire\Admin\Product\Modals;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteModal extends Component
{
  public $product;
  public ProductForm $form;
  public function render()
  {
    return view('livewire.admin.product.modals.delete-modal');
  }

  #[On('OpenDeleteModal')]
  public function openModal($productId)
  {
    $this->product = Product::find($productId);
    $this->dispatch('open-modal', 'delete-modal');
  }

  public function delete()
  {
    $this->form->deleteProduct($this->product->id);
    $this->dispatch('refresh');
    $this->dispatch('close-modal', 'delete-modal');
  }
}
