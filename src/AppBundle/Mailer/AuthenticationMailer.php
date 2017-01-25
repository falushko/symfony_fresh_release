<?php

namespace AppBundle\Mailer;

use Symfony\Component\DependencyInjection\Container;
use Swift_Message;

class AuthenticationMailer
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function sendRegistrationMail($userId)
    {
        $body = $this->container->get('twig')->render('@App/emails/email.html.twig', ['password' => 'ololo']);

        $this->container->get('mailer')->send(Swift_Message::newInstance()
            ->setSubject('JTracker new password')
            ->setFrom('noreply@jelvix.com')
            ->setTo('vladimir.falushko@jelvix.com')
            ->setBody($body, 'text/html')
        );
    }
}