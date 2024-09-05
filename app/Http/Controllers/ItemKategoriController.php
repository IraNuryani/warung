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
        return response()->json(ItemKategori::with('kategori')->get());
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
            'kategori' => 'required'
        ]);

        $kategori = ItemKategori::create($request->all());
        return response()->json($kategori, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemKategori $itemKategori)
    {
        //
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
    public function update(UpdateItemKategoriRequest $request, ItemKategori $itemKategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemKategori $itemKategori)
    {
        //
    }
}
