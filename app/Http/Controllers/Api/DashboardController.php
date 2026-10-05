<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Operation;
use App\Models\LogisticsItem;

class DashboardController extends Controller
{
    public function summary() {
        return response()->json([
            'activeOperations' => Operation::where('status', 'Active')->count(),
            'totalStock' => LogisticsItem::sum('stock_quantity'),
            'pendingReview' => Operation::where('status', 'Pending')->count(),
        ]);
    }
}
