<?php

namespace Alura\Clean\Infra\Student;

use Alura\Clean\Domain\Student\HashPasswordRepository;

class PhpHashPasswordRepository implements HashPasswordRepository
{

    public function makeHash(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    public function verifyHash(string $purePassword, string $hashed): bool
    {
        return password_verify(password: $purePassword, hash: $hashed);
    }
}