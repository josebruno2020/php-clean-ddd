<?php

namespace Alura\Infra\Student;

use Alura\Clean\Domain\Cpf;
use Alura\Clean\Domain\Student\Student;
use Alura\Clean\Domain\Student\StudentRepository;
use PDO;

class PdoStudentRepository implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function add(Student $student): void
    {
        $sql = "INSERT INTO alunos VALUES (:cpf, :nome, :email);";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('cpf', $student->cpf());
        $stmt->bindValue('name', $student->name());
        $stmt->bindValue('email', $student->email());

        $stmt->execute();

        $sql = "INSERT INTO telefones VALUES (:ddd, :number, :student_cpf);";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('student_cpf', $student->cpf());

        /**
         * @var Phone $phone
         */
        foreach ($student->phones() as $phone) {
            $stmt->bindValue('ddd', $phone->ddd());
            $stmt->bindValue('number', $phone->number());
            $stmt->execute();
        }
    }

    public function findByCpf(Cpf $cpf): Student
    {
        $sql = "SELECT * FROM alunos WHERE cpf = :cpf";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('cpf', (string) $cpf);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new \Exception('Aluno não encontrado');
        }

        return Student::makeStudent($result['cpf'], $result['email'], $result['name']);
    }

    public function findAll(): array
    {
        // TODO
        return [];
    }
}
