<?php declare(strict_types=1);
/**
 * This file is part of laravel.ru package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Services\ImageUploader;

use App\Models\User;
use GuzzleHttp\Client;
use Intervention\Image\Constraint;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use GuzzleHttp\Exception\ClientException;

/**
 * Class AvatarUploader
 * @package App\Services\ImageUploader
 */
class AvatarUploader
{
    /**
     * @const string
     */
    private const GRAVATAR_URL = 'https://www.gravatar.com/avatar/%s?default=404';

    /**
     * @var ImageManager
     */
    private $image;

    /**
     * @var Client
     */
    private $http;

    /**
     * @var int
     */
    private $width = 128;

    /**
     * @var int
     */
    private $height = 128;

    /**
     * AvatarUploader constructor.
     * @param ImageManager $manager
     * @param Client $client
     */
    public function __construct(ImageManager $manager, Client $client)
    {
        $this->image = $manager;
        $this->http = $client;
    }

    /**
     * @param int $width
     * @param int $height
     * @return AvatarUploader
     */
    public function size(int $width, int $height): AvatarUploader
    {
        [$this->width, $this->height] = [$width, $height];

        return $this;
    }

    /**
     * @param User $user
     * @return User
     */
    public function upload(User $user): User
    {
        try {
            $gravatarUrl = $this->getGravatarUrl($user);
            $avatarName  = $this->createImageName($user);

            // Check avatar if exists
            $this->http->head($gravatarUrl);

            // Resize and upload
            $this->process($gravatarUrl)
                ->save(public_path(User::DEFAULT_AVATAR_PATH . $avatarName));

        } catch (ClientException $exception) {
            $avatarName = User::DEFAULT_AVATAR_NAME;
        }

        $user->avatar = $avatarName;
        $user->save();

        return $user;
    }

    /**
     * @param string $gravatarUrl
     * @return Image
     */
    private function process(string $gravatarUrl): Image
    {
        return $this->image->make($gravatarUrl)
            ->resize($this->width, null, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->crop($this->width, $this->height);
    }

    /**
     * @param User $user
     * @return string
     */
    private function createImageName(User $user): string
    {
        return md5(random_int(0, 9999) . $user->email) . '.png';
    }

    /**
     * @param User $user
     * @return string
     */
    private function getGravatarUrl(User $user): string
    {
        $hash = md5(strtolower(trim($user->email)));

        return sprintf(self::GRAVATAR_URL, $hash);
    }
}