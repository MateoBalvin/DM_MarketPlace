<?php

namespace App\Livewire\Admin\Sale\Modals;

use App\Livewire\Forms\SaleForm;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleDetail;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class SaleDetailModal extends Component
{
  protected $listeners = ['refresh' => 'refresh'];

  public SaleForm $form;
  public $date;
  public $searchCustomer;
  public $customerSelected = null;
  public $customers = null;
  public bool $appearCustomer = true;

  public $searchProduct;
  public $productSelected = null;
  public $products = null;
  public bool $appearProduct = true;

  public $sale;
  public $salesDetail;

  public function render()
  {
    $this->salesDetail = $this->loadSaleDetail();
    return view('livewire.admin.sale.modals.sale-detail-modal', [
      'salesDetail' => $this->salesDetail,
    ]);
  }

  public function mount()
  {
    $this->date = Carbon::now()->format('d/m/Y');
  }

  #[On('OpenSaleDetailModal')]
  public function openModal()
  {
    $this->dispatch('open-modal', 'sale-detail-modal');
  }

  public function updatedSearchCustomer($value)
  {
    $this->customers = Customer::query()
      ->where('status', 'active')
      ->where('name', 'like', '%' . $value . '%')
      ->get();

    $this->appearCustomer = true;
    $this->customerSelected = null;
  }

  public function selectedCustomer($customerId)
  {
    $this->customerSelected = Customer::find($customerId);
    $this->searchCustomer = $this->customerSelected->name;
    $this->appearCustomer = false;
  }

  public function updatedSearchProduct($value)
  {
    $this->products = Product::query()
      ->where('status', 'active')
      ->where('name', 'like', '%' . $value . '%')
      ->get();

    $this->appearProduct = true;
    $this->productSelected = null;
  }

  public function selectedProduct($ProductId)
  {
    $this->productSelected = Product::find($ProductId);
    $this->searchProduct = $this->productSelected->name;
    $this->appearProduct = false;
  }

  public function addProduct()
  {
    $this->form->customerSelected = $this->customerSelected;
    $this->form->productSelected = $this->productSelected;

    if (!$this->sale) {
      $this->sale = $this->form->createSale();
    }

    $this->form->addProduct($this->sale);
  }

  public function loadSaleDetail()
  {
    $salesDetail = SaleDetail::where('sale_id', $this->sale?->id)->get();
    return $salesDetail;
  }
}
