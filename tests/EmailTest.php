<?php

namespace Alura\Clean;

use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testInvalidEmailThrowInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email('email inválido');
    }
}
