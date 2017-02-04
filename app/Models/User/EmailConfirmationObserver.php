<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Models\User;

use App\Models\User;
use App\Notifications\ConfirmEmailNotification;
use Tymon\JWTAuth\Providers\JWT\JWTInterface;

/**
 * Class EmailConfirmationObserver
 * @package App\Models\User
 */
class EmailConfirmationObserver
{
    /**
     * @var JWTInterface
     */
    private $jwt;

    /**
     * EmailConfirmationObserver constructor.
     * @param JWTInterface $jwt
     */
    public function __construct(JWTInterface $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @param User $user
     */
    public function created(User $user)
    {
        if (!$user->is_confirmed) {
            $confirmation = new ConfirmEmailNotification($user, $this->jwt);

            $user->notify($confirmation);
        }
    }
}