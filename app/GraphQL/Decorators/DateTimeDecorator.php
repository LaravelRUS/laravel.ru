<?php
/**
 * This file is part of Railt Laravel Adapter package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Decorators;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Railt\Adapters\InputInterface;
use Railt\Adapters\OutputInterface;

/**
 * Class DateTimeDecorator
 * @package App\GraphQL\Decorators
 */
class DateTimeDecorator
{
    /**
     * Input argument
     */
    private const INPUT_ARGUMENT_VALUE = 'format';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return string
     */
    public function parseFormatArgument(InputInterface $input, OutputInterface $output): string
    {
        $date = $this->toDateTime($output->getValue());

        return $date->format($this->format($input));
    }

    /**
     * @param InputInterface $input
     * @return string
     */
    private function format(InputInterface $input): string
    {
        if (! $input->has(self::INPUT_ARGUMENT_VALUE)) {
            return Carbon::RFC3339;
        }

        $value = $input->get(self::INPUT_ARGUMENT_VALUE);
        $constant = Carbon::class . '::' . $value;

        $isConstantExists = defined($constant);

        return $isConstantExists ? constant($constant) : $value;
    }

    /**
     * @param mixed $value
     * @return Carbon
     */
    private function toDateTime($value): Carbon
    {
        if ($value instanceof Carbon) {
            return $value;
        }

        if ($value instanceof \DateTime) {
            return Carbon::instance($value);
        }

        return Carbon::parse((string)$value);
    }
}
