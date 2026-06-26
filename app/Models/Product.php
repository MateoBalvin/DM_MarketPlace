<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'products';

  protected $fillable = [
    'provider_id',
    'name',
    'description',
    'catalog_price',
    'sale_price',
    'status',
  ];

  public function provider()
  {
    return $this->belongsTo(Provider::class, 'provider_id');
  }
}
