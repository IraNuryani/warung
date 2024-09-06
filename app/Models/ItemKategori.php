<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemKategori extends Model
{
    use HasFactory;

    protected $table = 'item_kategoris';

    protected $fillable = ['item_kategori'];

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
