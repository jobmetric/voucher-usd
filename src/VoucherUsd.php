<?php

namespace JobMetric\VoucherUsd;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use JobMetric\VoucherUsd\Http\Requests\CreateVoucherRequest;

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

    /**
     * Get balance.
     *
     * @return array
     */
    public function balance(): array
    {
        $auth = $this->auth();

        if ($auth['ok']) {
            $response = Http::withToken($auth['data']['token'])->get(config('voucher-usd.api_urls.base') . '/b2b/accounts/balance');

            $body = json_decode($response->body(), true);

            if ($response->ok()) {
                return [
                    'ok' => true,
                    'message' => $body['message'],
                    'data' => [
                        'available' => $body['result']['availableBalance'],
                        'actual' => $body['result']['actualBalance'],
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
        } else {
            return $auth;
        }
    }

    /**
     * Create Voucher.
     *
     * @param array $data
     *
     * @return array
     */
    public function createVoucher(array $data): array
    {
        $validator = Validator::make($data, (new CreateVoucherRequest)->rules());
        if ($validator->fails()) {
            $errors = $validator->errors()->all();

            return [
                'ok' => false,
                'message' => trans('voucher-usd::base.validation.errors'),
                'errors' => $errors,
                'status' => 422
            ];
        } else {
            $validated_data = $validator->validated();

            $auth = $this->auth();

            if ($auth['ok']) {
                $data = [
                    'amount' => $validated_data['amount'],
                    'currency' => 'USD',
                    'additionalDescription' => $validated_data['note'],
                ];

                $response = Http::withToken($auth['data']['token'])->post(config('voucher-usd.api_urls.base') . '/b2b/vouchers', $data);

                $body = json_decode($response->body(), true);

                if ($response->ok()) {
                    return [
                        'ok' => true,
                        'message' => $body['result']['description'] ?? $body['message'],
                        'data' => [
                            'voucher_code' => $body['result']['voucherCode']
                        ],
                        'status' => 200,
                    ];
                } else {
                    if ($response['title'] == 'InsufficientBalanceException') {
                        // @todo: send email to admin or make a log or something || or return a message to user || or make a notification || or make a event
                    }

                    return [
                        'ok' => false,
                        'message' => $response['detail'] ?? $response['title'],
                        'status' => 400,
                    ];
                }
            } else {
                return $auth;
            }
        }
    }
}
