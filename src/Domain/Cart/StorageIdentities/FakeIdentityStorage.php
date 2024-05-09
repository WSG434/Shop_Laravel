<?php
declare(strict_types=1);

namespace Domain\Cart\StorageIdentities;

use Domain\Cart\Contracts\CartIdentityStorageContract;

final class FakeIdentityStorage implements CartIdentityStorageContract
{
    #[\Override] public function get(): string
    {
        return 'tests';
    }
}
