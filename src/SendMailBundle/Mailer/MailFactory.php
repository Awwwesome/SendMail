<?php

namespace SendMailBundle\Mailer;


use SendMailBundle\Model\Mail;
use Symfony\Component\BrowserKit\Request;

class MailFactory
{
    private $mailer;

    private $from;

    public function __construct(\Swift_Mailer $mailer, $from)
    {
        $this->mailer = $mailer;
        $this->from = $from;
    }

    public function send(Mail $mail)
    {
        $message = new \Swift_Message();
        $message
            ->setSubject($mail->getSubject())
            ->setFrom($this->from)
            ->setTo($mail->getEmail())
            ->setBody($mail->getContent())
            ;
        foreach ($mail->getFiles() as $file){
            $message->attach(\Swift_Attachment::fromPath($file->getpathName())->setFilename($file->getfileName()));
        }

        $this->mailer->send($message);
    }
}