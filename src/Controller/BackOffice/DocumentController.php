<?php

namespace App\Controller\BackOffice;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Repository\DocumentRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/backoffice/document", name="backoffice_document_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class DocumentController extends AbstractController
{

    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(DocumentRepository $documentRepository): Response
    {

        return $this->render('backoffice/document/browse.html.twig', [
            'document_browse' => $documentRepository->findAll(),
            'controller_name' => 'BackOffice/DocumentController'
        ]);
    }

    /**
     * @Route("/id}/read", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Request $request, Document $document): Response
    {

        $documentForm = $this->createForm(DocumentType::class, $document, [
            'disabled' => 'disabled'
        ]);

        $documentForm
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ]);

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/document/read.html.twig', [
            'form' => $documentForm->createView(),
            'document' => $document,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Document $document): Response
    {
        $documentForm = $this->createForm(DocumentType::class, $document);

        $documentForm->handleRequest($request);

        if ($documentForm->isSubmitted() && $documentForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $document->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "Document `{$document->getTitle()}` udpated successfully");

            return $this->redirectToRoute('backoffice_document_browse');
        }


        return $this->render('backoffice/document/add.html.twig', [
            'form' => $documentForm->createView(),
            'document' => $document,
            'page' => 'edit',
        ]);
    }
    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $document = new Document();


        $documentForm = $this->createForm(DocumentType::class, $document);


        $documentForm->handleRequest($request);


        if ($documentForm->isSubmitted() && $documentForm->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($document);
            $entityManager->flush();


            $this->addFlash('success', "Document {$document->getTitle()} created successfully");


            return $this->redirectToRoute('backoffice_document_browse');
        }


        return $this->render('backoffice/document/add.html.twig', [
            'form' => $documentForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Document $document, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Document {$document->getId()} deleted");

        $entityManager->remove($document);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_document_browse');
    }
}
