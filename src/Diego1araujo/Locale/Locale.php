<?php namespace Diego1araujo\Locale;
/**
 * Locale
 *
 * A better way to handle multilanguage.
 *
 * Package by Diego Araujo <diego77araujo@gmail.com>
 */

use App, Config, Session, Request, URL;

class Locale {

    /**
    * Generate a locale from the page
    *
	* @return string
    */
	public function set()
	{
		$languages = Config::get('locale::available');
		$locale    = Request::segment(1);

		if( ! in_array($locale, $languages))
		{
			$locale = null;
			App::setLocale(Config::get('locale::default'));
		}
		else
		{
			App::setLocale($locale);
		}

		Session::put('locale', $locale);

		return $locale;
	}

	/**
    * Retrieve the current language
    *
	* @return string
    */
	public function get()
	{
		return Config::get('app.locale');
	}

	/**
    * Retrieve the url from the current language
    *
    * @param string $uri
	* @return string
    */
	public function url($uri = null)
	{
		return URL::to(Session::get('locale')) . '/' . $uri;
	}

}