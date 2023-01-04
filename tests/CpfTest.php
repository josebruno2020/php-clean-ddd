<?php

namespace Alura\Clean;

use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
  public function testInvalidCpfThrowInvalidArgumentException(): void
  {
      $this->expectException(\InvalidArgumentException::class);
      new Cpf('11111111111');
  }

  public function testValidCpfShouldBeRepresenting(): void
  {
      $cpf = new Cpf('111.111.111-11');
      $this->assertSame('111.111.111-11', (string) $cpf);
  }
}
