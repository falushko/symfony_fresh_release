<?php

namespace AppBundle\Worker;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\DependencyInjection\Container;

class WorkerConsumer implements ConsumerInterface
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
//        $logger = $this->container->get('logger');
//        $logger->info('worker constructor');

    }


    public function execute(AMQPMessage $message)
    {
        try {
            $this->container->get('app.mailer')->sendRegistrationMail(25);

        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}