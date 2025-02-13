<?php

namespace JobMetric\VoucherUsd;

use Illuminate\Support\Str;
use JobMetric\VoucherUsd\Providers\EventServiceProvider;
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
            ->registerClass('event', EventServiceProvider::class, RegisterClassTypeEnum::REGISTER())
            ->registerClass('VoucherUsd', VoucherUsd::class, RegisterClassTypeEnum::SINGLETON());
    }

    /**
     * After boot package
     *
     * @return void
     */
    public function afterBootPackage(): void
    {
        if (checkDatabaseConnection() && !app()->runningInConsole() && !app()->runningUnitTests()) {
            loadTranslationExtension(__DIR__ . DIRECTORY_SEPARATOR . 'Extensions');
        }
    }
}
