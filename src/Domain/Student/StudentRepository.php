<?php

namespace Alura\Clean\Domain\Student;

use Alura\Clean\Domain\Cpf;

interface StudentRepository
{
    public function add(Student $student): void;

    public function findByCpf(Cpf $cpf): Student;

    /**
     * @return Student[]
     */
    public function findAll(): array;
}
