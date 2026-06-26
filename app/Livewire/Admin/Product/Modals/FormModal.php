<?php

namespace App\Livewire\Admin\Product\Modals;

use App\Livewire\Forms\ProductForm;
use Livewire\Attributes\On;
use Livewire\Component;

class FormModal extends Component
{
    public ProductForm $form;

    public function render()
    {
        return view('livewire.admin.product.modals.form-modal');
    }

    #[On('OpenFormModal')]
    public function openModal()
    {
        $this->dispatch('open-modal', 'form-modal');
    }

    public function save()
    {
        $this->form->createProduct();
        $this->dispatch('refresh');
        $this->dispatch('close-modal', 'form-modal');
    }
}
