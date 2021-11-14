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
        // $user =$this->getUser();
        // // dd($user->getUserMember());
        // if (!empty($user->getUserMember())) {
        //     // dd($user);
        //     $role = ['ROLE_MEMBER'];
        //     $user->setRoles($role);
        // }
        
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
     * @Route("/404", name="404")
     */
    public function error404(): Response
    {
        return $this->render('main/error404.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
   

}