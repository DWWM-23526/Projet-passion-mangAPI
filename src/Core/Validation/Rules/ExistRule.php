<?php
namespace Core\Validation\Rules;

use Core\App;
use Core\repositories\CoreRepository;
use Core\Validation\ValidationRuleInterface;

final class ExistRule extends _BaseRule implements ValidationRuleInterface
{

    private CoreRepository $repository;
    private $table;
    private $column;

    public  function __construct(string $table, string $column) {
        $this->repository = App::injectRepository()->getContainer(CoreRepository::class);
        $this->column = $column;
        $this->table = $table;
    }
    
    public function validate(mixed $values): array
    {

        $result = $this->repository->checkIfItemExists($this->table, [$values], [$this->column]);

        if ($result[0]['result'] == 0) {
            return ['object does not exist'];
        }
        
        return [];
    }
}
