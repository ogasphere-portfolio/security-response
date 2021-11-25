<?php

namespace App\Controller;

use App\Form\ForgotPasswordType;
use App\Repository\UserRepository;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class ForgotPasswordController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    private SessionInterface $session;

    private UserRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/forgot/password", name="app_forgot_password", methods={"GET", "POST"})
     */
    public function sendRecoveryLink(Request $request, SendMailService $sendEmail, TokenGeneratorInterface $tokenGenerator): Response
    {
        $form = $this->createForm(ForgotPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->userRepository->findOneBy([
                'email' => $form['email']->getData()
            ]);

            /* We make a lure. */
            if (!$user) {
                $this->addFlash('success', 'Un email vous a été envoyé pour redéfinir votre mot de passe.');

                return $this->redirectToRoute('app_login');
            }

            $user->setForgotPasswordToken($tokenGenerator->generateToken())
                 ->setForgotPasswordTokenRequestedAt(new \DataTimeImmutable('now'))
                 ->setForgotPasswordTokenMustBeVerifiedBefore(new \DataTimeImmutable('+15 minutes'));
                 
            $this->entityManager->flush();

            $sendEmail->send([
                'recipient_email' => $user->getEmail(),
                'subject'         => 'Modification de votre mot de passe',
                'html_template'   => 'forgot_password/forgot_password_email.html.twig',
                'context'         => [
                    'user' => $user
                ]
                ]);

                $this->addFlash('success', 'Un email vous a été envoyé pour redéfinir votre mot de passe.');

                return $this->redirectToRoute('app_login');
        }

        return $this->render('forgot_password/forgot_password_step_1.html.twig', [
            'forgotPasswordFormStep1' => $form->createView(),
        ]);
    }
}
