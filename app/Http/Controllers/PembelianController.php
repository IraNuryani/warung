<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pembelian;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePembelianRequest;
use App\Http\Requests\UpdatePembelianRequest;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pembelian = Pembelian::all();
            return response()->json($pembelian, 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePembelianRequest $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'jumlah' => 'required|integer',
            'total_harga' => 'required|integer',
            'distributor' => 'required|string',
            'tanggal_beli' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            $item = Item::find($request->item_id);

            $item->stok += $request->jumlah;
            $item->save();

            $pembelian = Pembelian::create($request->all());

            DB::commit();

            return response()->json($pembelian, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $Pembelian = Pembelian::with('item')->find($id);

            if (!$Pembelian) {
                return response()->json(['message' => 'Pembelian not found'], 404);
            }

            return response()->json($Pembelian, 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePembelianRequest $request, $id)
    {
        DB::beginTransaction();

    try {
        $pembelian = Pembelian::findOrFail($id);
        $item = $pembelian->item;
        $selisih = $request->jumlah - $pembelian->jumlah;
        $item->stok += $selisih;

        if ($item->stok < 0) {
            DB::rollBack();
            return response()->json(['error' => 'Stok tidak cukup.'], 400);
        }

        $item->save();
        $pembelian->update($request->validated());

        DB::commit();
        return response()->json(['message' => 'Pembelian berhasil diupdate dan stok diperbarui.'], 200);
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error($e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $pembelian = Pembelian::findOrFail($id);
            $item = $pembelian->item;
            $item->stok -= $pembelian->jumlah;

            if ($item->stok < 0) {
                return response()->json(['error' => 'Stok tidak cukup untuk menghapus pembelian ini.'], 400);
            }
            $item->save();
            $pembelian->delete();
            DB::commit();
            return response()->json(['message' => 'Pembelian berhasil dihapus dan stok diperbarui.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
