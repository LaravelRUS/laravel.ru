<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\DocsImporter;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Support\Jsonable;

/**
 * Class DocsConfig.
 */
abstract class DocsConfig implements DocsConnectionConfigInterface, Jsonable, \JsonSerializable
{
    /**
     * @var array
     */
    private $config = [];

    /**
     * GitHubConfig constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->config;
    }

    /**
     * @param  string      $key
     * @return string|null
     */
    public function get(string $key): ?string
    {
        return Arr::get($this->config, $key);
    }

    /**
     * @param  int    $options
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return $this->toJson();
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return $this->toArray();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
