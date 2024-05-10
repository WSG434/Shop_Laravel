<?php
declare(strict_types=1);

namespace Domain\Order\States;

final class CanceledOrderState extends OrderState
{
    protected array $allowedTransitions = [

    ];
    #[\Override] public function canBeChanged(): bool
    {
        return false;
    }

    #[\Override] public function value(): string
    {
        return 'canceled';
    }

    #[\Override] public function humanValue(): string
    {
        return 'Отменен';
    }
}
