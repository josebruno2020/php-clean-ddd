<?php

namespace Alura\Clean\Test\Domain;

use Alura\Clean\Domain\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testInvalidEmailThrowInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email('email inválido');
    }
}
