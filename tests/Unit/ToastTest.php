<?php

it('can flash a notification to the session', function () {
    toast('Profile updated!');
    $toasts = session()->get('sonner.toasts', []);
    expect($toasts)->toHaveCount(1);
    expect($toasts[0]['title'])->toBe('Profile updated!');
    expect($toasts[0]['type'])->toBe('info');
});

it('can set the toast type to success', function () {
    toast()->success('Order Shipped')->description('Your order #123 is on the way.')->duration(5000);
    $toasts = session()->get('sonner.toasts', []);
    expect($toasts)->toHaveCount(1);
    expect($toasts[0]['title'])->toBe('Order Shipped');
    expect($toasts[0]['type'])->toBe('success');
    expect($toasts[0]['description'])->toBe('Your order #123 is on the way.');
    expect($toasts[0]['duration'])->toBe(5000);
});
