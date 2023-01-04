<?php

namespace Alura\Clean\Domain\Student;

class StudentNotFound extends \DomainException
{
    public function __construct(string $cpf, int $status = 404)
    {
        parent::__construct("Aluno com $cpf não encontrado", $status);
    }
}