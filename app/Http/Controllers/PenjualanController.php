<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $penjualan = Penjualan::all();
            return response()->json($penjualan, 200);
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
    public function store(StorePenjualanRequest $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'jumlah' => 'required|integer',
            'tanggal_jual' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            $item = Item::find($request->item_id);

            $item->stok -= $request->jumlah;
            $item->save();

            $penjualan = Penjualan::create($request->all());

            DB::commit();

            return response()->json($penjualan, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenjualanRequest $request, $id)
    {
        DB::beginTransaction();

    try {
        $penjualan = Penjualan::findOrFail($id);
        $item = $penjualan->item;
        $selisih = $request->jumlah - $penjualan->jumlah;
        $item->stok -= $selisih;

        if ($item->stok < 0) {
            DB::rollBack();
            return response()->json(['error' => 'Stok tidak cukup.'], 400);
        }

        $item->save();

        $penjualan->jumlah = $request->jumlah;
        $penjualan->total_harga = $item->harga * $penjualan->jumlah;
        $penjualan->save();

        DB::commit();

        return response()->json($penjualan->load('item'), 200);
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error($e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }
}
