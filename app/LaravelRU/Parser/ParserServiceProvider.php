<?php namespace LaravelRU\Parser;

use App;
use Indatus\Dispatcher\ServiceProvider;

class ParserServiceProvider extends ServiceProvider{

    public function register()
    {
        App::bindShared('LaravelRU\Parser\Parse', function(){
            return new Parse();
        });
    }

    public function boot()
    {

    }

}