# <span style="color:#8b5cf6">Laravel Sonner</span>

The ultimate Sonner toast notification wrapper for Laravel. Beautiful, stackable, and lightweight notifications for your Blade and Livewire applications.

![Social Banner](https://raw.githubusercontent.com/amjadiqbal/laravel-sonner/main/assets/laravel-sooner.png)

[![Packagist Version](https://img.shields.io/packagist/v/amjadiqbal/laravel-sonner?color=0ea5e9)](https://packagist.org/packages/amjadiqbal/laravel-sonner)
[![Packagist Downloads](https://img.shields.io/packagist/dt/amjadiqbal/laravel-sonner?color=22c55e)](https://packagist.org/packages/amjadiqbal/laravel-sonner)
[![License](https://img.shields.io/badge/license-MIT-8b5cf6.svg)](LICENSE)
[![CI: Pest](https://img.shields.io/github/actions/workflow/status/amjadiqbal/laravel-sonner/pest.yml?branch=main&label=CI%20(Pest)&color=2dd4bf)](https://github.com/amjadiqbal/laravel-sonner/actions)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D8.1-777bb3?logo=php)](#)
[![Laravel](https://img.shields.io/badge/Laravel-10%20%7C%2011-ff2d20?logo=laravel)](#)
[![Coverage](https://img.shields.io/badge/coverage-codecov-blue)](https://codecov.io/gh/amjadiqbal/laravel-sonner)

## SEO
- Modern Laravel Notifications
- Sonner Toast for Blade and Livewire
- Lightweight, stackable, beautiful toasts

## SEO Highlights
- <span style="color:#0ea5e9">Instant, sleek toast UX</span>
- <span style="color:#22c55e">Blade-first, Livewire-friendly</span>
- <span style="color:#f97316">Promise toasts, durations & positions</span>
- <span style="color:#8b5cf6">Lightweight + stackable layout</span>

## Installation

```bash
composer require amjadiqbal/laravel-sonner
```

## Usage

### Simple

```php
toast('Profile updated!');
```

### Advanced

```php
toast()
    ->success('Order Shipped')
    ->description('Your order #123 is on the way.')
    ->duration(5000);
```

### Blade Component

Add the component at the end of your layout:

```blade
<x-sonner position="bottom-right" theme="system" />
```

### Livewire Integration

From a Livewire component:

```php
public function save()
{
    toast()->success('Saved')->description('Your changes were saved.');
    $this->dispatch('sonner:toast', type: 'success', title: 'Saved', description: 'Your changes were saved.');
}
```

In your layout:

```blade
<x-sonner />
<script>
window.addEventListener('sonner:toast', function(e){
  const d = e.detail || {};
  window.Sonner[d.type || 'toast'](d.title || '', { description: d.description || '' });
});
</script>
```

### Promise

```blade
<button onclick="
  window.Sonner.promise(fetch('/ping'), {
    loading: 'Pinging...',
    success: 'Online',
    error: 'Offline'
  })
">Ping</button>
```

## Configuration

- position: top-left, top-right, top-center, bottom-left, bottom-right, bottom-center
- theme: system, light, dark
- duration: milliseconds
- dismissible: true/false

## Testing

```bash
composer install
vendor/bin/pest
```

## License

MIT
