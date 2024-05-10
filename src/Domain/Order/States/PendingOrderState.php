<?php
declare(strict_types=1);

namespace Domain\Order\States;

final class PendingOrderState extends OrderState
{
    protected array $allowedTransitions = [
        PaidOrderState::class,
        CanceledOrderState::class
    ];
    #[\Override] public function canBeChanged(): bool
    {
        return true;
    }

    #[\Override] public function value(): string
    {
        return 'pending';
    }

    #[\Override] public function humanValue(): string
    {
        return 'В обработке';
    }
}
