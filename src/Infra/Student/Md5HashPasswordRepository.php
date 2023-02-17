<?php

namespace Alura\Clean\Infra\Student;

use Alura\Clean\Domain\Student\HashPasswordRepository;

class Md5HashPasswordRepository implements HashPasswordRepository
{

    public function makeHash(string $password): string
    {
        return md5($password);
    }

    public function verifyHash(string $purePassword, string $hashed): bool
    {
        return md5($purePassword) === $hashed;
    }
}