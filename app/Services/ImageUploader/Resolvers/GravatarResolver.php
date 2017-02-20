<?php
/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Services\ImageUploader\Resolvers;

use App\Models\User;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * Class GravatarResolver.
 */
class GravatarResolver implements ImageResolverInterface
{
    /**
     * Gravatar url.
     */
    protected const GRAVATAR_URL = 'https://www.gravatar.com/avatar/%s?default=404';

    /**
     * @var string
     */
    private $email;

    /**
     * @var ClientInterface
     */
    private $http;

    /**
     * GravatarResolver constructor.
     *
     * @param string          $email
     * @param ClientInterface $client
     */
    public function __construct(string $email, ClientInterface $client)
    {
        $this->http = $client;
        $this->email = strtolower(trim($email));
    }

    /**
     * @param User            $user
     * @param ClientInterface $client
     *
     * @return GravatarResolver
     */
    public static function fromUser(User $user, ClientInterface $client): GravatarResolver
    {
        return new static($user->email, $client);
    }

    /**
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function resolve(): string
    {
        $uri = $this->getGravatarUri($this->email);

        try {
            // Check avatar if exists
            $this->http->request('HEAD', $uri);

            return $uri;
        } catch (ClientException $exception) {
            return $this->getDefaultAvatar();
        }
    }

    /**
     * @param string $email
     *
     * @return string
     */
    private function getGravatarUri(string $email): string
    {
        return sprintf(static::GRAVATAR_URL, md5($email));
    }

    /**
     * @return string
     */
    protected function getDefaultAvatar(): string
    {
        $path = sprintf('images/avatars/%s.png', random_int(1, 4));

        return resource_path($path);
    }
}
