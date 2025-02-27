<?php

namespace App\Rules;

use App\Core\Exceptions\RuleError;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class DoesNotExist implements ValidationRule
{
    protected $table;
    protected $column;
    protected $name;

    public function __construct($table, $column, $name)
    {
        $this->table = $table;
        $this->column = $column;
        $this->name = $name;
    }

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (DB::table($this->table)->where($this->column, $value)->exists()) {
            throw RuleError::jaExiste($this->name, $this->column);
        }
    }
}
