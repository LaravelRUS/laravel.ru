<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\DocsImporter;

/**
 * Interface DocsImporterInterface.
 */
interface DocsImporterInterface
{
    /**
     * @param DocsConnectionConfigInterface $config
     * @param string                        $path
     * @return DocsFileInterface[]|\Traversable
     */
    public function files(DocsConnectionConfigInterface $config, string $path = null): \Traversable;

    /**
     * @param array $config
     * @return DocsConnectionConfigInterface
     */
    public function config(array $config): DocsConnectionConfigInterface;
}