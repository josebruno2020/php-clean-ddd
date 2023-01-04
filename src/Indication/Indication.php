<?php

namespace Alura\Clean\Indication;

use Alura\Clean\Student\Student;
use DateTimeImmutable;

class Indication
{
    private Student $indicative;
    private Student $indicated;
    private DateTimeImmutable $date;

    public function __construct(Student $indicative, Student $indicated)
    {
        $this->indicative = $indicative;
        $this->indicated = $indicated;

        $this->date = new DateTimeImmutable();
    }
}