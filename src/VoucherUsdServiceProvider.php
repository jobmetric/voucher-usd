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
            $this->loadTranslationPlugin();
        }
    }

    /**
     * Load translation plugin
     *
     * @return void
     */
    private function loadTranslationPlugin(): void
    {
        $ds = DIRECTORY_SEPARATOR;
        $extensionPath = __DIR__ . $ds . 'Extensions';
        if (is_dir($extensionPath)) {
            $extensions = array_diff(scandir($extensionPath), ['..', '.']);

            foreach ($extensions as $extension) {
                $modules = array_diff(scandir($extensionPath . $ds . $extension), ['..', '.']);
                foreach ($modules as $module) {
                    $langFile = $extensionPath . $ds . $extension . $ds . $module . $ds . 'lang' . $ds . app()->getLocale() . $ds . 'extension.php';

                    if (!file_exists($langFile)) {
                        $langFile = $extensionPath . $ds . $extension . $ds . $module . $ds . "lang${$ds}en${$ds}extension.php";
                    }

                    if(file_exists($langFile)) {
                        $this->loadTranslationsFrom($extensionPath . $ds . $extension . $ds . $module . $ds . 'lang', 'extension-' . Str::kebab($extension) . '-' . Str::kebab($module));
                    }
                }
            }
        }
    }
}
