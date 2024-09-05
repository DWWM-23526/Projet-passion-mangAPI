<?php

namespace Auth\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;
use Core\Validation\Rules\StringRule;


final class RoleValidator extends _BaseApiValidator
{

    protected function getGetRules(): array
    {
        return [
            'id' => [new RequiredRule(), new NumberRule()],
            'nom' => [new RequiredRule(), new StringRule()],
            'role_weight' => [new RequiredRule(), new NumberRule()]
        ];
    }

    protected function getGetAllRules(): array
    {
        return [];
    }

    protected function getCreateRules(): array
    {
        return [];
    }

    protected function getUpdateRules(): array
    {
        return [];
    }

    protected function getDeleteRules(): array
    {
        return [];
    }
}
