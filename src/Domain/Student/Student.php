<?php

namespace Alura\Clean\Domain\Student;

use Alura\Clean\Domain\Cpf;
use Alura\Clean\Domain\Email;
use JsonSerializable;

class Student implements JsonSerializable
{
    private Cpf $cpf;
    private string $name;
    private Email $email;

    /**
     * @var Phone[]
     */
    private array $phones;

    public function __construct(Cpf $cpf, string $name, Email $email)
    {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->email = $email;
        $this->phones = [];
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

    public function cpf(): string
    {
        return $this->cpf;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return Phone[]
     */
    public function phones(): array
    {
        return $this->phones;
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
