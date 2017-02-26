<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\GitHub;

use Illuminate\Config\Repository;

/**
 * Class GitHubConfigRepository.
 */
class GitHubConfigRepository extends Repository
{
    /**
     * GitHubConfigRepository constructor.
     * @param Repository $original
     */
    public function __construct(Repository $original)
    {
        $connection = $original->get('docs.default');
        $config = $original->get('docs.connections.' . $connection);

        parent::__construct(array_merge($config, [

        ]));
    }

    /**
     * @return array
     */
    public function values(): array
    {
        return [
            $this->getOrg(),
            $this->getRepo(),
            $this->getBranch()
        ];
    }

    /**
     * @return string
     */
    public function getOrg(): string
    {
        return $this->get('org', '');
    }

    /**
     * @return string
     */
    public function getRepo(): string
    {
        return $this->get('repo', '');
    }

    /**
     * @return string
     */
    public function getBranch(): string
    {
        return $this->get('branch', '');
    }
}