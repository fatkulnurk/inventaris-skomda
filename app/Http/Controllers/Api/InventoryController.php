<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Inventories\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(private InventoryService|null $inventoryService = null)
    {
        $this->inventoryService = $inventoryService ?? new InventoryService();
    }

    public function findByQr(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255',
        ]);

        return response()->json([
            'status' => 'success retrieved data by qr code.',
            'data' => $this->inventoryService->showByQrCode($validated['code']),
        ]);
    }
}
