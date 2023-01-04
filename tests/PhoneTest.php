<?php

namespace Alura\Clean\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    public function testInvalidDddThrowInvalidArgumentException()
    {
        $this->expectException(InvalidArgumentException::class);

        new Phone('ddd', '988447123');
    }

    public function testMakeNewPhoneInString()
    {
        $phone = new Phone('44', '988447123');
        $this->assertSame('(44) 988447123', (string) $phone);
    }
}
