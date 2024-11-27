<?php

namespace JobMetric\VoucherUsd\Events;

class CreateVoucherUsdEvent
{
    public string $voucherCode;

    /**
     * Create a new event instance.
     *
     * @param string $voucherCode
     *
     * @return void
     */
    public function __construct(string $voucherCode)
    {
        $this->voucherCode = $voucherCode;
    }
}
