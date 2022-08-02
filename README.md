# Laravel Blade Crawler check

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vlados/laravel-blade-crawler-detect.svg?style=flat-square)](https://packagist.org/packages/vlados/laravel-blade-crawler-detect)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/vlados/laravel-blade-crawler-detect/run-tests?label=tests)](https://github.com/vlados/laravel-blade-crawler-detect/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/vlados/laravel-blade-crawler-detect/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/vlados/laravel-blade-crawler-detect/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/vlados/laravel-blade-crawler-detect.svg?style=flat-square)](https://packagist.org/packages/vlados/laravel-blade-crawler-detect)

Simple package to add Blade directive @user to hide some parts of the blade from crawler bot

## Installation

You can install the package via composer:

```bash
composer require vlados/laravel-blade-crawler-detect
```

## Usage
Simply wrap your html with `@user ... code @enduser` to hide it from crawlers
```html
@user
<style>
    
</style>
@enduser
```

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
