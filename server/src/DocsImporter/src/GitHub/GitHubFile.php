<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\DocsImporter\GitHub;

use Illuminate\Support\Str;
use GrahamCampbell\GitHub\GitHubManager;
use Service\DocsImporter\DocsFileInterface;

/**
 * Class GitHubFile.
 */
class GitHubFile implements DocsFileInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var GitHubManager
     */
    private $manager;

    /**
     * @var GitHubConfig
     */
    private $config;

    /**
     * @var string
     */
    private $pathName;

    /**
     * @var string
     */
    private $sha;

    /**
     * @var string|null
     */
    private $content;

    /**
     * GitHubFile constructor.
     * @param GitHubManager $manager
     * @param GitHubConfig  $config
     * @param string        $pathName
     * @param string        $sha
     */
    public function __construct(GitHubManager $manager, GitHubConfig $config, string $pathName, string $sha)
    {
        $this->sha = $sha;
        $this->config = $config;
        $this->manager = $manager;
        $this->pathName = $pathName;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->pathName;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->sha;
    }

    /**
     * @return string
     * @throws \Github\Exception\ErrorException
     * @throws \Github\Exception\InvalidArgumentException
     */
    public function getTitle(): string
    {
        if ($this->title === null) {
            $defaultTitle = explode('.', basename($this->pathName));
            $defaultTitle = str_replace(['-', '_', '+'], ' ', $defaultTitle);

            $this->title = $this->getTopLevelHeader($this->getContent(), reset($defaultTitle));
        }

        return $this->title;
    }

    /**
     * @param  string $markdown
     * @param  string $default
     * @return string
     */
    private function getTopLevelHeader(string $markdown, string $default)
    {
        preg_match_all('/^\s*#\s+(.*?)$/musi', $markdown, $matches);

        if (count($matches[1])) {
            $default = $matches[1][0];
        }

        return Str::ucfirst($default);
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return Str::replaceLast('.md', '', $this->pathName);
    }

    /**
     * @return string
     * @throws \Github\Exception\ErrorException
     * @throws \Github\Exception\InvalidArgumentException
     */
    public function getContent(): string
    {
        if ($this->content === null) {
            $this->content = $this->readBody();
        }

        return $this->content;
    }

    /**
     * @return string
     * @throws \Github\Exception\ErrorException
     * @throws \Github\Exception\InvalidArgumentException
     */
    private function readBody(): string
    {
        return (string) $this->manager
            ->repo()
            ->contents()
            ->download(...$this->config->toArrayWithPath($this->pathName));
    }
}
