<?php

namespace Core\Validation;

use core\HTTPResponse;

abstract class _BaseValidator
{

    protected array $rules = [];

    public function validate(array $data): void
    {

        $errors = [];

        foreach ($this->rules as $key => $rule) {
            $value = $data[$key] ?? null;

            var_dump($rule);

            foreach ($rule as $_rule) {

                var_dump($_rule->validate($value));

                $errors = array_merge($errors, $_rule->validate($value));
            }
        }

        var_dump($errors);

        if (!empty($errors)) {
            $this->handleErrors($errors);
        }
    }

    protected function handleErrors(array $errors): void
    {
        throw new \Exception('Validation errors: ' . json_encode($errors));
        // HTTPResponse::abort('Validation errors: ' . json_encode($errors), 500 );
    }

    public function addRule(string $key, ValidationRuleInterface $rule)
    {
        $this->rules[$key] = $rule;
    }
}
