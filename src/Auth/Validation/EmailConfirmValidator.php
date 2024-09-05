<?php

namespace Auth\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;
use Core\Validation\Rules\StringRule;


final class EmailConfirmValidator extends _BaseApiValidator
{

    protected function getGetRules(): array
    {
        return [
            'id' => [new RequiredRule(), new NumberRule()],
            'email' => [new RequiredRule(), new StringRule()],
            'name' => [new RequiredRule(), new StringRule()],
            //  'date' => TODO: Add dateRule ?
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
