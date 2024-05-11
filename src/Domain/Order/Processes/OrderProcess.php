<?php
declare(strict_types=1);

namespace Domain\Order\Processes;

use Domain\Order\Events\OrderCreated;
use Domain\Order\Models\Order;
use DomainException;
use Illuminate\Pipeline\Pipeline;
use Support\Transaction;
use Throwable;

final class OrderProcess
{
    protected array $processes = [];

    public function __construct(
        protected Order $order
    )
    {
    }

    public function processes(array $processes): self
    {
        $this->processes = $processes;

        return $this;
    }

    public function run(): Order
    {
        return Transaction::run(function (){
           return app(Pipeline::class)
               ->send($this->order)
               ->through($this->processes)
               ->thenReturn();
        }, function (Order $order){
            flash()->info('Заказ №' . $order->id . ' успешно оформлен');
            event(new OrderCreated($order));
        }, function (Throwable $e){
            if(!app()->isProduction()) {
                throw new DomainException($e->getMessage());
            }
            else{
                throw new DomainException('Что-то пошло не так, попробуйте позже');
            }
        });
    }
}
