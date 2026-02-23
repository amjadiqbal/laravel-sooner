<?php

use Illuminate\Support\Facades\View;

it('renders the sonner component with custom configurations (position, theme)', function () {
    $html = (string) View::make('sonner::sonner', [
        'position' => 'top-left',
        'theme' => 'dark',
        'duration' => 5000,
        'dismissible' => true,
    ])->render();
    expect($html)->toContain('data-position="top-left"');
    expect($html)->toContain('data-theme="dark"');
    expect($html)->toContain('data-duration="5000"');
});

it('properly encodes toast data to JSON for the frontend component', function () {
    session()->put('sonner.toasts', [
        [
            'id' => 'abc',
            'type' => 'success',
            'title' => 'Saved',
            'description' => 'Item saved',
            'duration' => 3000,
            'position' => 'bottom-right',
            'dismissible' => true,
        ],
    ]);
    $html = (string) View::make('sonner::sonner', [
        'position' => 'bottom-right',
        'theme' => 'system',
        'duration' => 4000,
        'dismissible' => true,
    ])->render();
    expect($html)->toContain('Saved');
    expect($html)->toContain('success');
});
