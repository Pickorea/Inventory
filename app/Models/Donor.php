<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $table ='donors';
    protected $fillable = ['name','description'];

    public function assets()
    {
       
        return $this->hasMany(Asset::class);

    }

    public static $rules = [
        'name' => ['required','string','unique:donors'],
        'description' => ['required','string'],
    ];

}
