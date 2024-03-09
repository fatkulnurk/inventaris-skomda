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

    public function show(Request $request, $id)
    {
        $inventory = $this->inventoryService->show($id);

        if (blank($inventory)) {
            return response()->json([
                'message' => 'Data not found.',
            ], 404);
        }

        return response()->json([
            'message' => 'success retrieved data by id.',
            'data' => $this->inventoryService->show($id),
        ]);
    }

    public function findByQr(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $inventory = $this->inventoryService->showByQrCode($validated['code']);

        if (blank($inventory)) {
            return response()->json([
                'message' => 'Data not found.',
            ], 404);
        }

        return response()->json([
            'message' => 'success retrieved data by qr code.',
            'data' => $inventory,
        ]);
    }
}
