<?php

namespace AmjadIqbal\Sonner\Support;

use Illuminate\Support\Str;

class ToastBuilder
{
    protected string $sessionKey;
    protected ?string $id = null;
    protected array $data = [
        'type' => 'info',
        'title' => null,
        'description' => null,
        'duration' => 4000,
        'position' => 'bottom-right',
        'dismissible' => true,
    ];

    public function __construct(string $sessionKey)
    {
        $this->sessionKey = $sessionKey;
    }

    public function success(string $title): self
    {
        $this->data['type'] = 'success';
        $this->data['title'] = $title;
        $this->commit();
        return $this;
    }

    public function error(string $title): self
    {
        $this->data['type'] = 'error';
        $this->data['title'] = $title;
        $this->commit();
        return $this;
    }

    public function info(string $title): self
    {
        $this->data['type'] = 'info';
        $this->data['title'] = $title;
        $this->commit();
        return $this;
    }

    public function warning(string $title): self
    {
        $this->data['type'] = 'warning';
        $this->data['title'] = $title;
        $this->commit();
        return $this;
    }

    public function promise(array $messages): self
    {
        $this->data['type'] = 'promise';
        $this->data['promise'] = [
            'loading' => $messages['loading'] ?? 'Loading...',
            'success' => $messages['success'] ?? 'Done',
            'error' => $messages['error'] ?? 'Failed',
        ];
        $this->commit();
        return $this;
    }

    public function description(string $text): self
    {
        $this->data['description'] = $text;
        $this->commitUpdate();
        return $this;
    }

    public function duration(int $ms): self
    {
        $this->data['duration'] = $ms;
        $this->commitUpdate();
        return $this;
    }

    public function position(string $position): self
    {
        $this->data['position'] = $position;
        $this->commitUpdate();
        return $this;
    }

    public function dismissible(bool $dismissible = true): self
    {
        $this->data['dismissible'] = $dismissible;
        $this->commitUpdate();
        return $this;
    }

    protected function commit(): void
    {
        $this->id = $this->id ?: Str::uuid()->toString();
        $this->data['id'] = $this->id;
        $toasts = \session()->get($this->sessionKey, []);
        $toasts[] = $this->data;
        \session()->put($this->sessionKey, $toasts);
    }

    protected function commitUpdate(): void
    {
        if (!$this->id) {
            return;
        }
        $toasts = \session()->get($this->sessionKey, []);
        foreach ($toasts as $index => $toast) {
            if (($toast['id'] ?? null) === $this->id) {
                $toasts[$index] = array_merge($toast, $this->data);
                break;
            }
        }
        \session()->put($this->sessionKey, $toasts);
    }
}
