<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogisticsItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'quantity' => 'sometimes|integer',
        'stock_quantity' => 'sometimes|integer',
        'status' => 'required|string',
    ]);

    $data = $request->all();

    // Automatically map 'quantity' to 'stock_quantity' if provided
    if ($request->has('quantity') && !$request->has('stock_quantity')) {
        $data['stock_quantity'] = $request->quantity;
    }

    $item = \App\Models\LogisticsItem::create($data);

    return response()->json([
        'message' => 'Item created successfully',
        'item' => $item
    ], 201);
}

    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updateStatus(Request $request, $id)
{
    $item = \App\Models\LogisticsItem::findOrFail($id);

    $request->validate([
        'status' => 'required|string',
    ]);

    $item->status = $request->status;
    $item->save();

    return response()->json([
        'message' => 'Status updated successfully',
        'item' => $item
    ], 200);
}
}
