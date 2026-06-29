<?php

namespace App\Livewire\Admin\Sale;

use App\Models\Sale;
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
    $sales = $this->loadSale();
    return view('livewire.admin.sale.index', [
      'sales' => $sales,
    ]);
  }

  public function loadSale()
  {
    $sales = Sale::query()
    ->orderBy('updated_at','desc')
    ->paginate($this->limit);

    return $sales;
  }

  public function updatedSearch()
  {
    $this->resetPage();
  }

  public function updatedFilterStatus($statusValue)
  {
    $this->setStatus = $statusValue;
  }

  public function saleDetailModal()
  {
    $this->dispatch('OpenSaleDetailModal');
  }
}
