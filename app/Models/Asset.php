<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table ='assets';
    protected $fillable = ['donor_id','name','quantity','unit_price'];


    // protected $casts = [
    //     'name' => 'array',
    //     'quantity' => 'array',
    //     'unit_price' => 'array',
    // ];

    public function fishcenter()
    {
       
        return $this->belongsTo(FishCenter::class);

    }

    public function donor()
    {
       
        return $this->belongsTo(Donor::class);

    }

    public function shares(){

        return $this->belongsToMany(Share::class)->withPivot(['quantity']);
    
       }

    public static $rules = [
        'donor_id' => ['required','integer'],
        'name' => ['required','string'],
        'quantity' => ['required','integer'],
        'unit_price' => ['required'],
    ];

}
