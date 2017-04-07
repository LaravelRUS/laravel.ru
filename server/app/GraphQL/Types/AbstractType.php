<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Types;

use App\GraphQL\Feature\EnumsSupport;
use App\GraphQL\Feature\Kernel\FeaturesSupport;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * Class AbstractType.
 */
abstract class AbstractType extends GraphQLType
{
    use EnumsSupport;
    use FeaturesSupport;

    /**
     * AbstractType constructor.
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->boot();
        parent::__construct($attributes = []);
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return $this->extendFields($this->typeFields());
    }

    /**
     * @return array
     */
    abstract public function typeFields(): array;
}
