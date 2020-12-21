<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pages;
use App\Entity\User;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\Type\UserType;
use Symfony\Component\Security\Core\Security;

class PagesController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',

        ]);
    }

    /**
     * @Route("/user/account", name="user_account")
     */
    public function userpage(): Response
    {
        // Get user data from DB - by default
        $login = $this->security->getUser()->getUsername();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findUserByLogin($login);

        return $this->render('pages/userpage.html.twig', [
            'controller_name' => 'PagesController',
            'username' => $user->getAccount(),
        ]);

    }

    /**
     * @Route("/user/profile", name="user_profile")
     */
    public function profile(Request $request): Response
    {
        // Get user data from DB - by default
        $login = $this->security->getUser()->getUsername();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findUserByLogin($login);

        $form = $this->createForm(UserType::class, $user);

        $successMessage = '';
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // The submitted values
            $task = $form->getData();

            $user->setAccount($task->getAccount());
            $user->setCountry($task->getCountry());
            $user->setCity($task->getCity());
            $user->setGender($task->getGender());
            $user->setAge($task->getAge());
            $user->setHeight($task->getHeight());
            $user->setBodytype($task->getBodytype());
            $user->setEthnicity($task->getEthnicity());
            $user->setPhone($task->getPhone());
            $user->setEmployment($task->getEmployment());
            $user->setSexuality($task->getSexuality());
            $user->setPrefer($task->getPrefer());
            $user->setPurpose($task->getPurpose());

            // Update user data in DB
            $entityManager->flush();

            $successMessage = 'Your data has been successfully saved.';
            //return $this->redirectToRoute('task_success');
        }

        return $this->render('pages/profile.html.twig', [
            'controller_name' => 'PagesController',
            'username' => $user->getAccount(),
            'user_form' => $form->createView(),
            'form_success' => $successMessage,
        ]);

    }

    /**
     * @Route("/pages", name="pages")
     */
    public function pages(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }


}
