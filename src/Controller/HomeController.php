<?php
/**
 * Created by PhpStorm.
 * User: abaidi
 * Date: 26/03/19
 * Time: 14:47
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name ="home_route")
     * @return Response
     */
 public function home() : Response{
     return $this->render('/home.html.twig');
 }
}