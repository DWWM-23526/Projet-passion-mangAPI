<?php

namespace Api\Validation;

use Core\Validation\_BaseApiValidator;
use Core\Validation\Rules\ExistRule;
use Core\Validation\Rules\NotRequiredRule;
use Core\Validation\Rules\NumberRule;
use Core\Validation\Rules\RequiredRule;
use Core\Validation\Rules\StringRule;
use Core\Validation\Rules\TinyIntRule;

final class MangaValidator extends _BaseApiValidator
{
    private $table = 'mangas';
    private $column = 'Id_manga';

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
        return [
            'id' => [new RequiredRule(), new NumberRule(),new ExistRule($this->table, $this->column)],
            'img_manga' => [new RequiredRule(), new StringRule()],
            'manga_name' => new StringRule(),
            'edition' => new StringRule(),
            'total_tome_number' => new NumberRule(),
            'texte' => new StringRule(),
            'is_deleted' => new TinyIntRule(),
            'Id_mangaka' => new NumberRule()
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
