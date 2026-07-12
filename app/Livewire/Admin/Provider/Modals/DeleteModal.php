<?php

namespace App\Livewire\Admin\Provider\Modals;

use App\Livewire\Forms\ProviderForm;
use App\Models\Provider;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteModal extends Component
{
    public $provider;
    public ProviderForm $form;

    public function render()
    {
        return view('livewire.admin.provider.modals.delete-modal');
    }

    #[On('OpenDeleteModal')]
  public function openModal($providerId)
  {
    $this->provider = Provider::find($providerId);
    $this->dispatch('open-modal', 'delete-modal');
  }

  public function delete()
  {
    $this->form->deleteProvider($this->provider->id);
    $this->dispatch('refresh');
    $this->dispatch('close-modal', 'delete-modal');
  }
}
