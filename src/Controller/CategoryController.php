<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
     * @Route("/categories", name="category_")
     */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(): Response
    {
        return $this->render('category/browse.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/read/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Request $request, Category $category): Response
    {
        // on créé un formulaire avec l'objet récupéré
        // on modifie dynamiquement (dans le controleur) les options du formulaire
        // pour désactiver tous les champs
        $categoryForm = $this->createForm(CategoryType::class, $category, [
            'disabled' => 'disabled'
        ]);

        $categoryForm
            ->add('createdAt', null, [
            'widget' => 'single_text',
        ])
            ->add('updatedAt', null, [
            'widget' => 'single_text',
        ]);

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/category/read.html.twig', [
            'form' => $categoryForm->createView(),
            'category' => $category,
        ]);
    }
}
