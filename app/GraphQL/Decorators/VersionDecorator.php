<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Decorators;

use Railt\Adapters\InputInterface;
use Railt\Adapters\OutputInterface;

/**
 * Class VersionDecorator
 * @package App\GraphQL\Decorators
 */
class VersionDecorator
{
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return string
     */
    public function formatVersion(InputInterface $input, OutputInterface $output): string
    {
        if ($input->has('format')) {
            $versionParts = explode('.', (string)$output->getValue());

            switch ($input->get('format')) {
                case 'MAJOR':
                    return $versionParts[0] ?? '0';
                case 'MINOR':
                    return $versionParts[1] ?? '0';
                case 'PATCH':
                    return $versionParts[2] ?? '0';
            }
        }

        return $output->getValue();
    }
}
