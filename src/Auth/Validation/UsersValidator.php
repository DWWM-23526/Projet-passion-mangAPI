<?php

namespace Auth\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;
use Core\Validation\Rules\StringRule;
use Core\Validation\Rules\TinyIntRule;


final class UsersValidator extends _BaseApiValidator
{

    protected function getGetRules(): array
    {
        return [
            'id' => [new RequiredRule(), new NumberRule()],
            'name' => [new RequiredRule(), new StringRule()],
            'email' => [new RequiredRule(), new StringRule()],
            'password' => [new RequiredRule(), new StringRule()],
            'is_deleted' => new TinyIntRule(),
            'id_role' => new NumberRule()
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
