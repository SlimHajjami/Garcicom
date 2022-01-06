<?php

namespace GarcicomBundle\Controller;


use GarcicomBundle\Form\MessagesType;
use GarcicomBundle\Entity\Messages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{

    public function indexAction()
    {
        return $this->render('GarcicomBundle:messages:index.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }


    public function sendAction(Request $request)
    {
        $message = new Messages();
$form = $this->createForm( MessagesType::class, $message);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $message->setSender($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            $this->addFlash("message", "Message envoyé avec succès.");
            return $this->redirectToRoute("send");
        }

        return $this->render("GarcicomBundle:messages:send.html.twig", [
            "form" => $form->createView()
        ]);
    }


    public function receivedAction()
    {
        return $this->render('GarcicomBundle:messages:received.html.twig');
    }



    public function sentAction()
    {
        return $this->render('GarcicomBundle:messages:sent.html.twig');
    }


    public function readAction(Messages $message)
    {
        $message->setIsRead(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();

        return $this->render('GarcicomBundle:messages:read.html.twig', compact("message"));
    }


    public function deleteAction(Messages $message)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($message);
        $em->flush();

        return $this->redirectToRoute("received");
    }
}
