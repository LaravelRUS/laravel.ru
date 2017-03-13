<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\SearchService;

/**
 * Class SearchResult
 * @package Service\SearchService
 */
final class SearchResult
{
    /**
     * @var string
     */
    public $url = '';

    /**
     * @var string
     */
    public $slug = '';

    /**
     * @var string
     */
    public $body = '';

    /**
     * @var null|string
     */
    public $type = null;

    /**
     * @var null|String
     */
    public $title = null;
}