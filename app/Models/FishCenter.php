<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishCenter extends Model
{
    use HasFactory;

    protected $table = 'fish_centers';
    protected $fillable = ['name','island_id'];

    public function shares()
    {
       
        return $this->hasMany(Share::class);

    }

    public function island()
    {
       
        return $this->belongsTo(Island::class);

    }
    public static $rules = [
        'name' => ['required','string','unique:islands'],
        'island_id' => ['required'],
    ];

}
