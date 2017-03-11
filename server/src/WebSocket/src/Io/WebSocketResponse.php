<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Service\WebSocket\Io;

use Illuminate\Http\JsonResponse;

/**
 * Class WebSocketResponse.
 */
class WebSocketResponse extends JsonResponse
{
    /**
     * @param WebSocketRequest $request
     * @param array            $data
     * @return static
     */
    public static function fromArrayResponse(WebSocketRequest $request, array $data = [])
    {
        $data['id'] = $request->getRequestId();

        return new static($data, 200);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getContent();
    }
}
