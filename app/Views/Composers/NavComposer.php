<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Views\Composers;

use Illuminate\View\View;
use App\Services\NavMatcher;

/**
 * Class NavComposer.
 */
class NavComposer
{
    /**
     * @var NavMatcher
     */
    private $matcher;

    /**
     * NavComposer constructor.
     * @param NavMatcher $matcher
     */
    public function __construct(NavMatcher $matcher)
    {
        $this->matcher = $matcher;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('nav', $this->matcher);
    }
}
