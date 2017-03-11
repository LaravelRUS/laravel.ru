<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\WebSocket\Support;

/**
 * Class Json.
 */
class Json
{
    /**
     * @param     $value
     * @param int $options
     * @param int $depth
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function encode($value, int $options = 0, int $depth = 512): string
    {
        $result = json_encode($value, $options, $depth);

        self::checkJsonErrors();

        return $result;
    }

    /**
     * @param string $json
     * @param int    $options
     * @param int    $depth
     * @return array
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public static function decodeArray(string $json, int $options = 0, int $depth = 512): array
    {
        $result = json_decode($json, true, $depth, $options);

        self::checkJsonErrors();

        if (! is_array($result)) {
            throw new \RuntimeException('Undefined json parsing error.');
        }

        return $result;
    }

    /**
     * @param string $json
     * @param int    $options
     * @param int    $depth
     * @return array
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public static function decodeObject(string $json, int $options = 0, int $depth = 512): array
    {
        $result = json_decode($json, false, $depth, $options);

        self::checkJsonErrors();

        if (! is_object($result)) {
            throw new \RuntimeException('Undefined json parsing error.');
        }

        return $result;
    }

    /**
     * @return bool
     * @throws \InvalidArgumentException
     */
    private static function checkJsonErrors(): bool
    {
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Json error: ' . json_last_error_msg());
        }

        return true;
    }
}
