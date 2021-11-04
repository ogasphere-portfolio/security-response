<?php

namespace App\Controller\BackOffice;

use App\Entity\SocialNetwork;
use App\Form\SocialNetworkType;
use App\Repository\SocialNetworkRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/backoffice/socialNetwork", name="backoffice_socialNetwork_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class SocialNetworkController extends AbstractController
{

    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(SocialNetworkRepository $socialNetworkRepository): Response
    {

        return $this->render('backoffice/socialNetwork/browse.html.twig', [
            'socialNetwork_browse' => $socialNetworkRepository->findAll(),
            'controller_name' => 'BackOffice/SocialNetworkController'
        ]);
    }

    /**
     * @Route("/{id}/read", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Request $request, SocialNetwork $socialNetwork): Response
    {

        $socialNetworkForm = $this->createForm(SocialNetworkType::class, $socialNetwork, [
            'disabled' => 'disabled'
        ]);

        $socialNetworkForm
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ]);

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/socialNetwork/read.html.twig', [
            'form' => $socialNetworkForm->createView(),
            'socialNetwork' => $socialNetwork,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, SocialNetwork $socialNetwork): Response
    {
        $socialNetworkForm = $this->createForm(SocialNetworkType::class, $socialNetwork);

        $socialNetworkForm->handleRequest($request);

        if ($socialNetworkForm->isSubmitted() && $socialNetworkForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $socialNetwork->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "SocialNetwork `{$socialNetwork->getName()}` udpated successfully");

            return $this->redirectToRoute('backoffice_socialNetwork_browse');
        }


        return $this->render('backoffice/socialNetwork/add.html.twig', [
            'form' => $socialNetworkForm->createView(),
            'socialNetwork' => $socialNetwork,
            'page' => 'edit',
        ]);
    }
    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $socialNetwork = new SocialNetwork();


        $socialNetworkForm = $this->createForm(SocialNetworkType::class, $socialNetwork);


        $socialNetworkForm->handleRequest($request);


        if ($socialNetworkForm->isSubmitted() && $socialNetworkForm->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($socialNetwork);
            $entityManager->flush();


            $this->addFlash('success', "SocialNetwork {$socialNetwork->getName()} created successfully");


            return $this->redirectToRoute('backoffice_socialNetwork_browse');
        }


        return $this->render('backoffice/socialNetwork/add.html.twig', [
            'form' => $socialNetworkForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(SocialNetwork $socialNetwork, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "SocialNetwork {$socialNetwork->getId()} deleted");

        $entityManager->remove($socialNetwork);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_socialNetwork_browse');
    }
}
