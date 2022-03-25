<?php

declare(strict_types=1);

namespace App\todo\Application\Command;

/**
 * @see ClearUserTokenHandler
 */
final class ClearUserTokenCommand
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}

