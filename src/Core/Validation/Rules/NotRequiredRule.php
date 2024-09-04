<?php
namespace Core\Validation\Rules;

use Core\Validation\ValidationRuleInterface;

final class NotRequiredRule extends _BaseRule implements ValidationRuleInterface
{
    public function validate(mixed $values): array
    {
        if (!empty($values)) {
            return ['this field is not required'];
        }
        
        return [];
    }
}
