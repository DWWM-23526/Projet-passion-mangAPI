<?php 

namespace Core\Validation;

interface ValidationRuleInterface
{
    public function validate($value) : array;
}