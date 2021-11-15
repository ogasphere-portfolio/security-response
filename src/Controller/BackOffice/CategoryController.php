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

        return $this->render('backoffice/category/browse.html.twig', [
            'category_list' => $categoryRepository->findAll(),
           
        ]);
    }

    /**
     * @Route("/{id}/read", name="read", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function read(Request $request, Category $category): Response
    {

        $categoryForm = $this->createForm(CategoryType::class, $category, [
            'disabled' => 'disabled'
        ]);

        
        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/category/read.html.twig', [
            'form' => $categoryForm->createView(),
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, Category $category): Response
    {
        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $category->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            $this->addFlash('success', "Category {$category->getName()} udpated successfully");

            return $this->redirectToRoute('backoffice_category_browse');
        }


        return $this->render('backoffice/category/add.html.twig', [
            'form' => $categoryForm->createView(),
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


        $categoryForm = $this->createForm(CategoryType::class, $category);


        $categoryForm->handleRequest($request);


        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($category);
            $entityManager->flush();


            $this->addFlash('success', "Category `{$category->getName()}` created successfully");


            return $this->redirectToRoute('backoffice_category_browse');
        }


        return $this->render('backoffice/category/add.html.twig', [
            'form' => $categoryForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function delete(Category $category, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "Category {$category->getName()} deleted");

        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_category_browse');
    }
}
