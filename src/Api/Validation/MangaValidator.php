<?php

namespace Api\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\NotRequiredRule;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;

final class MangaValidator extends _BaseApiValidator
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
        return [

        ];
    }

    protected function getUpdateRules(): array
    {
        return [
            'id' => new NotRequiredRule(),

        ];
    }

    protected function getDeleteRules(): array
    {
        return [
            'id' => new RequiredRule(),
        ];
    }
}
