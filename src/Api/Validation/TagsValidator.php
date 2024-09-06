<?php

namespace Api\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;


final class TagsValidator extends _BaseApiValidator
{

    protected function getGetRules(): array
    {
        return [
            'id' => [new RequiredRule(), new NumberRule()],

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
