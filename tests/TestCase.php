<?php

namespace AmjadIqbal\Sonner\Tests;

use AmjadIqbal\Sonner\SonnerServiceProvider;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\View\ViewServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SonnerServiceProvider::class,
            SessionServiceProvider::class,
            ViewServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Session' => Session::class,
            'View' => View::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        config()->set('session.driver', 'array');
        $this->app['session']->start();
    }
}
