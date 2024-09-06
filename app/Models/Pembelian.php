<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelians';

    protected $fillable = ['item_id', 'jumlah', 'total_harga', 'distributor', 'tanggal_beli'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
