<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\ImageUploader;

use App\Models\User;
use Http\Promise\Promise;
use GuzzleHttp\ClientInterface;
use Intervention\Image\ImageManager;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Services\ImageUploader\Resolvers\GravatarResolver;
use App\Services\ImageUploader\Resolvers\ImageResolverInterface;

/**
 * Class AvatarUploader.
 */
final class AvatarUploader extends ImageUploader
{
    /**
     * @var User
     */
    private $user;

    /**
     * AvatarUploader constructor.
     *
     * @param User         $user
     * @param ImageManager $manager
     */
    public function __construct(User $user, ImageManager $manager)
    {
        parent::__construct($manager);

        $this->user = $user;
    }

    /**
     * @param ClientInterface $client
     *
     * @return GravatarResolver
     */
    public function getGravatarResolver(ClientInterface $client): GravatarResolver
    {
        return GravatarResolver::fromUser($this->user, $client);
    }

    /**
     * @param ImageResolverInterface $resolver
     * @param Filesystem             $fs
     * @param bool                   $removeTempFile
     *
     * @return Promise
     *
     * @throws \RuntimeException
     */
    public function upload(ImageResolverInterface $resolver, Filesystem $fs, bool $removeTempFile = true): Promise
    {
        return parent::upload($resolver, $fs, $removeTempFile)
            ->then(function (string $path) {
                $this->user->avatar = $path;
                $this->user->save();

                return $this->user;
            });
    }
}
