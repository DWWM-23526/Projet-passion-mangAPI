<?php

namespace Core\Validation\Rules;

use Core\Validation\ValidationRuleInterface;

final class StringRule extends _BaseRule implements ValidationRuleInterface
{
  public function validate(mixed $values): array
  {
    if (!is_string($values)) {
      return ['this field must be a string'];
    }

    return [];
  }
}
