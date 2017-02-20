<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Unit;

use App\Services\ImageUploader\AvatarUploader;
use Tests\TestCase;

/**
 * Class AvatarUploaderTest
 *
 * TODO Implement tests for avatar uploader
 */
class AvatarUploaderTest extends TestCase
{
    private function getUploader(): AvatarUploader
    {
        return $this->app->make(AvatarUploader::class);
    }
}
