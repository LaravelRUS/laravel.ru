<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace Service\ImageUploader\Gates;

/**
 * Class NotHttpResource.
 */
final class NotHttpResource extends NotProtocol
{
    /**
     * NotHttpResource constructor.
     */
    public function __construct()
    {
        parent::__construct('http', 'https');
    }
}
