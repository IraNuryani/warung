<?php

namespace App\Http\Controllers;

use App\Models\ItemKategori;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItemKategoriRequest;
use App\Http\Requests\UpdateItemKategoriRequest;

class ItemKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kategori = ItemKategori::all();
            return response()->json($kategori, 200);
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
    public function store(StoreItemKategoriRequest $request)
    {
        $request->validate([
            'item_kategori' => 'required'
        ]);

        $kategori = ItemKategori::create($request->all());
        return response()->json($kategori, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $kategori = ItemKategori::find($id); 
    
            if (!$kategori) {
                return response()->json(['message' => 'Kategori not found'], 404);
            }
    
            return response()->json($kategori, 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemKategori $itemKategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemKategoriRequest $request, $id)
    {
        try {
            $kategori = ItemKategori::findOrFail($id);
            $kategori->update($request->validated()); 
            return response()->json($kategori, 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kategori = ItemKategori::findOrFail($id);
            $kategori->delete();
            return response()->json(['message' => 'Kategori berhasil dihapus'], 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error', 'error' => $e->getMessage()], 500);
        }
    }
}
