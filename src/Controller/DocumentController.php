<?php

namespace App\Controller;

use App\Entity\Document;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentController extends AbstractController
{
    /**
     * @Route("/document", name="document")
     */
    public function index()
    {
        return $this->render('document/index.html.twig', [
            'controller_name' => 'DocumentController',
        ]);
    }
    /**
     * @Route("/document/add", name="document_add")
     */
    public function add() : Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $document = new Document();

        $document->setDoi('10-45878524')
            ->setTitle('recherche academique')
            ->setModificationDate(new \DateTime('now'));
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($document);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new document with id '.$document->getId());
    }
    /**
     * @Route("/document/{id}", name="document_show")
     */
    public function show($id) : Response
    {
        $document = $this->getDoctrine()
            ->getRepository(Document::class)
            ->find($id);

        if (!$document) {

            throw $this->createNotFoundException(
                'No document for  id '.$id
            );

        }

        return new Response('Check out this great contributor: '.$document->getLogin());
    }
    /**
     * @Route("/document/edit/{id}")
     */
    public function update($id) : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $document = $entityManager->getRepository(Document::class)->find($id);

        if (!$document) {
            throw $this->createNotFoundException(
                'No document found for id '.$id
            );
        }

        $document->setDoi('10-8566665');
        $entityManager->flush();

        return $this->redirectToRoute('document_show', [
            'id' => $document->getId()
        ]);
    }
    /**
     * @Route("/document/remove/{id}")
     */
    public function remove($id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $document = $entityManager->getRepository(Document::class)->find($id);

        if (!$document) {
            throw $this->createNotFoundException(
                'No document found for id '.$id
            );
        }

        $entityManager->remove($document);
        $entityManager->flush();

        return new Response('document removed successfully');
    }
}
