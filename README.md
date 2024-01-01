# Laravel-ChartJS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/imreallyunoriginal/laravel-chartjs.svg?style=flat-square)](https://packagist.org/packages/imreallyunoriginal/laravel-chartjs)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/imreallyunoriginal/laravel-chartjs/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/imreallyunoriginal/laravel-chartjs/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/imreallyunoriginal/laravel-chartjs/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/imreallyunoriginal/laravel-chartjs/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/imreallyunoriginal/laravel-chartjs.svg?style=flat-square)](https://packagist.org/packages/imreallyunoriginal/laravel-chartjs)

A simple, intuitive, and eloquent Laravel PHP wrapper for ChartJS

## Installation

You can install the package via composer:

```bash
composer require imreallyunoriginal/laravel-chartjs
```

## Usage

```php
Chart::radar('Test Chart', [
    Chart::dataset('Test 1', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
    Chart::dataset('Test 2', [12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1]),
])->setLabels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])

Chart::line('Chart Title')
    ->addDataset('Dataset 1 Label', Employee::selectRaw('name AS x, age AS y'))
```

## Testing

```bash
composer test
```

## Contributing

Please see the [Contributing File](CONTRIBUTING.md) for more information.

## License

The MIT License (MIT). Please see the [License File](LICENSE.md) for more information.
