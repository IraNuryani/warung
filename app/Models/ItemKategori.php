<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemKategori extends Model
{
    use HasFactory;

    protected $fillable = ['kategori'];

    // public function items()
    // {
    //     return $this->hasMany(Item:class);
    // }
}
