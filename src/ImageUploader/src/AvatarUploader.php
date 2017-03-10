<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ImageUploader;

use Intervention\Image\ImageManager;
use Service\ImageUploader\Resolvers\GravatarResolver;
use Service\ImageUploader\Resolvers\GravatarSupports;
use Service\ImageUploader\Resolvers\ImageResolverInterface;

/**
 * Class AvatarUploader.
 */
final class AvatarUploader extends ImageUploader
{
    /**
     * @var GravatarSupports
     */
    private $user;

    /**
     * AvatarUploader constructor.
     *
     * @param GravatarSupports $user
     * @param ImageManager     $manager
     */
    public function __construct(GravatarSupports $user, ImageManager $manager)
    {
        parent::__construct($manager);

        $this->user = $user;
    }

    /**
     * @param  array                                   $options
     * @return GravatarResolver|ImageResolverInterface
     * @throws \InvalidArgumentException
     */
    public function getDefaultResolver(...$options): ImageResolverInterface
    {
        if ($this->user instanceof GravatarSupports) {
            return GravatarResolver::fromUser($this->user);
        }

        $message = 'User instance of %s must implement %s interface';
        throw new \InvalidArgumentException(sprintf($message, static::class, GravatarSupports::class));
    }
}
