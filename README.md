# Laravel Blade Crawler Detect

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vlados/laravel-blade-crawler-detect.svg?style=flat-square)](https://packagist.org/packages/vlados/laravel-blade-crawler-detect)
[![Total Downloads](https://img.shields.io/packagist/dt/vlados/laravel-blade-crawler-detect.svg?style=flat-square)](https://packagist.org/packages/vlados/laravel-blade-crawler-detect)

Two Blade directives — `@user` and `@unlessuser` — that branch your view based on whether the current request comes from a real human or a crawler (Googlebot, Bingbot, Lighthouse, Page Speed, and the full [`jaybizzle/crawler-detect`](https://github.com/JayBizzle/Crawler-Detect) list).

Use it as an SEO helper: serve interactive widgets, third-party scripts and large UI chrome to humans, and serve lean, keyword-rich markup to search engines.

> [!IMPORTANT]
> Showing different content to users and search engines can be considered cloaking under [Google's spam policies](https://developers.google.com/search/docs/essentials/spam-policies#cloaking). The intended use of this package is to hide things crawlers don't need (heavy JS widgets, cookie banners, login chrome, ad slots) — not to inject keywords humans never see. Use it responsibly.

## Installation

```bash
composer require vlados/laravel-blade-crawler-detect
```

The service provider is auto-registered. Requires PHP 8.1+ and Laravel 10, 11, 12, or 13.

## Usage

### `@user` — content for humans only

Wrap anything you don't want crawlers to render: heavy JS, third-party scripts, modal triggers, cart buttons, login forms, cookie banners, ad slots, etc.

```blade
@user
    <button onclick="addToCart({{ $product->id }})">Add to cart</button>
    <script src="https://example.com/heavy-widget.js"></script>
@enduser
```

### `@unlessuser` — content for crawlers only

The inverse: wrap markup you only want indexed. Useful for SEO-focused product descriptions, structured FAQ blocks, expanded keyword lists or alternative anchor text that would clutter the human UI.

```blade
@unlessuser
    <h2>Buy {{ $product->name }} online — free shipping, 30-day returns</h2>
    <p>{{ $product->long_seo_description }}</p>
@enduser
```

### Combining both

```blade
@user
    <product-gallery :images="{{ $product->images }}"></product-gallery>
@enduser

@unlessuser
    @foreach ($product->images as $image)
        <img src="{{ $image->url }}" alt="{{ $image->alt }}">
    @endforeach
@enduser
```

## What counts as a crawler?

Detection is delegated to [`jaybizzle/crawler-detect`](https://github.com/JayBizzle/Crawler-Detect), which ships a regularly-updated regex covering thousands of bots. This package additionally treats the following as crawlers (since they typically run as part of audits, not real visits):

- `Chrome-Lighthouse`
- `Google Page Speed`

Both directives read the user agent from the current request on every render — they're safe under Octane, Swoole and other long-running workers.

## Security

The user-agent header is attacker-controlled. To defend against ReDoS on pathological input, the directive clamps the UA to 2048 characters before running any regex. CrawlerDetect itself is registered with `bind()` (not `singleton()`) so its `$_SERVER`-derived state never leaks across requests.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/vlados/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Vladislav Stoitsov](https://github.com/vlados)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
