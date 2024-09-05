<?php
namespace Core\Validation\Rules;

use Core\Validation\ValidationRuleInterface;

final class NumberRule extends _BaseRule implements ValidationRuleInterface
{
    public function validate(mixed $values): array
    {
        if (!is_numeric($values)) {

         
            return ['this field must be a number'];
        }
        
        return [];
    }
}
