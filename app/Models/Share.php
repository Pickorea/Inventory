<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $table = 'shares';

    protected $fillable = ['share_date','fish_center_id', 'asset_id', 'allocated_quantity'];

    // public function assets(){

    //     return $this->belongsToMany(Asset::class)->withPivot(['quantity']);
    
    //    }

       public function fishcenter(){

        return $this->belongsTo(FishCenter::class);
    
       }

       public function stockitems(){

        return $this->hasMany(StockItem::class);
    
       }

    //    public function stocktakes(){

    //     return $this->belongsToMany(StockTake::class)->withPivot(['quantity']);
    
    //    }
       

    public static $rules = [
        'name' => ['required','string','unique:islands'],
        'fish_center_id' => ['required','integer'],
        
    ];
}
