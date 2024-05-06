<?php
declare(strict_types=1);

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final class NewUserDTO
{
    use Makeable;

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    )
    {
    }

    public static function fromRequest(Request $request): NewUserDTO
    {
        return static::make(...$request->only(['name','email','password']));
    }

}
