<?php
declare(strict_types=1);

namespace Domain\Order\States;

final class PaidOrderState extends OrderState
{
    protected array $allowedTransitions = [
        CanceledOrderState::class
    ];
    #[\Override] public function canBeChanged(): bool
    {
        return true;
    }

    #[\Override] public function value(): string
    {
        return 'paid';
    }

    #[\Override] public function humanValue(): string
    {
        return 'Оплачен';
    }
}
