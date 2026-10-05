<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Operation;
use App\Http\Requests\StoreOperationRequest;
use App\Http\Requests\UpdateOperationRequest;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function index(Request $request) {
        $query = Operation::with(['personnel.user', 'item']);

        // Search by operation code or item name[cite: 3]
        if ($search = $request->input('search')) {
            $query->where('operation_code', 'like', "%{$search}%")
                  ->orWhereHas('item', fn($q) => $q->where('name', 'like', "%{$search}%"));
        }

        // Filter by status workflow[cite: 3]
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Laravel API Pagination
        return response()->json($query->paginate(10));
    }

    public function store(StoreOperationRequest $request) {
        $operation = Operation::create($request->validated());
        return response()->json($operation->load(['personnel.user', 'item']), 201);
    }

    public function show(Operation $operation) {
        return response()->json($operation->load(['personnel.user', 'item']));
    }

    public function update(UpdateOperationRequest $request, Operation $operation) {
        $operation->update($request->validated());
        return response()->json($operation->load(['personnel.user', 'item']));
    }

    public function destroy(Operation $operation) {
        $operation->delete();
        return response()->json(null, 204);
    }

    // Status workflow transition (e.g., Pending -> Active -> Completed)[cite: 3, 8]
    public function updateStatus(Request $request, Operation $operation) {
        $request->validate([
            'status' => 'required|in:Pending,Active,Completed'
        ]);

        $operation->update(['status' => $request->status]);
        return response()->json($operation);
    }
}
