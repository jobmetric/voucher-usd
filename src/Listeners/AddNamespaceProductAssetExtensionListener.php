<?php

namespace JobMetric\VoucherUsd\Listeners;

use JobMetric\Product\Events\InjectDriverNamespaceAssetEvent;

class AddNamespaceProductAssetExtensionListener
{
    /**
     * Handle the event.
     *
     * @param InjectDriverNamespaceAssetEvent $event
     *
     * @return void
     */
    public function handle(InjectDriverNamespaceAssetEvent $event): void
    {
        $event->driverNamespace([
            'JobMetric\VoucherUsd\Extensions' => [
                'deletable' => false
            ]
        ]);
    }
}
