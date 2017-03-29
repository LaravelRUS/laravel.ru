<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 28.03.17
 * Time: 10:55
 */

namespace App\GraphQL\Mutations;


use Folklore\GraphQL\Support\Mutation;

class AbstractMutation extends Mutation
{

    /**
     * @param $args
     * @param $rules
     * @return \Illuminate\Validation\Validator
     */
    public function getValidator($args, $rules)
    {
        $messages = $this->messages();
        if (!empty($messages)) {
            $validator = \Validator::make($args, $rules, $messages);
        } else {
            $validator = \Validator::make($args, $rules);
        }
        $validator->after(function($validator) use($args) {
            $this->afterValidation($validator, $args);
        });
        return $validator;
    }

    /**
     * @param \Illuminate\Validation\Validator $validator
     * @param $args
     */
    public function afterValidation($validator, $args) {

    }

    /**
     * @return array
     */
    public function messages():array
    {
        
    }
}