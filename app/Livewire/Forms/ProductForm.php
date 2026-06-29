<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
	public ?Product $productModel = null;
	public $name;
	public $priceCatalog;
	public $priceSale;
	public $status;
	public $provider;
	public $description;

	protected $rules = [
		'name' => 'required|min:3',
		'priceCatalog' => 'nullable',
		'priceSale' => 'nullable|gt:priceCatalog',
		'status' => 'required',
		'provider' => 'required',
		'description' => 'min:3|max:255',
	];

	protected $messages = [
		'name.required' => 'El nombre es obligatorio',
		'status.required' => 'El estado es obligatorio',
		'provider.required' => 'El proveedor es obligatorio',

		'name.min' => 'El nombre al menos debe tener 3 carácteres',
		'description.min' => 'La descripción al menos debe tener 3 carácteres',

		'description.max' => 'La descripción máximo debe tener 255 carácteres',

		'priceSale.gt' => 'El precio de venta debe ser mayor que el precio de catálogo',
	];

	public function setProduct(Product $productModel)
	{
		$this->productModel = $productModel;
		$this->name = $productModel->name;
		$this->priceCatalog = $productModel->catalog_price;
		$this->priceSale = $productModel->sale_price;
		$this->status = $productModel->status;
		$this->provider = $productModel->provider_id;
		$this->description = $productModel->description;
	}

	public function createProduct()
	{
		$this->normalizePrices();
		$this->validate();

		$productCreate = Product::create([
			'provider_id' => $this->provider,
			'name' => $this->name,
			'description' => $this->description,
			'catalog_price' => $this->priceCatalog,
			'sale_price' => $this->priceSale,
			'status' => $this->status,
		]);

		return $productCreate;
	}

	public function updateProduct()
	{
		$this->normalizePrices();
		$this->productModel->update([
			'provider_id' => $this->provider,
			'name' => $this->name,
			'description' => $this->description,
			'catalog_price' => $this->priceCatalog,
			'sale_price' => $this->priceSale,
			'status' => $this->status,
		]);
	}

	public function deleteProduct($productId)
	{
		$productDelete = Product::find($productId);
		$productDelete->delete();
	}

	protected function normalizePrices()
	{
		$this->priceCatalog = (int) str_replace('.', '', $this->priceCatalog);
		$this->priceSale = (int) str_replace('.', '', $this->priceSale);
	}
}
