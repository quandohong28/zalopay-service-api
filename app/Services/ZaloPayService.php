<?php

namespace App\Services;

use GuzzleHttp\Client;

class ZaloPayService
{
    protected $client;
    protected $app_id;
    protected $key1;
    protected $key2;
    protected $endpoint;

    public function __construct()
    {
        $this->client = new Client();
        $this->app_id = config('zalopay.app_id');
        $this->key1 = config('zalopay.key1');
        $this->key2 = config('zalopay.key2');
        $this->endpoint = config('zalopay.endpoint');
    }

    public function createOrder($order)
    {
        $data = [
            'app_id' => $this->app_id,
            'app_user' => $order['app_user'],
            'amount' => $order['amount'],
            'app_trans_id' => $order['app_trans_id'],
            'app_time' => round(microtime(true) * 1000),
            'embed_data' => $order['embed_data'],
            'item' => $order['item'],
            'bank_code' => $order['bank_code'],
            'description' => $order['description'],
            'mac' => hash_hmac('sha256', $this->app_id . "|" . $order['app_trans_id'] . "|" . $order['app_user'] . "|" . $order['amount'] . "|" . $order['app_time'] . "|" . $order['embed_data'] . "|" . $order['item'], $this->key1)
        ];

        $response = $this->client->post($this->endpoint . '/createorder', [
            'json' => $data
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getOrderStatus ($order_id) {
        
    }
}
