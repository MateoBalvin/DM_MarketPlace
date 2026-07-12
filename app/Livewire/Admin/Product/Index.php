<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\Provider;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
	use WithPagination;

	protected $listeners = ['refresh' => 'refresh'];

	public $search;
	public $limit = 10;
	public $filterStatus;
	public $setStatus;

	public $providers;
	public $filterProvider;
	public $setProvider;

	public function render()
	{
		$products = $this->loadProducts();
		return view('livewire.admin.product.index', [
			'products' => $products,
		]);
	}

	public function mount()
	{
		$this->providers = Provider::where('status', 'active')->get();
	}

	public function loadProducts()
	{
		$products = Product::query()
			->when($this->search, function ($query) {
				$query->where('name', 'like', '%' . $this->search . '%')
					->orWhere('description', 'like', '%' . $this->search . '%');
			})
			->when($this->setStatus, function ($query2) {
				$query2->where('status', $this->setStatus);
			})
			->when($this->setProvider, function ($query3) {
				$query3->where('provider_id', $this->setProvider);
			})
			->orderBy('updated_at','desc')
			->paginate($this->limit);

		return $products;
	}

	public function updatedSearch()
	{
		$this->resetPage();
	}

	public function updatedFilterStatus($statusValue)
	{
		$this->setStatus = $statusValue;
	}

	public function updatedfilterProvider($providerValue)
	{
		$this->setProvider = $providerValue;
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
