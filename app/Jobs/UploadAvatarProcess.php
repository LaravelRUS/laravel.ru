<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Intervention\Image\ImageManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Psr\Log\LoggerInterface;
use Service\ImageUploader\AvatarUploader;
use Service\ImageUploader\Gates\FileSize;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Filesystem\Factory as Storage;

/**
 * Class UploadAvatarProcess.
 */
class UploadAvatarProcess implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    private const MAX_AVATAR_FILE_SIZE = 1000 * 1000 * 20;

    /**
     * @var User
     */
    private $user;

    /**
     * UploadAvatarProcess constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param ImageManager    $manager
     * @param Storage         $fs
     * @param LoggerInterface $logger
     */
    public function handle(ImageManager $manager, Storage $fs, LoggerInterface $logger): void
    {
        $fulfilled = function (User $user) use ($logger) {
            $logger->info('Queue: Update avatar for user ' . $user->name);
        };

        $rejected = function (\Throwable $error) use ($logger) {
            $logger->error($error);
        };

        (new AvatarUploader($this->user, $manager))
            ->satisfy(new FileSize(self::MAX_AVATAR_FILE_SIZE))
            ->withSize(64, 64)
            ->upload($fs->disk('avatars'))
            ->then($fulfilled, $rejected);
    }

    /**
     * @return string
     */
    public static function avatarPathname(): string
    {
        return resource_path('images/avatars/' . random_int(1, 4));
    }
}
