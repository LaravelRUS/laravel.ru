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

/**
 * Class EmailConfirmationObserver
 * @package App\Models\User
 */
class EmailConfirmationObserver
{
    /**
     * @param User $user
     */
    public function created(User $user)
    {
        $confirmation = (new ConfirmEmailNotification());

        $user->notify($confirmation);
    }
}