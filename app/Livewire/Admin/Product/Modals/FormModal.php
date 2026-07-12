<?php

namespace App\Livewire\Admin\Product\Modals;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use App\Models\Provider;
use Livewire\Attributes\On;
use Livewire\Component;

class FormModal extends Component
{
	public ProductForm $form;
	public $providers;
	public $product = null;

	public function render()
	{
		return view('livewire.admin.product.modals.form-modal');
	}

	public function mount()
	{
		$this->providers = Provider::all();
	}

	#[On('OpenFormModal')]
	public function openModal($productId = null)
	{
		$this->form->reset();
		$this->resetErrorBag();
		if ($productId) {
			$this->product = Product::findOrFail($productId);
			$this->form->setProduct($this->product);
		} else {
			$this->form->status = 'active';
		}

		$this->dispatch('open-modal', 'form-modal');
	}

	public function save()
	{
		$this->form->validate();
		if ($this->product) {
			$this->form->updateProduct();
		} else {
			$this->form->createProduct();
		}

		$this->dispatch('refresh');
		$this->dispatch('close-modal', 'form-modal');
	}
}
