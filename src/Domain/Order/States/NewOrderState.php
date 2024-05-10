<?php
declare(strict_types=1);

namespace Domain\Order\States;

final class NewOrderState extends OrderState
{
    protected array $allowedTransitions = [
        PendingOrderState::class,
        CanceledOrderState::class,
    ];
    #[\Override] public function canBeChanged(): bool
    {
        return true;
    }

    #[\Override] public function value(): string
    {
        return 'new';
    }

    #[\Override] public function humanValue(): string
    {
        return 'Новый заказ';
    }
}
