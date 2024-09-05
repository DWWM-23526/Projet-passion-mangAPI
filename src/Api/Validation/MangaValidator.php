<?php

namespace Api\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\NotRequiredRule;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;
use Core\Validation\Rules\StringRule;
use Core\Validation\Rules\TinyIntRule;

final class MangaValidator extends _BaseApiValidator
{

    protected function getGetRules(): array
    {
        return [
            'id' => new RequiredRule(),
            'img_manga' => new StringRule(),
            'manga_name' => new StringRule(),
            'edition' => new StringRule(),
            'total_tome_number' => new NumberRule(),
            'texte' => new StringRule(),
            'is_deleted' => new TinyIntRule(),
            'Id_mangaka' => new NumberRule()
        ];
    }

    protected function getGetAllRules(): array
    {
        return [];
    }

    protected function getCreateRules(): array
    {
        return [
            'id' => new NotRequiredRule(),
        ];
    }

    protected function getUpdateRules(): array
    {
        return [
            'id' => new NotRequiredRule(),
            // 'name' => new RequiredRule(),
            // 'age' => new NumberRule(),
        ];
    }

    protected function getDeleteRules(): array
    {
        return [
            'id' => new RequiredRule(),
        ];
    }
}
