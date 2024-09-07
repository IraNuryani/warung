<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';

    protected $fillable = ['item_id', 'jumlah', 'total_harga', 'tanggal_jual'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($penjualan) {
            $item = Item::find($penjualan->item_id);
            if ($item) {
                $penjualan->total_harga = $item->harga * $penjualan->jumlah;
            }
        });
    }
}
