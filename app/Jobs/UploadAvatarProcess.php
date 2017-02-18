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
use App\Services\StaticServer\AvatarUploader;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;

/**
 * Class UploadAvatarProcess
 *
 * @package App\Jobs
 */
class UploadAvatarProcess implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

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
     * @param ImageManager $manager
     * @param Client $client
     * @param Storage $fs
     */
    public function handle(ImageManager $manager, Client $client, Storage $fs): void
    {
        (new AvatarUploader($manager, $client))
            ->size(64, 64)
            ->upload($this->user, $fs->disk('avatars'));
    }
}
