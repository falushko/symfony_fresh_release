<?php

namespace AppBundle\Controller;

use AppBundle\Mailer\AuthenticationMailer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);


    }

    /**
     * @Route("/mail", name="mail")
     */
    public function registerAction()
    {
        $logger = $this->container->get('logger');
        $logger->info('controller');

        $message = ['message_type' => 'activation_email', 'user_id' => 123];

        $serializedMessage = serialize($message);


        $this->get('old_sound_rabbit_mq.worker_producer')->publish(serialize($message));


        return new JsonResponse([
            'ololo' => 'ololo'
        ]);
    }
}
