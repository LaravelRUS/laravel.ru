<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\DocsImporter\GitHub;

use Illuminate\Support\Arr;
use Service\DocsImporter\DocsConfig;
use Service\DocsImporter\DocsConnectionConfigInterface;

/**
 * Class GitHubConfig.
 */
class GitHubConfig extends DocsConfig
{
    public const CONFIG_BRANCH = 'branch';
    public const CONFIG_REPOSITORY = 'repository';
    public const CONFIG_ORGANISATION = 'organisation';

    /**
     * @param string|null  $path
     * @return array
     */
    public function toArrayWithPath(string $path = null): array
    {
        return [
            $this->get(static::CONFIG_ORGANISATION),
            $this->get(static::CONFIG_REPOSITORY),
            $path,
            $this->get(static::CONFIG_BRANCH)
        ];
    }
}