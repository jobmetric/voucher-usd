<?php

namespace JobMetric\VoucherUsd\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use JobMetric\Product\Events\InjectDriverNamespaceAssetEvent;
use JobMetric\VoucherUsd\Listeners\AddNamespaceProductAssetExtensionListener;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        InjectDriverNamespaceAssetEvent::class => [
            AddNamespaceProductAssetExtensionListener::class,
        ],
    ];
}
