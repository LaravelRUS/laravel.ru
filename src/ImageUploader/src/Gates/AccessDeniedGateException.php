<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace Service\ImageUploader\Gates;

use Exception;

/**
 * Class GateException.
 */
class AccessDeniedGateException extends \LogicException
{
    /**
     * AccessDeniedGateException constructor.
     *
     * @param GateInterface  $gate
     * @param string         $imagePath
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct(GateInterface $gate, string $imagePath, $code = 0, Exception $previous = null)
    {
        $message = sprintf('Gate %s block access for "%s" image.', get_class($gate), $imagePath);

        parent::__construct($message, $code, $previous);
    }
}
