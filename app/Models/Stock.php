<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    protected $fillable = ['current_stock','asset_id'];

    public function asset()
    {
       
        return $this->belongsTo(Asset :: class);

    }

    public function assetShare()
    {
       
        return $this->belongsTo(AssetShare :: class);

    }

    public static $rules = [
        'name' => ['required','string'],
        'asset_id' => ['required','string'],
    ];
}
