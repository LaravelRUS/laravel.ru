<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);

namespace Service\ImageUploader\Resolvers;

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
     * GravatarResolver constructor.
     *
     * @param string          $email
     */
    public function __construct(string $email)
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @param  GravatarSupports $user
     * @return GravatarResolver
     */
    public static function fromUser(GravatarSupports $user): GravatarResolver
    {
        return new static($user->getEmailForGravatar());
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function resolve(): string
    {
        $uri = $this->getGravatarUri($this->email);

        try {
            // Check avatar if exists
            $this->isAvailable($uri);

            return $uri;
        } catch (\Throwable $exception) {
            return $this->getDefaultAvatar();
        }
    }

    /**
     * @param  string $email
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

    /**
     * @param string $uri
     * @return bool
     */
    private function isAvailable(string $uri): bool
    {
        $context = $this->createHttpContext(['method' => 'HEAD']);

        $descriptor = fopen($uri, 'rb', false, $context);

        try {
            $meta = stream_get_meta_data($descriptor);

            dd($meta);
        } catch (\Throwable $e) {
            return false;
        } finally {
            fclose($descriptor);
        }

        return true;
    }

    /**
     * @param array $options
     * @return resource
     */
    private function createHttpContext(array $options = []): resource
    {
        return stream_context_create(['http' => $options]);
    }
}
