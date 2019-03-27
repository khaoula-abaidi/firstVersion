<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentController extends AbstractController
{
    /**
     * Listing document's information(s)
     * @Route("/document/index/{id}", name="document_index")
     */
    public function index($id)
    {
        $document = $this->getDoctrine()
            ->getRepository(Document::class)
            ->find($id);

        if (!$document) {

            return $this->render('document/error.html.twig');

        }
        return $this->render('document/index.html.twig', [
            'document' => $document
        ]);
    }
    /**
     * Insert a new Document using a form
     * @Route("/document/create", name="document_create")
     */
    public function create(Request $request) : Response
    {

        $em = $this->getDoctrine()->getManager();

        $document = new Document();

        $form = $this->createForm(DocumentType::class,$document);
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($document);
            $em->flush();
        }
        return $this->render('document/create.html.twig',[
            'form' => $form->createView()
        ]);

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
