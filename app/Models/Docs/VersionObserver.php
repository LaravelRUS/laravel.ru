<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Models\Docs;

use App\Models\Docs;

/**
 * Class VersionObserver.
 */
class VersionObserver
{
    private const DEFAULT_LATEST_VERSION = '5.4';

    /**
     * @param Docs $docs
     */
    public function saving(Docs $docs): void
    {
        if (! $docs->version) {
            $docs->version = $this->getLatestAvailableVersion();
        }
    }

    /**
     * @return string
     */
    private function getLatestAvailableVersion(): string
    {
        return self::DEFAULT_LATEST_VERSION;
    }
}
