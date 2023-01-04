<?php

namespace Alura\Clean\Domain\Student;

use InvalidArgumentException;
use JsonSerializable;
use Stringable;

class Phone implements Stringable, JsonSerializable
{
    private string $ddd;
    private string $number;

    public function __construct(string $ddd, string $number)
    {
        $this->setDdd($ddd);
        $this->setNumber($number);
    }

    private function setDdd(string $ddd): void
    {
        if (preg_match('/\d{2}/', $ddd) !== 1) {
            echo 'oi';
            throw new InvalidArgumentException('DDD inválido');
        }
        $this->ddd = $ddd;
    }


    private function setNumber(string $number): void
    {
        $options = [
            'options' => [
                'regexp' => '/\d{8,9}/'
            ]
        ];
        if (!filter_var($number, FILTER_VALIDATE_REGEXP, $options)) {
            throw new InvalidArgumentException('Telefone inválido');
        }
        $this->number = $number;
    }

    public function ddd(): string
    {
        return $this->ddd;
    }

    public function number(): string
    {
        return $this->number;
    }

    public function __toString(): string
    {
        return "($this->ddd) $this->number";
    }


    public function jsonSerialize(): array
    {
        return [
            'ddd' => $this->ddd,
            'phone' => $this->number
        ];
    }
}
