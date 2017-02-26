<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\GitHub;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class DocsStatus.
 */
class DocsStatus implements Arrayable
{
    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $path;

    /**
     * DocsStatus constructor.
     * @param string $path
     * @param string $hash
     */
    public function __construct(string $path, string $hash)
    {
        $this->hash = $hash;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'path' => $this->path,
            'hash' => $this->hash,
        ];
    }
}