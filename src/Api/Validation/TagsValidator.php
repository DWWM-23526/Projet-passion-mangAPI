<?php

namespace Api\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\ExistRule;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;


final class TagsValidator extends _BaseApiValidator
{
    private $table = 'tags';
    private $column = 'Id_tag';

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
