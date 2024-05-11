<?php
declare(strict_types=1);

namespace Support;

use Closure;
use Illuminate\Support\Facades\DB;
use Throwable;

final class Transaction
{
    public static function run(
        Closure $callback,
        Closure $finished = null,
        Closure $onError = null
    )
    {
        try{
            DB::beginTransaction();

            $result = $callback();

            DB::commit();

            if(!is_null($finished)){
                $finished($result);
            }

            return $result;

        } catch (Throwable $e){
            DB::rollBack();

            if(!is_null($onError)){
                $onError($e);
            }

            throw $e;
        }

    }
}
