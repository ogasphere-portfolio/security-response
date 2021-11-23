<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SendMailService;
use Symfony\Component\HttpFoundation\Request;



class MainController extends AbstractController
{
    /**
     * Home page
     * 
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * 
     * 
     * @Route("/team", name="team")
     */
    public function team(): Response
    {
        return $this->render('main/team.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * 
     * 
     * @Route("/mentions-legales", name="mentions_legales")
     */
    public function mentionLegales(): Response
    {
        return $this->render('main/mentionLegales.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * 
     * @Route("/contact", name="contact")
     * 
     */
    public function contact(Request $request, SendMailService $sendMailService): Response
    {
        $formContact = $this->createForm();
        $formContact->handleRequest($request)

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $data = $formContact->getData();
            
            $sendMailService->send(
                subject: "Nouveau message",
                from: "cskyzr@hotmail.com",
                to : "cskyzr@hotmail.com",
                template: "main/contact.html.twig",
                [
                    "name" => $data['name'],
                    "email" => $data['email'],
                    "phone" => $data['phone'],
                    "description" => $data['description']
                ]
                
            );

            $this->addFlash('success', "Votre message a bien été envoyé");

            return $this->redirectToRoute('contact');
        }

        return $this->render('main/contact.html.twig', [
            'formContact' => $formContact->creatView(),
        ]);
    }
}