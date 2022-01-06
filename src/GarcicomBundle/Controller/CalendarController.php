<?php

namespace GarcicomBundle\Controller;

use GarcicomBundle\Entity\Calendar;
use GarcicomBundle\Form\CalendarType;
use GarcicomBundle\Repository\CalendarRepository;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Calendar controller.
 *
 * @Route("calendar")
 */
class CalendarController extends Controller
{

    public function indexAction(CalendarRepository $Calendar)
    {
        if ($this->getUser() == null){
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();


        $calendars = $em->getRepository('GarcicomBundle:Calendar')->findAll();

        return $this->render('GarcicomBundle:Calendar:Calendar.html.twig', array(
            'calendars' => $calendars,
        ));
    }

    /**
     * Finds and displays a calendar entity.
     *
     * @Route("/api/{id}/edit", name="api_event_edit")
     * @Method("PUT")
     */
    public function majEvent(Calendar $calendar, Request $request)
    {
        if ($this->getUser() == null){
            return $this->redirectToRoute('fos_user_security_login');
        }

    $donne = json_decode($request->getContent());
    if (
        isset($donne->title) && !empty($donne->title)&&
        isset($donne->start) && !empty($donne->start)&&
        isset($donne->end) && !empty($donne->end)&&
        isset($donne->description) && !empty($donne->description)&&
        isset($donne->backgroundColor) && !empty($donne->backgroundColor)&&
        isset($donne->borderColor) && !empty($donne->borderColor)&&
        isset($donne->textColor) && !empty($donne->textColor)
    )
    {
    if (!$calendar){
        $code = 200;
        $calendar = new Calendar();

    }
        $calendar->setTitle($donne->title);
        $calendar->setStart(new \Datetime($donne->start));

        $calendar->setEnd(new \DateTime($donne->end));
        $calendar->setDescription($donne->description);
        $calendar->setBackgroundcolor($donne->backgroundColor);
        $calendar->setBorderColor($donne->borderColor);
        $calendar->setTextcolor($donne->textColor);

        $em = $this->getDoctrine()->getManager();
        $em->persist($calendar);
        $em->flush();
return new \Symfony\Component\HttpFoundation\Response('Ok',$code=200);
    }else
    {
        return new \Symfony\Component\HttpFoundation\Response('donnée incomplete',404);
    }

    }


    public function CalendarAction(Request $request)
    {
        $Calendar = new Calendar();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(CalendarType::class, $Calendar);
        $form->handleRequest($request);
        $events = $em->getRepository("GarcicomBundle:Calendar")->findAll();
        $rdvs[]= [];

        foreach($events as $event){
            $rdvs[] = [
                'id'=>$event->getId(),
                'start'=>$event->getStart()->format('Y-m-d H:i'),
                'end'=>$event->getEnd()->format('Y-m-d H:i'),
                'title'=>$event->getTitle(),
                'description'=>$event->getDescription(),
                'backgroundColor'=>$event->getBackgroundcolor(),
                'borderColor'=>$event->getBorderColor(),
                'textColor'=>$event->getTextcolor(),

            ]
            ;
        }

        $data = json_encode($rdvs);
        return $this->render("GarcicomBundle:Calendar:Calendar.html.twig", compact('data'

            ));

    }
    public function addAction(Request $request){

        $calendar = new Calendar();
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($calendar);
            $em->flush();
            return $this->redirectToRoute('calendar');

        }
        return $this->render("GarcicomBundle:Calendar:AddCalendar.html.twig",
            array('form' => $form->createView()

            ));
    }
}
