<?php

namespace AmjadIqbal\Sonner\Support;

use Illuminate\Support\Str;

class ToastManager
{
    protected string $sessionKey = 'sonner.toasts';

    public function builder(?string $message = null): ToastBuilder
    {
        $builder = new ToastBuilder($this->sessionKey);
        if ($message !== null) {
            $builder->info($message);
        }
        return $builder;
    }

    public function flash(array $toast): string
    {
        $id = $toast['id'] ?? Str::uuid()->toString();
        $toast['id'] = $id;
        $toasts = \session()->get($this->sessionKey, []);
        $toasts[] = $toast;
        \session()->put($this->sessionKey, $toasts);
        return $id;
    }

    public function update(string $id, array $changes): void
    {
        $toasts = \session()->get($this->sessionKey, []);
        foreach ($toasts as $index => $toast) {
            if (($toast['id'] ?? null) === $id) {
                $toasts[$index] = array_merge($toast, $changes);
                break;
            }
        }
        \session()->put($this->sessionKey, $toasts);
    }
}
