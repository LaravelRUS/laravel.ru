<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\GitHub;

use Illuminate\Support\Collection;
use GrahamCampbell\GitHub\GitHubManager;

/**
 * Class GitHubDocsManager.
 */
class GitHubDocsManager implements DocsManagerInterface
{
    /**
     * @var GitHubManager
     */
    private $manager;

    /**
     * GitHubDocsImport constructor.
     * @param GitHubManager $manager
     */
    public function __construct(GitHubManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param  string                                     $org
     * @param  string                                     $repo
     * @param  string                                     $branch
     * @return Collection|DocsCollection|DocsStatus[]
     * @throws \Github\Exception\ErrorException
     * @throws \Github\Exception\InvalidArgumentException
     * @throws \RuntimeException
     */
    public function findFiles(string $org, string $repo, string $branch): DocsCollection
    {
        $result = new DocsCollection();

        $info = $this->getRepoFilesInfo($org, $repo, $branch);

        foreach ($info as $page) {
            if (! isset($page['path'], $page['download_url'])) {
                throw new \RuntimeException('Import failed: "path" or "download_url" arguments required.');
            }

            $result[] = new DocsStatus($page['path'], $page['sha']);
        }

        return $result;
    }

    /**
     * @param  string                                     $org
     * @param  string                                     $repo
     * @param  string                                     $branch
     * @param  string                                     $file
     * @return string
     * @throws \Github\Exception\ErrorException
     * @throws \Github\Exception\InvalidArgumentException
     */
    private function getBody(string $org, string $repo, string $branch, string $file): string
    {
        return (string) $this->manager
            ->repo()
            ->contents()
            ->download($org, $repo, $file, $branch);
    }

    /**
     * @param  string $org
     * @param  string $repo
     * @param  string $branch
     * @return array
     */
    private function getRepoFilesInfo(string $org, string $repo, string $branch): array
    {
        return $this->manager
            ->repo()
            ->contents()
            ->show($org, $repo, null, $branch);
    }

    /**
     * @param  string                                     $org
     * @param  string                                     $repo
     * @param  string                                     $branch
     * @param  string                                     $file
     * @return ExternalDocsPage
     * @throws \Github\Exception\ErrorException
     * @throws \Github\Exception\InvalidArgumentException
     */
    public function import(string $org, string $repo, string $branch, string $file): ExternalDocsPage
    {
        $body = $this->getBody($org, $repo, $branch, $file);

        return new ExternalDocsPage(basename($file, '.md'), $body);
    }
}
