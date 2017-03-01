<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\DocsImporter\GitHub;

use Illuminate\Support\Arr;
use Service\DocsImporter\DocsFileInterface;
use Service\DocsImporter\DocsImporterInterface;
use GrahamCampbell\GitHub\GitHubManager;
use Service\DocsImporter\DocsConnectionConfigInterface;

/**
 * Class GitHubProvider.
 */
class GitHubProvider implements DocsImporterInterface
{
    /**
     * @var GitHubManager
     */
    private $manager;

    /**
     * GitHubProvider constructor.
     * @param GitHubManager $manager
     */
    public function __construct(GitHubManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param DocsConnectionConfigInterface|GitHubConfig $config
     * @param string                                     $path
     * @return DocsFileInterface[]|\Traversable
     */
    public function files(DocsConnectionConfigInterface $config, string $path = null): \Traversable
    {
        foreach ($this->getFilesArray($config, $path) as $fileInfo) {
            $path = Arr::get($fileInfo, 'path');
            $hash = Arr::get($fileInfo, 'sha');

            yield new GitHubFile($this->manager, $config, $path, $hash);
        }
    }

    /**
     * @param array $config
     * @return DocsConnectionConfigInterface
     */
    public function config(array $config): DocsConnectionConfigInterface
    {
        return new GitHubConfig($config);
    }

    /**
     * @param GitHubConfig $config
     * @param string       $path
     * @return array
     */
    private function getFilesArray(GitHubConfig $config, string $path = null): array
    {
        return $this->manager
            ->repo()
            ->contents()
            ->show(...$config->toArrayWithPath($path));
    }
}