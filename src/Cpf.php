<?php

namespace Alura\Clean;

use InvalidArgumentException;
use Stringable;

class Cpf implements Stringable
{
    private string $number;

    public function __construct(string $number)
    {
        $this->setNumber($number);
    }


    private function setNumber(string $number): void
    {
        $options = [
            'options' => [
                'regexp' => '/\d{3}\.\d{3}\.\d{3}\-\d{2}/'
            ]
        ];
        if (!filter_var($number, FILTER_VALIDATE_REGEXP, $options)) {
            throw new InvalidArgumentException('CPF inválido');
        }
        $this->number = $number;
    }


    public function __toString(): string
    {
        return $this->number;
    }
}