<?php

namespace AmjadIqbal\Sonner\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Sonner extends Component
{
    public string $position;
    public string $theme;
    public int $duration;
    public bool $dismissible;

    public function __construct(
        string $position = 'bottom-right',
        string $theme = 'system',
        int $duration = 4000,
        bool $dismissible = true
    ) {
        $this->position = $position;
        $this->theme = $theme;
        $this->duration = $duration;
        $this->dismissible = $dismissible;
    }

    public function render(): View
    {
        return view('sonner::sonner', [
            'position' => $this->position,
            'theme' => $this->theme,
            'duration' => $this->duration,
            'dismissible' => $this->dismissible,
        ]);
    }
}
