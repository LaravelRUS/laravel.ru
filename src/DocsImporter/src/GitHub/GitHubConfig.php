<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\DocsImporter\GitHub;

use Illuminate\Support\Arr;
use Service\DocsImporter\DocsConnectionConfigInterface;

/**
 * Class GitHubConfig.
 */
class GitHubConfig implements DocsConnectionConfigInterface
{
    public const CONFIG_BRANCH = 'branch';
    public const CONFIG_REPOSITORY = 'repository';
    public const CONFIG_ORGANISATION = 'organisation';

    /**
     * @var array
     */
    private $config = [];

    /**
     * GitHubConfig constructor.
     * @param string $organisation
     * @param string $repository
     * @param string $branch
     */
    public function __construct(string $organisation, string $repository, string $branch)
    {
        $this->config = [
            static::CONFIG_ORGANISATION => $organisation,
            static::CONFIG_REPOSITORY   => $repository,
            static::CONFIG_BRANCH       => $branch,
        ];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->config;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function get(string $key): ?string
    {
        return Arr::get($this->config, $key);
    }

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