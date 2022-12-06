<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTake extends Model
{
    use HasFactory;

    protected $table = 'stock_takes';

    protected $fillable = ['fishcenter_id','stock_take_date','comments'];


    public function stockitems(){

        return $this->hasMany(StockItem::class,'stock_take_id');
    
       }

    //    public function shares(){

    //     return $this->belongsToMany(Share::class)->withPivot(['quantity']);
    
    //    }
}
