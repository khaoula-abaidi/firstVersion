<?php

namespace App\Controller;

use App\Entity\Contributor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContributorController extends AbstractController
{
    /**
     * @Route("/contributor", name="contributor")
     */
    public function index()
    {
        return $this->render('contributor/index.html.twig', [
            'controller_name' => 'ContributorController',
        ]);
    }
    /**
     * @Route("/contributor/add", name="contributor_add")
     */
    public function add() : Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $contributor = new Contributor();

        $contributor->setLogin('khaoula')
            ->setPwd('abaidi')
            ->setIsAdmin(false);
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($contributor);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new contributor with id '.$contributor->getId());
    }
    /**
     * @Route("/contributor/{id}", name="contributor_show")
     */
    public function show($id) : Response
    {
        $contributor = $this->getDoctrine()
            ->getRepository(Contributor::class)
            ->find($id);

        if (!$contributor) {

            throw $this->createNotFoundException(
                'No contributor for  id '.$id
            );

        }

        return new Response('Check out this great contributor: '.$contributor->getLogin());
    }
    /**
     * @Route("/contributor/edit/{id}")
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
     * @Route("/contributor/remove/{id}")
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