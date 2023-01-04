<?php
namespace Alura\Clean\Domain\Student;

use Alura\Clean\Cpf;
use Alura\Clean\Email;
use JsonSerializable;

class Student implements JsonSerializable
{
    private Cpf $cpf;
    private string $name;
    private Email $email;
    private array $phones;

    public function __construct(Cpf $cpf, string $name, Email $email)
    {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->email = $email;
    }

    public static function makeStudent(string $cpf, string $email, string $name): self
    {
        return new Student(
                new Cpf($cpf),
                $name,
                new Email($email)
        );

    }

    public function addPhone(string $ddd, string $number): self
    {
        $this->phones[] = new Phone($ddd, $number);
        return $this;
    }


    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'email' => (string) $this->email,
            'cpf' => (string) $this->cpf
        ];
    }
}