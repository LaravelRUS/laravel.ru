<?php namespace LaravelRU\Parser;

use Parsedown;

class Parse {

    private $markdownParser;

    public function __construct()
    {
        $this->markdownParser = new Parsedown();
    }

    public function urlToAhref($text)
    {
        $html = preg_replace("#(http://.*?)(\s|,|;|\:|\)|\]|\>|\}|$)#", "<a href=\"\\1\" target=\"_blank\">\\1</a>\\2", $text);
        return $html;
    }


    public function markdown($text)
    {
        $html = $this->markdownParser->text($text);
        $html = strip_tags($html);
        $html = $this->urlToAhref($html);
        return $html;
    }


} 