<?php

namespace App\Controller;

use App\Entity\Contributor;
use App\Form\ContributorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContributorController extends AbstractController
{
    /**
     * Listing the user's information(s)
     * @Route("/contributor/index/{id}", name="contributor_index")
     * @param $id
     * @return Response
     */
    public function index($id)
    {
        $contributor = $this->getDoctrine()
                            ->getRepository(Contributor::class)
                            ->find($id);


                                                // voir les le document lie au contributor
                                                 //dump($contributor->getDocument());
        dump($contributor);

        if (!$contributor) {

            return $this->render('contributor/error.html.twig');

        }
        return $this->render('contributor/index.html.twig', [
            'contributor' => $contributor
        ]);
    }
    /**
     * Insert a new Contributor using a form
     * @Route("/contributor/create", name="contributor_create")
     */
    public function create(Request $request) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $contributor = new Contributor();
        $form = $this->createForm(ContributorType::class,$contributor);
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($contributor);
            $em->flush();
        }
        return $this->render('contributor/create.html.twig',[
                                    'form' => $form->createView()

                                 ]);
    }

    /**
     * @Route("/user/edit/{id}")
     */
    public function update($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contributor = $entityManager->getRepository(Contributor::class)->find($id);

        if (!$contributor) {
            throw $this->createNotFoundException(
                'No contributor found for id '.$id
            );
        }

        $contributor->setLogin('abaidik');
        $entityManager->flush();

        return $this->redirectToRoute('contributor_show', [
            'id' => $contributor->getId()
        ]);
    }
    /**
     * @Route("/user/remove/{id}")
     */
    public function remove($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contributor = $entityManager->getRepository(Contributor::class)->find($id);

        if (!$contributor) {
            throw $this->createNotFoundException(
                'No contributor found for id '.$id
            );
        }

        $entityManager->remove($contributor);
        $entityManager->flush();

        return new Response('contributor removed successfully');
    }
}