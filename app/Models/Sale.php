<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

  protected $fillable = [
    'customer_id',
    'total',
    'sold_at',
  ];

  protected $cast = [
    'sold_at' => 'datetime',
  ];

  public function customer()
  {
    return $this->belongsTo(Customer::class, 'customer_id');
  }
}
