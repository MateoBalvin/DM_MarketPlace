<?php

namespace App\Livewire\Admin\Customer\Modals;

use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteModal extends Component
{
    public $customer;
    public CustomerForm $form;

    public function render()
    {
        return view('livewire.admin.customer.modals.delete-modal');
    }

    #[On('OpenDeleteModal')]
  public function openModal($customerId)
  {
    $this->customer = Customer::find($customerId);
    $this->dispatch('open-modal', 'delete-modal');
  }

  public function delete()
  {
    $this->form->deletecustomer($this->customer->id);
    $this->dispatch('refresh');
    $this->dispatch('close-modal', 'delete-modal');
  }
}
