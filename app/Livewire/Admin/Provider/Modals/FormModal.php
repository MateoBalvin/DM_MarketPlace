<?php

namespace App\Livewire\Admin\Provider\Modals;

use App\Livewire\Forms\ProviderForm;
use App\Models\Provider;
use Livewire\Attributes\On;
use Livewire\Component;

class FormModal extends Component
{
    public $provider;
    public ProviderForm $form;

    public function render()
    {
        return view('livewire.admin.provider.modals.form-modal');
    }

    #[On('OpenFormModal')]
	public function openModal($providerId = null)
	{
		$this->form->reset();
		$this->resetErrorBag();
		if ($providerId) {
			$this->provider = Provider::findOrFail($providerId);
			$this->form->setProvider($this->provider);
		} else {
			$this->form->status = 'active';
		}

		$this->dispatch('open-modal', 'form-modal');
	}

    public function save()
	{
		$this->form->validate();
		if ($this->provider) {
			$this->form->updateProvider();
		} else {
			$this->form->createProvider();
		}

		$this->dispatch('refresh');
		$this->dispatch('close-modal', 'form-modal');
	}
}
