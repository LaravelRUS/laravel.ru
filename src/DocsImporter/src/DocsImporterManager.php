<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\DocsImporter;

use Service\DocsImporter\GitHub\GitHubProvider;
use Illuminate\Contracts\Container\Container;

/**
 * Class DocsImporterManager.
 */
class DocsImporterManager
{
    /**
     * @var array
     */
    private static $defaults = [
        'github' => GitHubProvider::class,
    ];

    /**
     * @var array
     */
    private $importers = [];

    /**
     * @var Container
     */
    private $container;

    /**
     * DocsImporterManager constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;

        $this->initDefaults();
    }

    /**
     * @return $this|DocsImporterManager
     */
    private function initDefaults(): DocsImporterManager
    {
        foreach (self::$defaults as $alias => $class) {
            $this->add($alias, $this->container->make($class));
        }

        return $this;
    }

    /**
     * @param string                $alias
     * @param DocsImporterInterface $importer
     * @return $this|DocsImporterManager
     */
    public function add(string $alias, DocsImporterInterface $importer): DocsImporterManager
    {
        $this->importers[$alias] = $importer;

        return $this;
    }

    /**
     * @param string $alias
     * @return DocsImporterInterface|null
     */
    public function get(string $alias): ?DocsImporterInterface
    {
        return $this->importers[$alias] ?? null;
    }
}