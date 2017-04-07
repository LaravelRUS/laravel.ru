<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Kernel\Paginator;

use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\GraphQL\Serializers\RawSerializer;
use App\GraphQL\Serializers\AbstractSerializer;

/**
 * Class PaginatorConfiguration
 * @package App\GraphQL\Kernel\Paginator
 */
class PaginatorConfiguration implements \IteratorAggregate
{
    public const QUERY_LIMIT = '_limit';
    public const QUERY_PAGE  = '_page';

    private const LIMIT_DEFAULT = 10;
    private const LIMIT_MIN  = 1;
    private const LIMIT_MAX  = 100;

    /**
     * @var array|PaginatorConfiguration[]
     */
    private static $configs = [];

    /**
     * @var null|AbstractSerializer
     */
    protected $serializer = null;

    /**
     * @var null|Builder
     */
    protected $query;

    /**
     * @var int
     */
    protected $limit = self::LIMIT_DEFAULT;

    /**
     * @var int
     */
    protected $page = 1;

    /**
     * @var null|string
     */
    private $alias;

    /**
     * @var int
     */
    private $perPage = self::LIMIT_DEFAULT;

    /**
     * @var int
     */
    private $count;

    /**
     * PaginatorConfiguration constructor.
     * @param Builder $builder
     */
    public function __construct(Builder $builder, int $count)
    {
        self::$configs[] = $this;
        $this->query = $builder;
        $this->count = $count;
    }

    /**
     * @param string $alias
     * @return PaginatorConfiguration
     */
    public static function find(string $alias): ?PaginatorConfiguration
    {
        foreach (self::$configs as $config) {
            if ($config->getAlias() === $alias) {
                return $config;
            }
        }

        return null;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return (int)ceil($this->count / $this->getLimit());
    }

    /**
     * @return array
     */
    public static function getConfigs(): array
    {
        return self::$configs;
    }

    /**
     * @return AbstractSerializer|null
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @return Builder
     */
    public function getQuery(): Builder
    {
        return $this->query;
    }

    /**
     * @return int|null
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getSkip(): int
    {
        return (int)($this->page - 1) * $this->limit;
    }

    /**
     * @return null|string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param array $original
     * @return array
     */
    public static function withPaginatorArguments(array $original): array
    {
        return array_merge($original, [
            static::QUERY_LIMIT => [
                'type'        => Type::int(),
                'description' => 'Items per page: in 1...1000 range',
            ],
            static::QUERY_PAGE   => [
                'type'        => Type::int(),
                'description' => 'Current page number (Usage without "_limit" argument gives no effect)',
            ],
        ]);
    }

    /**
     * @param array $args
     * @return $this
     */
    public function withArgs(array $args)
    {
        $this->limit = $args[static::QUERY_LIMIT] ?? self::LIMIT_DEFAULT;
        $this->limit = min(self::LIMIT_MAX, $this->limit);
        $this->limit = max(self::LIMIT_MIN, $this->limit);


        $this->page  = max(1, $args[static::QUERY_PAGE] ?? 1);

        return $this;
    }

    /**
     * @param $data
     * @return Collection
     */
    private function serializeCollection($data)
    {
        if ($this->serializer === null) {
            return RawSerializer::collection($data);
        }

        return $this->serializer::collection($data);
    }

    /**
     * @param null|string $serializer
     * @return $this|PaginatorConfiguration
     */
    public function use(?string $serializer): PaginatorConfiguration
    {
        $this->serializer = $serializer;

        return $this;
    }

    /**
     * @param string $graphQlQuery
     * @return PaginatorConfiguration
     */
    public function as(string $graphQlQuery): PaginatorConfiguration
    {
        $this->alias = $graphQlQuery;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getIterator()
    {
        $query = clone $this->query;

        if ($this->limit !== null) {
            $query = $query->take((int)$this->limit);
        }

        if ($this->page > 0 && $this->limit !== null) {
            $query = $query->skip($this->getSkip());
        }

        $result = $query->get();

        $this->perPage = $result->count();

        return $this->serializeCollection($result);
    }
}