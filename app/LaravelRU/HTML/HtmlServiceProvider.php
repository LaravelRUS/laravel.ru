<?php namespace LaravelRU\HTML;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class HtmlServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind('bootstrap3', 'LaravelRU\HTML\Bootstrap3');

		$this->app->booting(function ()
		{
			AliasLoader::getInstance()->alias('Bootstrap3', 'LaravelRU\HTML\Facades\Bootstrap3');
		});

		$this->bindHtmlPurifier();
	}

	private function bindHtmlPurifier()
	{
		$this->app->bindShared('purifier', function () {
			$jevix = new Jevix;
			$jevix->cfgAllowTags([
				'a', 'b', 'strong', 'em', 'br', 'u', 's', 'ul', 'ol', 'li', 'pre', 'code',
				'h2', 'h3', 'h4', 'h5', 'h6', 'p'
			]);
			$jevix->cfgSetAutoBrMode(false);
			$jevix->cfgAllowTagParams('a', ['title', 'href']);
			$jevix->cfgAllowTagParams('code', ['class']);
			$jevix->cfgSetTagChilds('ul', 'li', true, true);
			$jevix->cfgSetTagChilds('ol', 'li', true, true);
			$jevix->cfgSetTagChilds('p', 'code');
			$jevix->cfgSetTagNoTypography(['pre','code']);
			$jevix->cfgSetTagParamDefault('a', 'href', '/');
			$jevix->cfgSetTagParamDefault('a', 'rel', 'nofollow');
			$jevix->cfgSetTagPreformatted(['code']);
			$jevix->cfgSetTagCutWithContent(['script', 'iframe', 'object', 'style']);

			return $jevix;
		});

		$this->app->bind('LaravelRU\HTML\HtmlPurifier', 'purifier');

		$this->app->booting(function ()
		{
			AliasLoader::getInstance()->alias('Purifier', 'LaravelRU\HTML\Facades\Purifier');
		});
	}

}
