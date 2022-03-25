<?php

declare(strict_types=1);

namespace App\todo\Domain\User\Repository;

use App\todo\Application\Command\RegisterUserCommand;
use App\todo\Domain\User\Model\Users;

interface UserRepositoryInterface
{
    public function getAll(): iterable;

    public function findUserByEmail(string $email): ?Users;

    public function findUserByApiToken(string $token): ?Users;

    public function refreshApiToken(string $email, string $token): void;

    public function createNewUser(RegisterUserCommand $command): ?Users;

    public function clearToken(string $email): void;
}
