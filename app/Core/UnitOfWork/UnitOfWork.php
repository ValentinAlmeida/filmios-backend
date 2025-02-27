<?php

namespace App\Core\UnitOfWork;

use App\Core\Contracts\UnitOfWorkInterface;
use Closure;
use Illuminate\Support\Facades\DB;

class UnitOfWork implements UnitOfWorkInterface
{
    public function run(Closure $cb): mixed
    {
        DB::beginTransaction();
        try {
            $result = $cb();
            DB::commit();
            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
