<?php

namespace App\Http\Controllers;

use App\Services\BlockCypherService;
use Illuminate\Http\Request;

class BlockchainController extends Controller
{
    protected $blockCypherService;

    public function __construct(BlockCypherService $blockCypherService)
    {
        $this->blockCypherService = $blockCypherService;
    }

    // Hiển thị trang thanh toán
    public function index()
    {
        return view('blockchain.payment');
    }

    // Lấy thông tin ví
    public function getWalletInfo(Request $request)
    {
        $address = $request->input('address');
        $info = $this->blockCypherService->getWalletInfo($address);

        return response()->json($info);
    }

    // Gửi giao dịch
    public function sendTransaction(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $amount = $request->input('amount');
        $privateKey = $request->input('private_key');

        $transaction = $this->blockCypherService->sendTransaction($from, $to, $amount, $privateKey);

        return response()->json($transaction);
    }
}
