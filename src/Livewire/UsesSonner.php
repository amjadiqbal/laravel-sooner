<?php

namespace AmjadIqbal\Sonner\Livewire;

trait UsesSonner
{
    public function sonner(string $type, string $title, ?string $description = null, ?int $duration = null): void
    {
        $builder = toast();
        if ($type === 'success') {
            $builder->success($title);
        } elseif ($type === 'error') {
            $builder->error($title);
        } elseif ($type === 'warning') {
            $builder->warning($title);
        } else {
            $builder->info($title);
        }
        if ($description) {
            $builder->description($description);
        }
        if ($duration) {
            $builder->duration($duration);
        }
        if (method_exists($this, 'dispatch')) {
            $this->dispatch('sonner:toast', type: $type, title: $title, description: $description, duration: $duration);
        }
    }
}
