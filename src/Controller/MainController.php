<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SendMailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

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
    public function contact(Request $request, SendMailService $mail): Response
    {
        
        $form = $this->createForm(ContactType::class);

        $contact = $form->handleRequest($request);       
        
        if($form->isSubmitted() && $form->isValid()){
            $context = [
                'name' => $contact->get('name')->getData(),
                'mail' => $contact->get('email')->getData(),
                'phone' => $contact->get('phone')->getData(),
                'message' => $contact->get('message')->getData(),
            ];
            $mail->send(
                $contact->get('email')->getData(),
                'contact@security-response.fr',
                'Security Response - Contact',
                'contact',
                $context
            );
            
            // accusé réception
            $mail->send(
                'contact@security-response.fr',
                $contact->get('email')->getData(),
                "Security Response - Nous avons bien reçu votre message",
                'message_confirmation',
                $context
            );
            
            $this->addFlash('success', 'Vore message a bien été envoyé');
            return $this->redirectToRoute('contact');
         
        }

        return $this->render('main/contact.html.twig', [
            'contact_form' => $form->createView()
        ]);
    
    }
}