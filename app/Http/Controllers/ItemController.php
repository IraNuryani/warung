<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return response()->json(Item::with('kategori')->get());
        try {
            $items = Item::all();
            return response()->json($items, 200);
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
    public function store(StoreItemRequest $request)
    {
        $request->validate([
            'item' => 'required',
            'item_kategori_id' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer'
        ]);

        $items = Item::create($request->all());
        return response()->json($items, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $item = Item::with('itemkategori')->find($id);

            if (!$item) {
                return response()->json(['message' => 'Item not found'], 404);
            }

            return response()->json($item, 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, $id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->update($request->validated()); 
            return response()->json($item, 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();
            return response()->json(['message' => 'Item berhasil dihapus'], 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
        }
    }
}
