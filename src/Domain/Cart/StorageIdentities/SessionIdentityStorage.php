<?php
declare(strict_types=1);

namespace Domain\Cart\StorageIdentities;

use Domain\Cart\Contracts\CartIdentityStorageContract;

final class SessionIdentityStorage implements CartIdentityStorageContract
{
    #[\Override] public function get(): string
    {
        return session()->getId();
    }
}
