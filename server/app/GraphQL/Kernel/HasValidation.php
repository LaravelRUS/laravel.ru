<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\GraphQL\Kernel;

use Illuminate\Validation\Factory;
use Folklore\GraphQL\Support\Field;
use Illuminate\Contracts\Validation\Validator;

/**
 * Class HasValidation
 * @package App\GraphQL\Kernel
 * @mixin Field
 */
trait HasValidation
{
    /**
     * @param $args
     * @param $rules
     * @return Validator
     */
    protected function getValidator($args, $rules): Validator
    {
        /** @var Factory $factory */
        $factory = app(Factory::class);

        $validator = $factory->make($args, $rules, $this->messages());

        $validator->after(function($validator) use($args) {
            $this->afterValidation($validator, $args);
        });

        return $validator;
    }

    /**
     * @param Validator|\Illuminate\Validation\Validator $validator
     * @param array $args
     */
    private function afterValidation(Validator $validator, array $args): void
    {
        $validatorErrors = $this->validate($validator, $args);

        if ($validatorErrors instanceof \Traversable) {
            foreach ($validatorErrors as $key => $message) {
                $validator->errors()->add($key, $message);
            }
        }
    }

    /**
     * @param Validator $validator
     * @param array $args
     * @return \Generator|null
     */
    public function validate(Validator $validator, array $args = []): ?\Generator
    {
        return null;
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [];
    }
}