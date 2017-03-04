<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\HeadersInjector\HeaderProviders;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class OptionsSerializer.
 */
trait OptionsSerializer
{
    /**
     * @param mixed $options
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function serialize($options): string
    {
        switch (true) {
            case is_array($options):
                return $this->serializeArray($options);

            case is_string($options):
                return $options;

            case is_bool($options):
                return $options ? 'true' : 'false';

            case is_int($options):
                return (string)$options;

            case is_object($options) && $options instanceof Arrayable:
                return $this->serializeArray($options->toArray());

            case is_object($options) && $options instanceof \Traversable:
                return $this->serializeArray(iterator_to_array($options));

            case is_object($options) && method_exists($options, '__toString'):
                return (string)$options;
        }

        $message = sprintf('Options type %s are not supported', gettype($options));
        throw new \InvalidArgumentException($message);
    }

    /**
     * @param array  $options
     * @param string $glue
     * @return string
     */
    private function serializeArray(array $options, string $glue = ','): string
    {
        return implode($glue, $options);
    }
}