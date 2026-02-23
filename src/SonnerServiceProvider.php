<?php

namespace AmjadIqbal\Sonner;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use AmjadIqbal\Sonner\View\Components\Sonner as SonnerComponent;
use AmjadIqbal\Sonner\Support\ToastManager;

class SonnerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ToastManager::class, function () {
            return new ToastManager();
        });
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sonner');
        Blade::component(SonnerComponent::class, 'sonner');
    }
}
