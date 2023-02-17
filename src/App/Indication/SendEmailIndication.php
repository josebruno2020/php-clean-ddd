<?php

namespace Alura\Clean\App\Indication;

use Alura\Clean\Domain\Student\Student;

interface SendEmailIndication
{
    public function send(Student $student): void;
}