<?php

namespace JobMetric\VoucherUsd\Extensions\ProductAssets\VoucherUsd;

use JobMetric\Extension\Contracts\ExtensionContract;
use JobMetric\Product\Contracts\ProductInterfaceAssetContract;

class VoucherUsd implements ExtensionContract, ProductInterfaceAssetContract
{
    /**
     * Handle the extension.
     *
     * @param array $options
     *
     * @return string|null
     */
    public function handle(array $options = []): ?string
    {
        return 'Handle the extension';
    }

    /**
     * Install the extension.
     *
     * @return void
     */
    public static function install(): void
    {
        //
    }

    /**
     * Uninstall the extension.
     *
     * @return void
     */
    public static function uninstall(): void
    {
        //
    }
}
