<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Island extends Model
{
    use HasFactory;

    protected $table = 'islands';

    protected $fillable = ['name'];

    public function fishcenters()
    {
       
        return $this->hasMany(FishCenter::class);

    }

    public function islandsThroughStockTake()
    {
       
        return $this->hasManyThrough(StockTake::class, FishCenter::class,'island_id','fishcenter_id', 'id','id');

    }

    public function comments(){

        return $this->morphMany(Comment::class, 'commentable');
    }

    public static $rules = [
        'name' => ['required','string','unique:islands'],
    ];

   
}
