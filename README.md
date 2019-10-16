# Handle Appstore server-to-server notifications for auto-renewable subscriptions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/app-vise/laravel-appstore-notifications.svg?style=flat-square)](https://packagist.org/packages/app-vise/laravel-appstore-notifications)
[![Build Status](https://img.shields.io/travis/app-vise/laravel-appstore-notifications/master.svg?style=flat-square)](https://travis-ci.org/app-vise/laravel-appstore-notifications)
[![StyleCI](https://styleci.io/repos/105920179/shield?branch=master)](https://styleci.io/repos/105920179)
[![Quality Score](https://img.shields.io/scrutinizer/g/app-vise/laravel-appstore-notifications.svg?style=flat-square)](https://scrutinizer-ci.com/g/app-vise/laravel-appstore-notifications)
[![Total Downloads](https://img.shields.io/packagist/dt/app-vise/laravel-appstore-notifications.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-appstore-notifications)

## Installation
You can install this package via composer

```bash
composer require app-vise/laravel-appstore-server-notifications 
 ```

The service provider will register itself.
You have to publish the config file with:

```bash
php artisan vendor:publish --provider="Appvise\AppStoreNotifications\NotificationsServiceProvider" --tag="config" 
 ```

## Usage

## Changelog

Please see CHANGELOG for more information about what has changed recently.

## Testing

```bash
composer test
```

## Security

If you discover any security related issues, please email daan@app-vise.nl instead of using the issue tracker.

## Credits

- [Daan Geurts](https://github.com/DaanGeurts)
- [All Contributors](../../contributors)

A big thanks to [Spatie's](https://spatie.be) laravel-stripe-webhooks which was a huge inspiration and starting point for this package
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.