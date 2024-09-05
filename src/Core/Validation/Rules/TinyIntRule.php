<?php

namespace Core\Validation\Rules;

use Core\Validation\ValidationRuleInterface;

final class TinyIntRule extends _BaseRule implements ValidationRuleInterface
{
  public function validate(mixed $values): array
  {
    if (!is_int($values) || $values > 1) {
      return ['this field must be a tinyint (0 or 1)'];
    }

    return [];
  }
}
