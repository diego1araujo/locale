## Locale - A better way to handle multilanguage.

The goal of this package is offer a simple way to make a multilanguage for Laravel 4.

## Installation

Edit your project's `composer.json` file to require the package.

    "require": {
		"laravel/framework": "4.0.*",
		"diego1araujo/locale": "dev-master"
	}

Next, run the composer update command:

    composer update

Open up `app/config/app.php`

Find the `providers` key and add a new item to the array

	'Diego1araujo\Locale\ServiceProvider',

Find the `aliases` key and add a new item to the array

	'Locale' => 'Diego1araujo\Locale\Facade',

Finally, publish the config file

	php artisan config:publish diego1araujo/locale

## Config

To see which languages are available, open up `app/config/packages/diego1araujo/locale/config.php`

By default, the main language is `en` (english) and the `available` item contains the list of languages.

Of course, feel free to change both of them.

## Usage

Define the set method as prefix in route group
```php
Route::group(array('prefix' => Locale::set()), function()
{
	Route::get('/', function()
	{
		return View::make('home');
	});

	Route::get('example', function()
	{
		return View::make('example');
	});
});
```

Retrieving the current language
```php
Locale::get();
```

Building url's with the current language
```php
Locale::url('about');
```