<?php
/**
 * This file is part of Railt Laravel Adapter package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Decorators;

use Illuminate\Support\Str;
use Railt\Adapters\InputInterface;

/**
 * Class UpperCaseDecorator
 * @package App\GraphQL\Decorators
 */
class UpperCaseDecorator
{
    /**
     * @param InputInterface $input
     * @param string $value
     * @return string
     */
    public function upper(InputInterface $input, $value): string
    {
        if ($input->get('upper', false)) {
            return Str::upper((string)$value);
        }

        return (string)$value;
    }
}
