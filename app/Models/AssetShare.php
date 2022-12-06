<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetShare extends Model
{
    use HasFactory;

    protected $table ='asset_share';
    protected $fillable = ['asset_id','share_id','quantity'];
 
    public static $rules = [
        'asset_id' => ['required','integer'],
        'share_id' => ['required','string'],
        'quantity' => ['required','integer'],
        
    ];

    public function stocks()
    {
       
        return $this->hasMany(Stock::class);

    }

}
