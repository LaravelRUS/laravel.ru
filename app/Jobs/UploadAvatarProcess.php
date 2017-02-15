<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
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
 * @package App\Jobs
 */
class UploadAvatarProcess implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    private const GRAVATAR_URL = 'https://www.gravatar.com/avatar/%s?default=404';

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $gravatarUrl;

    /**
     * Create a new job instance.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        $hash = md5(strtolower(trim($this->user->email)));

        $this->gravatarUrl = sprintf(self::GRAVATAR_URL, $hash);
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
