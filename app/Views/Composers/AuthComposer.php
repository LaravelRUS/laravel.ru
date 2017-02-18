<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Views\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthComposer
{
    /** @var Authenticatable|null */
    private $auth;

    public function __construct(Authenticatable $auth = null)
    {
        $this->auth = $auth;
    }

    public function compose(View $view): void
    {
        $view->with('auth', $this->auth);
    }
}
