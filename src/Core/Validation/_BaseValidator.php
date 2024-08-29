<?php

namespace Core\Validation;

abstract class _BaseValidator
{

    protected array $rules = [];

    public function validate(array $data): void
    {

        $errors = [];

        foreach ($this->rules as $field => $rule) 
        {
            $value = $data[$field] ?? null;
            $errors = array_merge($errors, $rule->validate($value));
        }

        if (!empty($errors))
        {
            $this->handleErrors($errors);
        }

    }

    protected function handleErrors(array $errors):  void
    {
        throw new \Exception('Validation errors: ' . json_encode($errors));
        
    }

    public function addRule(string $field, ValidationRuleInterface $rule)
    {
        $this->rules[$field] = $rule;
    }
    
}
