<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
     protected $guarded = [];

    public function Invoice()
    {
    	return $this->belongsTo(Invoice::class);
    }

    public function unitText()
    {
    	if($this->unit == 'piece')
    	{
    		$text = __('forntend/forntend.piece');
    	}
    	elseif($this->unit == 'g')
    	{
    		$text = __('forntend/forntend.gram');
    	}
    	elseif($this->unit == 'kg')
    	{
    		$text = __('forntend/forntend.kilo-gram');
    	}

    	return $text;
    }
}
