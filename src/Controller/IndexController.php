<?php
/**
 * Created by PhpStorm.
 * User: abaidi
 * Date: 26/03/19
 * Time: 13:27
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController  extends AbstractController
{
    /**
     * @Route("/connexion", name="index_route")
     * @return Response
     */
    public function index() : Response{
        return  $this->render('/index.html.twig');
    }

}