<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



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
     * 
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * 
     * 
     * @Route("/404", name="404")
     */
    public function error404(): Response
    {
       
        return $this->render('main/error404.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
   

}