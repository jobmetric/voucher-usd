<?php

namespace JobMetric\VoucherUsd;

use Illuminate\Contracts\Foundation\Application;

class VoucherUsd
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected Application $app;

    /**
     * Create a new Vibe instance.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
