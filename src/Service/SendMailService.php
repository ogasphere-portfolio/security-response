<?php
namespace App\Service;

use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class SendMailService
{
  private $mailer;
  private $twig;

  public function __construct(MailerInterface $mailer, Environment $twig)
  {
    $this->mailer = $mailer;
    $this->twig = $twig;
  }

  public function send(string $from, string $to, string $subject, string $template, array $parameters) :void
    {
      $email = (new Email())
            ->from($from)
            ->to($to)            
            ->subject($subject)          
            ->html(
                $this->twig->render($template, $parameters)
            );

        $this->mailer->send($email);
    }
}