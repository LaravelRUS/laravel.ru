<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\DataProviders;

use Illuminate\Contracts\Container\Container;

/**
 * Class Manager
 * @package App\Services\DataProviders
 */
class Manager implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $providers;

    /**
     * @var Container
     */
    private $container;

    /**
     * Manager constructor.
     * @param array     $providers
     * @param Container $container
     */
    public function __construct(array $providers, Container $container)
    {
        $this->container = $container;

        foreach ($providers as $alias => $class) {
            $this->register($alias, $class);
        }
    }

    /**
     * @param string                       $alias
     * @param string|DataProviderInterface $provider
     * @return $this|Manager
     */
    public function register(string $alias, string $provider): Manager
    {
        $this->providers[$alias] = $this->container->make($provider);

        return $this;
    }

    /**
     * @param string $alias
     * @return DataProviderInterface
     * @throws \InvalidArgumentException
     */
    public function get(string $alias): DataProviderInterface
    {
        if (! array_key_exists($alias, $this->providers)) {
            throw new \InvalidArgumentException($alias . ' data provider does not exists.');
        }

        return $this->providers[$alias];
    }

    /**
     * @return \Generator|DataProviderInterface[]
     */
    public function getIterator(): \Generator
    {
        foreach ($this->providers as $alias => $instance) {
            yield $alias => $instance;
        }
    }
}