<?php

namespace Alura\Clean\Infra\Indication;

use Alura\Clean\App\Indication\SendEmailIndication;
use Alura\Clean\Domain\Student\Student;

class MailSendEmailIndicationRepository implements SendEmailIndication
{

    public function send(Student $student): void
    {
        mail(
            to: $student->email(),
            subject: 'Nova Indicação',
            message: "Mensagem",
            additional_headers: [
                "From" => $_ENV['FROM_MAIL'],
                'X-Mailer' => 'PHP/' . phpversion()
            ]
        );
    }
}