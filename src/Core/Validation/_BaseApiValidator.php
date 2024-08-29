<?php 

namespace Core\Validation;

abstract class _BaseApiValidator extends _BaseValidator
{

    public function validateGet(array $data): void
    {
        $this->rules = $this->getGetRules();
        $this->validate($data);
    }

    public function validateGetAll(array $data): void
    {
        $this->rules = $this->getGetAllRules();
        $this->validate($data);
    }

    public function validateCreate(array $data): void
    {
        $this->rules = $this->getCreateRules();
        $this->validate($data);
    }

    public function validateUpdate(array $data): void
    {
        $this->rules = $this->getUpdateRules();
        $this->validate($data);
    }

    public function validateDelete(array $data): void
    {
        $this->rules = $this->getDeleteRules();
        $this->validate($data);
    }

    abstract protected function getGetRules(): array;
    abstract protected function getGetAllRules(): array;
    abstract protected function getCreateRules(): array;
    abstract protected function getUpdateRules(): array;
    abstract protected function getDeleteRules(): array;


}