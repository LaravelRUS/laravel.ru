<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Routing\Route;

/**
 * Class NavMatcher.
 */
class NavMatcher
{
    /**
     * @var string
     */
    private $active;

    /**
     * @var Route
     */
    private $route;

    /**
     * NavMatcher constructor.
     * @param Route  $route
     * @param string $active
     */
    public function __construct(Route $route, string $active = 'active')
    {
        $this->active = $active;
        $this->route = $route;
    }

    /**
     * @param  string $route
     * @return string
     */
    public function match(string $route): string
    {
        return $this->isCurrent($route) || $this->isMatched($route)
            ? $this->active
            : '';
    }

    /**
     * @param  string $needle
     * @return bool
     */
    private function isCurrent(string $needle): bool
    {
        return $this->route->getName() === $needle;
    }

    /**
     * @param  string $needle
     * @return bool
     */
    private function isMatched(string $needle): bool
    {
        return Str::startsWith($this->route->getName(), $needle . '.');
    }
}
