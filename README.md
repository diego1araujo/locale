[![Build Status](https://travis-ci.org/diego1araujo/locale.png?branch=master)](https://travis-ci.org/diego1araujo/locale)

## Locale - A better way to handle multilanguage.

The goal of this package is offer a simple way to make a multilanguage for Laravel 4/5.

## Installation

Edit `composer.json` file to require this package.

    "require": {
		...
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

> NOTE: The main language isn't appended in url, only others (from `available` item).

## Data

Go to `app/lang/[language]` and create a new file(s) for each language (Files must have the same name for all languages)

Like this:

English `app/lang/en/message.php`

```php
return array(

	'welcome' => 'Welcome to my page',

);
```

Portuguese `app/lang/pt/message.php`

```php
return array(

	'welcome' => 'Bem-vindo à minha página',

);
```

## Usage

Define the set method as a prefix value in route group
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

Printing a message
```php
Lang::get('message.welcome')
```

Retrieving the current language
```php
Locale::get();
```

Building url's with the current language
```php
Locale::url('about'); // [site-domain]/[current-language]/about
```

### One route for many languages

You can use a single route for a multiple language page. I suggest you to place all pages in your file translation.

English `app/lang/en/message.php`

```php
return array(

	'menu-page' => 'Page',
	'slug-page' => 'page',

);
```

Portuguese `app/lang/pt/message.php`

```php
return array(

	'menu-page' => 'Página',
	'slug-page' => 'pagina',

);
```

```php
Route::group(array('prefix' => Locale::set()), function()
{
	Route::get(Lang::get('message.slug-page'), ['as' => 'page', 'uses' => 'HomeController@page']);
}
```
