<?php

namespace JobMetric\VoucherUsd;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Http;

class VoucherUsd
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected Application $app;

    /**
     * Create a new Vibe instance.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Authenticate user.
     *
     * @return array
     */
    public function auth(): array
    {
        $client_id = config('voucher-usd.params.client_id');
        $client_secret = config('voucher-usd.params.client_secret');

        $data = [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'grant_type' => 'client_credentials',
            'scope' => ''
        ];

        $response = Http::post(config('voucher-usd.api_urls.auth') . '/auth/token', $data);

        $body = json_decode($response->body(), true);

        if ($response->ok()) {
            return [
                'ok' => true,
                'message' => $body['message'],
                'data' => [
                    'token' => $body['result']['accessToken'],
                    'expire' => $body['result']['expiresIn'],
                    'scope' => $body['result']['scope'],
                ],
                'status' => 200,
            ];
        } else {
            return [
                'ok' => false,
                'message' => $response['title'],
                'status' => 400,
            ];
        }
    }
}
