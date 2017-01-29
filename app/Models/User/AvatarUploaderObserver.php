<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Models\User;

use App\Jobs\UploadAvatarProcess;
use App\Models\User;
use Illuminate\Contracts\Bus\Dispatcher;

/**
 * Class AvatarUploaderObserver
 * @package App\Models\User
 */
class AvatarUploaderObserver
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * AvatarUploaderObserver constructor.
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param User $user
     */
    public function created(User $user): void
    {
        // Avatar already defined for user
        if ($user->hasAvatar()) {
            return;
        }

        $this->dispatcher->dispatch(new UploadAvatarProcess($user));
    }
}