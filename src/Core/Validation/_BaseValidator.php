<?php

namespace Core\Validation;

use core\HTTPResponse;

abstract class _BaseValidator
{

    protected array $rules = [];

    public function validate(array $data): void
    {

        $errors = [];

        foreach ($this->rules as $key => $fieldRules) {
            $value = $data[$key] ?? null;

            foreach ($fieldRules as $rule) {

                $errors = array_merge($errors, $rule->validate($value));
            }
        }

        if (!empty($errors)) {
            $this->handleErrors($errors);
        }
    }

    protected function handleErrors(array $errors): void
    {
        throw new \Exception('Validation errors: ' . json_encode($errors));

    }

}
