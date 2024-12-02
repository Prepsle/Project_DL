<?php
namespace App\Services;

use GuzzleHttp\Client;

class BlockCypherService
{
    protected $client;
    protected $apiUrl = 'https://api.blockcypher.com/v1/btc/main';
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('1264a1f32bdd4db29df1c2b35028f78f'); // API key lấy từ BlockCypher
    }

    // Lấy thông tin tài khoản ví (công khai)
    public function getWalletInfo($address)
    {
        $response = $this->client->get("{$this->apiUrl}/addrs/{$address}");
        return json_decode($response->getBody()->getContents(), true);
    }

    // Gửi giao dịch từ ví Bitcoin (testnet hoặc mainnet)
    public function sendTransaction($from, $to, $amount, $privateKey)
    {
        $transactionData = [
            'inputs' => [['addresses' => [$from]]],
            'outputs' => [['addresses' => [$to], 'value' => $amount]]
        ];

        $response = $this->client->post("{$this->apiUrl}/txs/new", [
            'json' => $transactionData
        ]);

        $transaction = json_decode($response->getBody()->getContents(), true);

        // Chữ ký giao dịch
        $transaction['tosign'] = [$privateKey];
        
        $response = $this->client->post("{$this->apiUrl}/txs/send", [
            'json' => $transaction
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
