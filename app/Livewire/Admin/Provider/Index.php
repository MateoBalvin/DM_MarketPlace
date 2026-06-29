<?php

namespace App\Livewire\Admin\Provider;

use App\Models\Provider;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
  protected $listeners = ['refresh' => 'refresh'];
  use WithPagination;

  public $search;
  public $limit = 10;
  public $filterStatus;
  public $setStatus;

  public function render()
  {
    $providers = $this->loadProvider();
    return view('livewire.admin.provider.index', [
      'providers' => $providers,
    ]);
  }

  public function loadProvider()
  {
    $providers = Provider::query()
      ->when($this->search, function ($query) {
        $query->where('name', 'like', '%' . $this->search . '%')
          ->orWhere('phone', 'like', '%' . $this->search . '%')
          ->orWhere('address', 'like', '%' . $this->search . '%')
          ->orWhere('email', 'like', '%' . $this->search . '%');
      })
      ->when($this->setStatus, function ($query2) {
        $query2->where('status', $this->setStatus);
      })
      ->orderBy('updated_at','desc')
      ->paginate($this->limit);
    return $providers;
  }

  public function updatedSearch()
  {
    $this->resetPage();
  }

  public function updatedFilterStatus($statusValue)
  {
    $this->setStatus = $statusValue;
  }

  public function formModal()
  {
    $this->dispatch('OpenFormModal');
  }

  public function editModal(int $productId)
  {
    $this->dispatch('OpenFormModal', $productId);
  }

  public function deleteModal(int $productId)
  {
    $this->dispatch('OpenDeleteModal', $productId);
  }
}
