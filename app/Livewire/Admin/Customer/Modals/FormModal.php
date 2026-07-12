<?php

namespace App\Livewire\Admin\Customer\Modals;

use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use Livewire\Attributes\On;
use Livewire\Component;

class FormModal extends Component
{
     public $customer;
    public CustomerForm $form;

    public function render()
    {
        return view('livewire.admin.customer.modals.form-modal');
    }

    #[On('OpenFormModal')]
	public function openModal($customerId = null)
	{
		$this->form->reset();
		$this->resetErrorBag();
		if ($customerId) {
			$this->customer = Customer::findOrFail($customerId);
			$this->form->setcustomer($this->customer);
		} else {
			$this->form->status = 'active';
		}

		$this->dispatch('open-modal', 'form-modal');
	}

    public function save()
	{
		$this->form->validate();
		if ($this->customer) {
			$this->form->updateCustomer();
		} else {
			$this->form->createCustomer();
		}

		$this->dispatch('refresh');
		$this->dispatch('close-modal', 'form-modal');
	}
}
