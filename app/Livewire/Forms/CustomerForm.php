<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerForm extends Form
{
    public ?Customer $customerModel = null;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $status;


    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'nullable',
        'phone' => 'required|min:3',
        'address' => 'nullable',
        'status' => 'required',
    ];

    protected $messages = [
        'name.required' => 'El nombre es obligatorio',
        'phone.required' => 'El teléfono es obligatorio',
        'status.required' => 'El estado es obligatorio',

        'name.min' => 'El nombre al menos debe tener 3 carácteres',
        'phone.min' => 'El teléfono al menos debe tener 3 carácteres',
    ];

    public function setCustomer(Customer $customerModel)
    {
        $this->customerModel = $customerModel;
        $this->name = $customerModel->name;
        $this->email = $customerModel->email;
        $this->phone = $customerModel->phone;
        $this->address = $customerModel->address;
        $this->status = $customerModel->status;
    }

    public function createCustomer()
    {
        $this->validate();

        $customerCreate = Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status,
        ]);

        return $customerCreate;
    }

    public function updateCustomer()
    {
        $this->customerModel->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status,
        ]);
    }

    public function deleteCustomer($customerId)
    {
        $customerDelete = customer::find($customerId);
        $customerDelete->delete();
    }
}
