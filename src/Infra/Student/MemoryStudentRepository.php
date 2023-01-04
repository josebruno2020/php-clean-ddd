<?php

namespace Alura\Clean\Infra\Student;


use Alura\Clean\Domain\Cpf;
use Alura\Clean\Domain\Student\Student;
use Alura\Clean\Domain\Student\StudentNotFound;
use Alura\Clean\Domain\Student\StudentRepository;

class MemoryStudentRepository implements StudentRepository
{
    private array $students = [];

    public function add(Student $student): void
    {
        $this->students[] = $student;
    }

    public function findByCpf(Cpf $cpf): Student
    {
        $filter =  array_filter($this->students, fn (Student $student) => $student->cpf() === (string) $cpf);

        if (count($filter) === 0) {
            throw new StudentNotFound('Aluno não encontrado');
        }

        return $filter[0];
    }

    public function findAll(): array
    {
        return $this->students;
    }
}
