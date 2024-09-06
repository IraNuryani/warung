<?php

namespace App\Models;

use App\Models\ItemKategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = ['item', 'item_kategori_id', 'harga', 'stok'];

    public function itemkategori()
    {
        return $this->belongsTo(ItemKategori::class, 'item_kategori_id');
    }
}
