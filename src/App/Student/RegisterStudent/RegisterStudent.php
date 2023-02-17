<?php

namespace Alura\Clean\App\Student\RegisterStudent;

use Alura\Clean\Domain\Student\Student;
use Alura\Clean\Domain\Student\StudentRepository;

class RegisterStudent
{
    private StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function execute(RegisterStudentDto $data): void
    {
        $student = Student::makeStudent($data->cpf, $data->email, $data->name);
        $this->studentRepository->add($student);
    }
}