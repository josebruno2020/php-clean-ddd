<?php

namespace Alura\Infra\Student;

use Alura\Clean\Domain\Cpf;
use Alura\Clean\Domain\Student\Student;
use Alura\Clean\Domain\Student\StudentNotFound;
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
        $sql = "SELECT a.cpf, nome, email, t.ddd, t.numero FROM alunos a 
            LEFT JOIN telefones t ON a.cpf = t.cpf_aluno
            WHERE a.cpf = :cpf";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('cpf', (string) $cpf);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $allRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($allRecords) === 0) {
            throw new StudentNotFound($cpf);
        }

        $firstRecord = $allRecords[0];

        $student = Student::makeStudent(cpf: $firstRecord['cpf'], email: $firstRecord['email'], name: $result['npme']);
        $allPhones = array_filter($allRecords, fn ($line) => !is_null($line['ddd']) && !is_null($line['numero']));
        foreach ($allPhones as $row) {
            $student->addPhone(ddd: $row['ddd'], number: $row['numero']);
        }

        return $student;
    }

    public function findAll(): array
    {
        // TODO
        return [];
    }
}
