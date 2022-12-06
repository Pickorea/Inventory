<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;

    protected $table = 'share_stock_takes';

    protected $fillable = ['asset_id', 'stock_take_id', 'status_id','quantity', 'defects'];

    // public function share(){

    //     return $this->belongsTo(class:Share);

    // }

    public function stocktake(){

        return $this->belongsTo(StockTake :: class);

    }
}
