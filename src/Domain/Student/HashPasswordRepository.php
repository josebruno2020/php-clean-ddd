<?php

namespace Alura\Clean\Domain\Student;

interface HashPasswordRepository
{
    public function makeHash(string $password): string;

    public function verifyHash(string $purePassword, string $hashed): bool;
}