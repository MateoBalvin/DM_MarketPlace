<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
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
    $customers = $this->loadProvider();
    return view('livewire.admin.customer.index', [
      'customers' => $customers,
    ]);
  }

  public function loadProvider()
  {
    $customers = Customer::query()
      ->when($this->search, function ($query) {
        $query->where('name', 'like', '%' . $this->search . '%')
          ->orWhere('phone', 'like', '%' . $this->search . '%')
          ->orWhere('address', 'like', '%' . $this->search . '%')
          ->orWhere('email', 'like', '%' . $this->search . '%');
      })
      ->when($this->setStatus, function ($query2) {
        $query2->where('status', $this->setStatus);
      })
      ->orderBy('updated_at', 'desc')
      ->paginate($this->limit);
    return $customers;
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

  public function editModal(int $customerId)
  {
    $this->dispatch('OpenFormModal', $customerId);
  }

  public function deleteModal(int $customerId)
  {
    $this->dispatch('OpenDeleteModal', $customerId);
  }
}
