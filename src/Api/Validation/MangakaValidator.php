<?php

namespace Api\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;
use Core\Validation\Rules\StringRule;
use Core\Validation\Rules\TinyIntRule;


final class MangakaValidator extends _BaseApiValidator
{

    protected function getGetRules(): array
    {
        return [
            'id' => [new RequiredRule(), new NumberRule()],
            'img_mangaka' => [new RequiredRule(), new StringRule()],
            'first_name' => new StringRule(),
            'last_name' => new StringRule(),
            //    'birthdate' => // TODO: add daterule ?,
            'texte' => new StringRule(),
            'is_deleted' => new TinyIntRule(),
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
