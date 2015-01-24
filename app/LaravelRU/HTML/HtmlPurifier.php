<?php namespace LaravelRU\HTML;

interface HtmlPurifier
{
    /**
     * @param string $text
     * @return string
     */
    public function parse($text);
}
