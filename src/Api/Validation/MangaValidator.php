<?php
namespace Api\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\ExistRule;
use Core\Validation\Rules\NotRequiredRule;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;

final class MangaValidator extends _BaseApiValidator
{
    private $table = 'mangas';
    private $column = 'Id_manga';

    protected function getGetRules(): array
    {
        return [
            'id' => [
                new RequiredRule(),
                new NumberRule(),
                new ExistRule($this->table, $this->column),
            ],
        ];
    }

    protected function getGetAllRules(): array
    {
        return [
            
        ];
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
           
        ];
    }

    protected function getDeleteRules(): array
    {
        return [
            'id' => new RequiredRule(),
        ];
    }

}