<?php 

namespace Core\Validation;

use Core\Validation\Rules\ExistRule;
use Core\Validation\Rules\RequiredRule;

final class ExistValidator extends _BaseValidator
{
    private $existValidationColumn;
    private $existValidationTable;

    public function __construct($existValidationColumn){
        $this->$existValidationColumn;
    }

    public function validateExist(array $data): void
    {
        $this->rules = $this->getGetRules();
        $this->validate($data);
    }

    protected function getGetRules(): array{
        return [
            'id' => [
                new RequiredRule(),
                new ExistRule($this->existValidationTable, $this->existValidationColumn),
            ],
        ];
    }



}