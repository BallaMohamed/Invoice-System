<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function InvoiceDetails()
    {
    	return $this->hasMany(InvoiceDetail::class);
    }

    public function discountResult()
    {
    	return $this->discount_type == 'fixed' ? $this->discount_value : $this->discount_value.'%';
    }
}
