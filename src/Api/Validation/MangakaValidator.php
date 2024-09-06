<?php

namespace Api\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\ExistRule;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;



final class MangakaValidator extends _BaseApiValidator
{
    private $table = 'mangakas';
    private $column = 'Id_mangaka';

    protected function getGetRules(): array
    {
        return [
            'id' => [new RequiredRule(), new NumberRule(),new ExistRule($this->table, $this->column)],
           
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
