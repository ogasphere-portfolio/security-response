<?php

namespace App\Controller\BackOffice;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/backoffice/user", name="backoffice_user_")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/", name="browse", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function browse(UserRepository $userRepository): Response
    {
        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/user/browse.html.twig', [
            'user_list' => $userRepository->findAll(),
            'controller_name' => 'BackOffice/UserController'
        ]);
    }

    /**
    * @Route("/api", name="api_browse", methods={"GET"})
    */
    public function api_browse(UserRepository $userRepository): Response
    {
        // on fournit ce formulaire à notre vue
        return $this->json($userRepository->findAll());
    }

    /**
     * @Route("/read/{id}", name="read", methods={"GET"}, requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER_READ")
     * */
    public function read(Request $request, User $user): Response
    {
        // on créé un formulaire avec l'objet récupéré
        // on modifie dynamiquement (dans le controleur) les options du formulaire
        // pour désactiver tous les champs
        $userForm = $this->createForm(UserType::class, $user, [
            'disabled' => 'disabled'
        ]);

        $userForm
            ->add('createdAt', null, [
            'widget' => 'single_text',
        ])
            ->add('updatedAt', null, [
            'widget' => 'single_text',
        ]);

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/user/read.html.twig', [
            'user_form' => $userForm->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER_EDIT")
     */
    public function edit(Request $request, User $user, UserPasswordHasherInterface $passwordHasher): Response
    {
        $userForm = $this->createForm(UserType::class, $user);

        $userForm->handleRequest($request);
// dd($userForm);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $user->setUpdatedAt(new DateTimeImmutable());

            $clearPassword = $request->request->get('user')['password']['first'];
            // si un mot de passe a été saisi
            if (! empty($clearPassword))
            {
                // hashage du mot de passe écrit en clair
                $hashedPassword = $passwordHasher->hashPassword($user, $clearPassword);
                $user->setPassword($hashedPassword);
            }
            // dd($user);
            $entityManager->flush();

            $this->addFlash('success', "User `{$user->getPseudo()}` udpated successfully");

            return $this->redirectToRoute('backoffice_user_browse');
        }

        // le champ mot de passe est différent en update et en ajout
        // on le rajoute au niveau du controleur
        $userForm
        ->remove('password')
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class, 
            'required' => false,

            // comme on veut appliquer des règles de gestion non standard
            // on précise à symfony que cette valeur ne correspond à aucun 
            // champ de notre objet
            //!\ il faudra gérer la valeur saisie dans le controleur
            'mapped' => false,
            'first_options'  => ['label' => 'Password'],
            'second_options' => ['label' => 'Repeat Password'],
        ]);

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/user/add.html.twig', [
            'user_form' => $userForm->createView(),
            'user' => $user,
            'page' => 'edit',
        ]);
    }
    /**
     * @Route("/add", name="add", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER_ADD")
     */
    public function add(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();

        // on créé un formulaire vierge (sans données initiales car l'objet fournit est vide)
        $userForm = $this->createForm(UserType::class, $user);

        // Après avoir été affiché le handleRequest nous permettra
        // de faire la différence entre un affichage de formulaire (en GET) 
        // et une soumission de formulaire (en POST)
        // Si un formulaire a été soumis, il rempli l'objet fournit lors de la création
        $userForm->handleRequest($request);


        // l'objet de formulaire a vérifié si le formulaire a été soumis grace au HandleRequest
        // l'objet de formulaire vérifie si le formulaire est valide (token csrf mais pas que)
        if ($userForm->isSubmitted() && $userForm->isValid()) {

            // on ne demande l'entityManager que si on en a besoin
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);

            // on récupère le mot de passe depuis le formulaire
            // car on a démappé le champ (c'est à dire que le formulaire ne le gère pas)
            $clearPassword = $request->request->get('user')['password']['first'];
            // si un mot de passe a été saisi
            if (! empty($clearPassword))
            {
                // hashage du mot de passe écrit en clair
                $hashedPassword = $passwordHasher->hashPassword($user, $clearPassword);
                $user->setPassword($hashedPassword);
            }

            $entityManager->flush();

            // pour opquast 
            $this->addFlash('success', "User `{$user->getPseudo()}` created successfully");

            // redirection
            return $this->redirectToRoute('backoffice_user_browse');
        }

        // on fournit ce formulaire à notre vue
        return $this->render('backoffice/user/add.html.twig', [
            'user_form' => $userForm->createView(),
            'page' => 'create',
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"GET"}, requirements={"id"="\d+"})
     * @IsGranted("ROLE_USER_DELETE")
     */
    public function delete(User $user, EntityManagerInterface $entityManager): Response
    {
        $this->addFlash('success', "User {$user->getId()} deleted");

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('backoffice_user_browse');
    }


}
