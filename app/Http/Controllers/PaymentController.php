<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ZaloPayService;

class PaymentController extends Controller
{
    protected $zaloPayService;

    public function __construct(ZaloPayService $zaloPayService)
    {
        $this->zaloPayService = $zaloPayService;
    }

    public function createOrder(Request $request)
    {
        $order = [
            'app_user' => $request->input('app_user'),
            'amount' => $request->input('amount'),
            'app_trans_id' => $request->input('app_trans_id'),
            'embed_data' => $request->input('embed_data'),
            'item' => $request->input('item'),
            'bank_code' => $request->input('bank_code'),
            'description' => $request->input('description')
        ];

        $result = $this->zaloPayService->createOrder($order);

        return response()->json($result);
    }
}
