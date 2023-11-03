# A Laravel wrapper for ChartJS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/imreallyunoriginal/laravel-chartjs.svg?style=flat-square)](https://packagist.org/packages/imreallyunoriginal/laravel-chartjs)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/imreallyunoriginal/laravel-chartjs/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/imreallyunoriginal/laravel-chartjs/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/imreallyunoriginal/laravel-chartjs/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/imreallyunoriginal/laravel-chartjs/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/imreallyunoriginal/laravel-chartjs.svg?style=flat-square)](https://packagist.org/packages/imreallyunoriginal/laravel-chartjs)

A Laravel PHP wrapper for ChartJS

## Installation

You can install the package via composer:

```bash
composer require imreallyunoriginal/laravel-chartjs
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-chartjs-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-chartjs-views"
```

## Usage

```php
Chart::radar('Test Chart', [
    Chart::dataset('Test 1', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
    Chart::dataset('Test 2', [12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1]),
])->setLabels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [imRlyUnoriginal](https://github.com/imReallyUnoriginal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
