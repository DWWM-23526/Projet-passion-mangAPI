<?php

namespace Core\Validation\Rules;

use Core\Validation\ValidationRuleInterface;

final class BooleanRule extends _BaseRule implements ValidationRuleInterface
{
  public function validate(mixed $values): array
  {
    if (!is_bool($values)) {
      return ['this field must be a boolean'];
    }

    return [];
  }
}
