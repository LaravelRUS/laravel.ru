<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\DocsImporter;

/**
 * Interface DocsFileInterface.
 */
interface DocsFileInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return string
     */
    public function getRoute(): string;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @return string
     */
    public function getHash(): string;
}
