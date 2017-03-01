<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\DocsImporter;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface DocsConnectionConfigInterface.
 */
interface DocsConnectionConfigInterface extends Arrayable
{
    /**
     * DocsConnectionConfigInterface constructor.
     * @param array $config
     */
    public function __construct(array $config);

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key);
}