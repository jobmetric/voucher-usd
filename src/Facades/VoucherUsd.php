<?php

namespace JobMetric\VoucherUsd\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JobMetric\VoucherUsd\VoucherUsd
 *
 * @method static array auth()
 * @method static array balance()
 * @method static array createVoucher(array $data)
 * @method static array getVouchers()
 * @method static array showVoucher(string $voucherCode)
 */
class VoucherUsd extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \JobMetric\VoucherUsd\VoucherUsd::class;
    }
}
