<?php

use AmjadIqbal\Sonner\Support\ToastManager;

if (!function_exists('toast')) {
    function toast(?string $message = null): \AmjadIqbal\Sonner\Support\ToastBuilder
    {
        $manager = app(ToastManager::class);
        return $manager->builder($message);
    }
}
