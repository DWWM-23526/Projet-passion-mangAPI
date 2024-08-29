<?php
namespace Api\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;

final class MangaValidator extends _BaseApiValidator
{

    protected function getGetRules(): array
    {
        return [
            'id' => new RequiredRule(),
        ];
    }

    protected function getGetAllRules(): array
    {
        return [
            // Pas de règles spécifiques pour "getAll" dans cet exemple
        ];
    }

    protected function getCreateRules(): array
    {
        return [
            'name' => new RequiredRule(),
            'age' => new NumberRule(),
        ];
    }

    protected function getUpdateRules(): array
    {
        return [
            'id' => new RequiredRule(),
            'name' => new RequiredRule(),
            'age' => new NumberRule(),
        ];
    }

    protected function getDeleteRules(): array
    {
        return [
            'id' => new RequiredRule(),
        ];
    }

}