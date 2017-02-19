<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\User;

use App\Models\User;
use App\Jobs\UploadAvatarProcess;
use Illuminate\Contracts\Bus\Dispatcher;

/**
 * Class AvatarUploaderObserver.
 */
class AvatarUploaderObserver
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * AvatarUploaderObserver constructor.
     *
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
