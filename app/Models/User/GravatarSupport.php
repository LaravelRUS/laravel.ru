<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace App\Models\User;

use App\Models\User;
use Service\ImageUploader\Resolvers\GravatarSupports;

/**
 * Class GravatarSupport
 * @mixin User
 * @mixin GravatarSupports
 */
trait GravatarSupport
{
    /**
     * @return string
     */
    public function getEmailForGravatar(): string
    {
        return $this->email;
    }
}
