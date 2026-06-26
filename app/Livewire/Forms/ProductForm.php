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

	protected $rules = [
		'name' => 'required|min:3',
		'priceCatalog' => 'nullable|integer',
		'priceSale' => 'nullable|integer',
		'status' => 'required',
	];

	protected $message = [
		'name.required' => 'El nombre es obligatorio',
		'status.required' => 'El estado es obligatorio',
	];

	public function setProduct(Product $productModel)
	{
		$this->productModel = $productModel;
		$this->name = $productModel->name;
		$this->priceCatalog = $productModel->catalog_price;
		$this->priceSale = $productModel->sale_price;
	}

	public function createProduct()
	{
		$productCreate = Product::create([
			'name' => $this->name,
			'catalog_price' => $this->priceCatalog,
			'sale_price' => $this->priceSale,
			'status' => $this->status,
		]);

		return $productCreate;
	}
}
