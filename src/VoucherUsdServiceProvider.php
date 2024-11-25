<?php

namespace JobMetric\VoucherUsd;

use JobMetric\PackageCore\Enums\RegisterClassTypeEnum;
use JobMetric\PackageCore\Exceptions\RegisterClassTypeNotFoundException;
use JobMetric\PackageCore\PackageCore;
use JobMetric\PackageCore\PackageCoreServiceProvider;

class VoucherUsdServiceProvider extends PackageCoreServiceProvider
{
    /**
     * @throws RegisterClassTypeNotFoundException
     */
    public function configuration(PackageCore $package): void
    {
        $package->name('voucher-usd')
            ->hasConfig()
            ->hasTranslation()
            ->registerClass('VoucherUsd', VoucherUsd::class, RegisterClassTypeEnum::SINGLETON());
    }
}
