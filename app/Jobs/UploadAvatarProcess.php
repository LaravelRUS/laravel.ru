<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Jobs;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;

/**
 * Class UploadAvatarProcess
 * @package App\Jobs
 */
class UploadAvatarProcess implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

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
     */
    public function handle(ImageManager $manager, Client $client): void
    {
        try {
            $client->head($this->gravatarUrl);
            $gravatar = $this->gravatarUrl;

        } catch (\Throwable $error) {
            $gravatar = $this->getDefaultAvatar();
        }

        $avatarName = md5(random_int(0, 9999) . $this->user->email) . '.png';


        $manager->make($gravatar)
            ->resize(64, null, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->crop(64, 64)
            ->save(public_path(User::DEFAULT_AVATAR_PATH . $avatarName));


        $this->user->avatar = $avatarName;
        $this->user->save();
    }

    /**
     * @return string
     */
    private function getDefaultAvatar(): string
    {
        return public_path(User::getDefaultAvatar());
    }
}
