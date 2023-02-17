<?php

namespace Alura\Clean\Test;

use Alura\Clean\Domain\Student\Student;
use Alura\Clean\Infra\Student\MemoryStudentRepository;
use PHPUnit\Framework\TestCase;

class StudentRepositoryTest extends TestCase
{
    private MemoryStudentRepository $repository;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->repository = new MemoryStudentRepository();
    }

    public function testAddStudentInMemorySuccessfully()
    {
        $student = Student::makeStudent('118.243.390-01', 'test@email.com', 'Student Test');
        $this->repository->add($student);
        $this->assertCount(1, $this->repository->findAll());
    }
}
