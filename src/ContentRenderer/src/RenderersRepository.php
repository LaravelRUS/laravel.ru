<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ContentRenderer;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Container\Container;

/**
 * Class RenderersRepository.
 */
class RenderersRepository extends Repository
{
    /**
     * @var string
     */
    private $default;

    /**
     * @var Container
     */
    private $container;

    /**
     * RenderersRepository constructor.
     * @param  Container                 $container
     * @param  array                     $items
     * @throws \InvalidArgumentException
     */
    public function __construct(Container $container, array $items = [])
    {
        parent::__construct($items);

        $this->default = $this->getRendererClass($this->get('default'));
        $this->container = $container;
    }

    /**
     * @param  string                    $name
     * @return string
     * @throws \InvalidArgumentException
     */
    private function getRendererClass(string $name): string
    {
        $class = $this->get(sprintf('renderers.%s', $name));

        if ($class === null) {
            throw new \InvalidArgumentException("Renderer ${name} not found");
        }

        return $class;
    }

    /**
     * @param  string|null               $name
     * @return ContentRendererInterface
     * @throws \InvalidArgumentException
     */
    public function getRenderer(string $name = null): ContentRendererInterface
    {
        $class = $name === null ? $this->default : $this->getRendererClass($name);

        return $this->container->make($class);
    }

    /**
     * @return ContentRendererInterface
     */
    public function getDefaultRenderer(): ContentRendererInterface
    {
        return $this->container->make($this->default);
    }
}
