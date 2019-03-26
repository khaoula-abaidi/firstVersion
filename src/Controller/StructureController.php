<?php

namespace App\Controller;

use App\Entity\Structure;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StructureController extends AbstractController
{
    /**
     * @Route("/structure", name="structure")
     */
    public function index()
    {
        return $this->render('structure/index.html.twig', [
            'controller_name' => 'StructureController',
        ]);
    }
    /**
     * @Route("/structure/add", name="structure_add")
     */
    public function add() : Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $structure = new Structure();

        $structure->setSigle('CCSD')
            ->setUrl('ccsc.cnrs.fr')
            ->setPays('France')
            ->setAdressePostale('28 rue Louis Guérin Villeurbanne 69100');
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($structure);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new structure with id '.$structure->getId());
    }
    /**
     * @Route("/structure/{id}", name="structure_show")
     */
    public function show($id) : Response
    {
        $structure = $this->getDoctrine()
            ->getRepository(Structure::class)
            ->find($id);

        if (!$structure) {

            throw $this->createNotFoundException(
                'No structure for  id '.$id
            );

        }

        return new Response('Check out this great structure : '.$structure->getSigle());
    }
    /**
     * @Route("/structure/edit/{id}")
     */
    public function update($id) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $structure = $entityManager->getRepository(Structure::class)->find($id);

        if (!$structure) {
            throw $this->createNotFoundException(
                'No structure found for id '.$id
            );
        }

        $structure->setSigle('Centre de Communication Scientifique Directe');
        $entityManager->flush();

        return $this->redirectToRoute('structure_show', [
            'id' => $structure->getId()
        ]);
    }
    /**
     * @Route("/structure/remove/{id}")
     */
    public function remove($id) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $structure = $entityManager->getRepository(Structure::class)->find($id);

        if (!$structure) {
            throw $this->createNotFoundException(
                'No structure found for id '.$id
            );
        }

        $entityManager->remove($structure);
        $entityManager->flush();

        return new Response('structure removed successfully');
    }
}
