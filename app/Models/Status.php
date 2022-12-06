<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = ['name'];

    public function stockitems()
    {
       
        return $this->hasMany(StockItem::class);

    }

    public static $rules = [
        'name' => ['required','string','unique:status'],
    ];

   
}
