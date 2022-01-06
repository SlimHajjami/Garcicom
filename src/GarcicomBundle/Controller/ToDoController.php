<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 05/02/2021
 * Time: 10:13
 */

namespace GarcicomBundle\Controller;


use GarcicomBundle\Entity\ToDo;
use GarcicomBundle\Form\ToDoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * ToDo controller.
 *
 * @Route("ToDo")
 */
class ToDoController extends Controller
{
    public function AddAction(Request $request){
        if ($this->getUser() == null){
            return $this->redirectToRoute('fos_user_security_login');
        }
    $Todo = new ToDo();
        $form = $this->createForm(ToDoType::class, $Todo);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $Todo->setEtat("en cours");
            $Todo->setUser($this->getUser());
            $em->persist($Todo);
            $em->flush();
        }
        $em = $this->getDoctrine()->getManager();
        $TodoA =$em->getRepository("GarcicomBundle:Todo")->findBy(array('User'=>$this->getUser()));
        $r = 0;
        $f = 0;
        foreach ($TodoA as $c ){
            if($c->getEtat() == "Fini"){
                $r=$r+1;
            }
            $f = $f+1;

        }
        if ($f ==0){
            $h = 100;
        }else
        $h = ($r/$f) * 100;
        return $this->render("GarcicomBundle:Default:index.html.twig",
            array('form' => $form->createView(),'TodoA'=> $TodoA ,'h'=>$h

            ));

    }
    public function checkAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $check =$em->getRepository("GarcicomBundle:Todo")->find($id);
        if($check->getEtat()=="en cours"){
       $check->setEtat("Fini");
        }
        else{$check->setEtat('en cours');
        }
        $em->persist($check);
        $em->flush();
       return $this->redirectToRoute('garcicom_homepage');
    }
    /**
     * Finds and displays a calendar entity.
     *
     * @Route("/api/{id}/add", name="api_event_add")
     * @Method("PUT")
     */
    public function addDynamicEvent(Todo $toDo, Request $request)
    {

        $donne = json_decode($request->getContent());
        if (
            isset($donne->description) && !empty($donne->description)

        )
        {
            if (!$toDo){
                $code = 200;
                $toDo = new ToDo();

            }
            $toDo->setTitle($donne->description);
            $toDo->setUser($this->getUser());
            $toDo->setEtat("En cours");

            $em = $this->getDoctrine()->getManager();
            $em->persist($toDo);
            $em->flush();

            $td = $em->getRepository("GarcicomBundle:Todo")->findBy(array('User' => $this->getUser()));
            $a []= [];
            foreach ($td as $b){
                $a[] = [
                    'description' => $b->getDescription()
                ];
            }
            $data = json_encode($a);
            debugger_print($data);
            return $this->render("GarcicomBundle:Default:index.html.twig",compact('data'));
        }else
        {
            return new \Symfony\Component\HttpFoundation\Response('donnée incomplete',404);
        }

    }


}