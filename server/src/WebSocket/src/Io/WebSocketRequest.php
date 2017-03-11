<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\WebSocket\Io;

use Illuminate\Http\Request;
use Service\WebSocket\Support\Json;

/**
 * Class WebSocketRequest.
 */
class WebSocketRequest extends Request
{
    public const METHOD_WS = 'WS';

    /**
     * @param string       $uri
     * @param string|array $params
     * @return Request|WebSocketRequest
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public static function make(string $uri, $params = []): Request
    {
        $data = is_string($params) ? Json::decodeArray($params) : (array) $params;

        return parent::create($uri, self::METHOD_WS, $data);
    }

    /**
     * @return string
     */
    public function fingerprint(): string
    {
        return sha1($this->ip());
    }

    /**
     * @return int
     */
    public function getRequestId(): int
    {
        return (int) $this->get('id', 0);
    }
}
