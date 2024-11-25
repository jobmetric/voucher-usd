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
}
