<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Qr\QrService;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function __invoke(Request $request, QrService $qrService)
    {
        $validated = $request->validate([
            'data' => 'required|string',
        ]);

        try {
            $base64ImageString = $qrService->generateFromString($validated['data']);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Success generate QR code.',
            'data' => [
                'image' => $base64ImageString,
            ],
        ]);
    }
}
