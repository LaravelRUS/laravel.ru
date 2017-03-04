<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\HeadersInjector;

use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Config\Repository;
use Service\HeadersInjector\HeaderProviders\AccessControlAllowOrigin;
use Service\HeadersInjector\HeaderProviders\AsIs;
use Service\HeadersInjector\HeaderProviders\HeaderProviderInterface;
use Service\HeadersInjector\HeaderProviders\OptionsSerializer;

/**
 * Class HeadersInjectorRepository
 * @package Service\HeadersInjector
 */
class HeadersInjectorRepository extends Repository
{
    use OptionsSerializer;

    /**
     * @var string
     */
    private $default;

    /**
     * @var array|HeaderProviderInterface[]
     */
    private $providers = [];

    /**
     * HeadersInjectorRepository constructor.
     * @param Container $container
     * @param array     $items
     */
    public function __construct(Container $container, array $items = [])
    {
        parent::__construct($items);

        $this->default = $this->get('default');

        $this->bootProviders($container, $this->get('providers', []));
    }

    /**
     * @param Container $app
     * @param array     $providers
     * @return HeadersInjectorRepository
     */
    private function bootProviders(Container $app, array $providers = []): HeadersInjectorRepository
    {
        foreach ($providers as $class) {
            $this->addHeaderProvider($app->make($class));
        }

        return $this;
    }

    /**
     * @param HeaderProviderInterface $provider
     * @return HeadersInjectorRepository
     */
    public function addHeaderProvider(HeaderProviderInterface $provider): HeadersInjectorRepository
    {
        $this->providers[] = $provider;

        return $this;
    }

    /**
     * @param string|null $configName
     * @return array
     */
    public function getHeaders(string $configName = null): array
    {
        return $this->get('rules.' . ($configName ?? $this->default), []);
    }

    /**
     * @param string $headerName
     * @return HeaderProviderInterface
     */
    public function getHeaderValueResolver(string $headerName): HeaderProviderInterface
    {
        return $this->match($headerName);
    }

    /**
     * @param string $headerName
     * @return HeaderProviderInterface
     */
    private function match(string $headerName): HeaderProviderInterface
    {
        foreach ($this->providers as $provider) {
            if ($provider->match($headerName)) {
                return $provider;
            }
        }

        return new AsIs();
    }
}