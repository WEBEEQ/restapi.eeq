<?php
declare(strict_types = 1);

// src/Core/Email.php
namespace AppBundle\Core;

class Email
{
    public static function sendEmail(
        string $serverName,
        string $emailFrom,
        string $emailTo,
        string $subject,
        string $message
    ): bool {
        ini_set('SMTP', $serverName);
        ini_set('smtp_port', '25');
        ini_set('sendmail_from', $emailFrom);

        return mail($emailTo, '=?utf-8?B?' . base64_encode($subject) . '?=', $message, 'From: '
            . $emailFrom . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n"
            . 'Content-Type: text/plain; charset=utf-8');
    }
}
