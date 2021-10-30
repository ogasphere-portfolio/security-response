<?php

namespace App\Controller\BackOffice;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/backoffice/category", name="backoffice_category_")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class CategoryController extends AbstractController
{

    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(CategoryRepository $categoryRepository): Response
    {
        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/category/browse.html.twig', [
            'category_list' => $categoryRepository->findAll()
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
            'category_form' => $categoryForm->createView(),
            'category' => $category,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Category $category): Response
    {
        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $category->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "Category `{$category->getName()}` udpated successfully");

            return $this->redirectToRoute('backoffice_category_browse');
        }

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/category/add.html.twig', [
            'category_form' => $categoryForm->createView(),
            'category' => $category,
            'page' => 'edit',
        ]);
    }
    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $category = new Category();

        // on créé un formulaire vierge (sans données initiales car l'objet fournit est vide)
        $categoryForm = $this->createForm(CategoryType::class, $category);

        // Après avoir été affiché le handleRequest nous permettra
        // de faire la différence entre un affichage de formulaire (en GET) 
        // et une soumission de formulaire (en POST)
        // Si un formulaire a été soumis, il rempli l'objet fournit lors de la création
        $categoryForm->handleRequest($request);

        // l'objet de formulaire a vérifié si le formulaire a été soumis grace au HandleRequest
        // l'objet de formulaire vérifie si le formulaire est valide (token csrf mais pas que)
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {

            // on ne demande l'entityManager que si on en a besoin
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($category);
            $entityManager->flush();

            // pour opquast 
            $this->addFlash('success', "Category `{$category->getName()}` created successfully");

            // redirection
            return $this->redirectToRoute('backoffice_category_browse');
        }

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/category/add.html.twig', [
            'category_form' => $categoryForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Category $category, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Category {$category->getId()} deleted");

        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_category_browse');
    }


}
