<?php

namespace Alura\Clean\Test\App;

use Alura\Clean\App\Student\RegisterStudent\RegisterStudent;
use Alura\Clean\App\Student\RegisterStudent\RegisterStudentDto;
use Alura\Clean\Domain\Cpf;
use Alura\Clean\Infra\Student\MemoryStudentRepository;
use PHPUnit\Framework\TestCase;

class RegisterStudentTest extends TestCase
{
    public function testRegisterStudentSuccessfully()
    {
        $registerStudent = new RegisterStudentDto(
            '012.345.678-90',
            'Teste',
            'teste@email.com'
        );

        $repository = new MemoryStudentRepository();

        $useCase = new RegisterStudent($repository);
        $useCase->execute($registerStudent);


        $student = $repository->findByCpf(new Cpf('012.345.678-90'));

        $this->assertEquals($registerStudent->name, $student->name());
        $this->assertEquals($registerStudent->email, $student->email());
        $this->assertEmpty($student->phones());
    }
}