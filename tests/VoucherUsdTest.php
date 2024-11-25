<?php

namespace JobMetric\VoucherUsd\Tests;

use JobMetric\VoucherUsd\Facades\VoucherUsd;
use Throwable;

class VoucherUsdTest extends BaseVoucherUsd
{
    /**
     * @throws Throwable
     */
    public function test_auth()
    {
        $response = VoucherUsd::auth();

        $this->assertArrayHasKey('ok', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('status', $response);
        if ($response['ok']) {
            $this->assertEquals(200, $response['status']);
            $this->assertArrayHasKey('data', $response);
            $this->assertArrayHasKey('token', $response['data']);
            $this->assertArrayHasKey('expire', $response['data']);
            $this->assertArrayHasKey('scope', $response['data']);
        } else {
            $this->assertEquals(400, $response['status']);

        }
    }

    /**
     * @throws Throwable
     */
    public function test_balance()
    {
        $response = VoucherUsd::balance();

        $this->assertArrayHasKey('ok', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('status', $response);
        if ($response['ok']) {
            $this->assertEquals(200, $response['status']);
            $this->assertArrayHasKey('data', $response);
            $this->assertArrayHasKey('available', $response['data']);
            $this->assertArrayHasKey('actual', $response['data']);
        } else {
            $this->assertEquals(400, $response['status']);
        }
    }

    /**
     * @throws Throwable
     */
    public function test_create_voucher()
    {
        $response = VoucherUsd::createVoucher([
            'amount' => 0.1,
            'note' => 'Test voucher'
        ]);

        $this->assertArrayHasKey('ok', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('status', $response);
        $this->assertFalse($response['ok']);
        $this->assertEquals($response['message'], trans('voucher-usd::base.validation.errors'));
        $this->assertEquals(422, $response['status']);

        $response = VoucherUsd::createVoucher([
            'amount' => 1,
            'note' => 'Test voucher'
        ]);

        $this->assertArrayHasKey('ok', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('status', $response);
        if ($response['ok']) {
            $this->assertEquals(200, $response['status']);
            $this->assertArrayHasKey('data', $response);
            $this->assertArrayHasKey('voucher_code', $response['data']);
        } else {
            $this->assertEquals(400, $response['status']);
        }
    }
}
