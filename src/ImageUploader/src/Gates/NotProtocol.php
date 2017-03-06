<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\ImageUploader\Gates;

use Illuminate\Support\Str;

/**
 * Class NotProtocol.
 */
class NotProtocol implements GateInterface
{
    /**
     * @var array
     */
    private $disallowed = [];

    /**
     * ProtocolNotAvailable constructor.
     *
     * @param string[] ...$disallowedProtocols
     */
    public function __construct(string ...$disallowedProtocols)
    {
        $this->disallow(...$disallowedProtocols);
    }

    /**
     * @param  string[]    ...$protocols
     * @return NotProtocol
     */
    public function disallow(string ...$protocols): NotProtocol
    {
        foreach ($protocols as $protocol) {
            $this->disallowed[] = $protocol;
        }

        return $this;
    }

    /**
     * @param  string                    $imagePath
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function check(string $imagePath): bool
    {
        if (Str::startsWith($imagePath, $this->disallowed)) {
            throw new \InvalidArgumentException("Protocol for image ${imagePath} are not allowed");
        }

        return true;
    }
}
