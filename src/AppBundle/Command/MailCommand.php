<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.01.17
 * Time: 15:30
 */

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('email:send')->setDescription('Send email with cron');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('app.mailer')->sendRegistrationMail(25);
    }

}