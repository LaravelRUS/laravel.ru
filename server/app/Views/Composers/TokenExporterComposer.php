<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Views\Composers;

use App\Services\TokenAuth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\View\View;

/**
 * Class TokenExporterComposer
 * @package App\Views\Composers
 */
class TokenExporterComposer
{
    /**
     * @var TokenAuth
     */
    private $auth;

    /**
     * @var Guard
     */
    private $guard;

    /**
     * TokenExporterComposer constructor.
     * @param TokenAuth $auth
     * @param Guard $guard
     */
    public function __construct(TokenAuth $auth, Guard $guard)
    {
        $this->auth = $auth;
        $this->guard = $guard;
    }

    /**
     * @param View $view
     */
    public function compose(View $view): void
    {
        $view->with('token', $this->auth->fromGuard($this->guard));
    }
}
