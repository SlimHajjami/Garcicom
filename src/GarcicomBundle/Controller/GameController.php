<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 25/05/2021
 * Time: 13:15
 */

namespace GarcicomBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class GameController extends Controller
{
    public function indexAction()
    {
        return $this->render("GarcicomBundle:Games:Snake.html.twig");
            }

}