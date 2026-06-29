<?php

namespace App\Livewire\Forms;

use App\Models\Provider;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProviderForm extends Form
{
    public ?Provider $providerModel = null;
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

	public function setProvider(Provider $providerModel)
	{
		$this->providerModel = $providerModel;
		$this->name = $providerModel->name;
		$this->email = $providerModel->email;
		$this->phone = $providerModel->phone;
		$this->address = $providerModel->address;
        $this->status = $providerModel->status;
	}

	public function createProvider()
	{
		$this->validate();

		$providerCreate = Provider::create([
			'name' => $this->name,
			'email' => $this->email,
			'phone' => $this->phone,
			'address' => $this->address,
			'status' => $this->status,
		]);

		return $providerCreate;
	}

	public function updateProvider()
	{
		$this->providerModel->update([
			'name' => $this->name,
			'email' => $this->email,
			'phone' => $this->phone,
			'address' => $this->address,
			'status' => $this->status,
		]);
	}

	public function deleteProvider($providerId)
	{
		$providerDelete = Provider::find($providerId);
		$providerDelete->delete();
	}
}
