<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pages;
use App\Entity\User;
use App\Entity\Profile;
use App\Repository\PagesRepository;
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
    public function homepage(AuthenticationUtils $authenticationUtils, PagesRepository $showRepository): Response
    {
        // Location IP
        $ip = $_SERVER['REMOTE_ADDR']; //'185.6.187.55';
        $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip. '?lang=en'));
        if($query && $query['status'] == 'success') {
            $country = $query['country'];
            $city = $query['city'];
        } else {
            $country = 'Unknown';
            $city = 'Unknown';
        }

        $page = $showRepository->find(1);
        $video = $showRepository->find(2);

        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
            'country' => $country,
            'city' => $city,
            'ip' => $ip,
            'hp_text' => $page->getBody(),
            'hp_video' => $video->getBody(),
        ]);
    }

    /**
     * @Route("/pages/{slug}", name="show_page")
     */
    public function pages($slug, PagesRepository $showRepository)
    {
        $show = $showRepository->findBySlug($slug);

        if (!$show) {
            throw $this->createNotFoundException(
                'No project found for slug ' . $slug
            );
        }

        return $this->render('pages/page.html.twig', [
            'page_title' => $show->getTitle(),
            'page_content' => $show->getBody(),
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
        $profile = $entityManager->getRepository(Profile::class)->findUserByEmail($login);
        if ($profile->getImageName() != '') $avatarImage = $profile->getImageName();
        else $avatarImage = 'avatar-default.png';
        $userID = sprintf ("%'.010d\n",$this->security->getUser()->getId());

        // Date
        $currentDate = date("Y-m-d H:i:s");
        $dateTime = \DateTime::createFromFormat("Y-m-d H:i:s", $currentDate);
        $formatDate = $dateTime->format("j F Y");
        $formatTime = $dateTime->format("H:i");

        // Location IP
        $ip = $_SERVER['REMOTE_ADDR']; //'185.6.187.55';
        $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip. '?lang=en'));
        if($query && $query['status'] == 'success') {
            $country = $query['country'];
            $city = $query['city'];
        } else {
            $country = 'Unknown';
            $city = 'Unknown';
        }

        return $this->render('pages/userpage.html.twig', [
            'controller_name' => 'PagesController',
            'username' => $profile->getUsername(),
            'avatar' => $avatarImage,
            'current_date' => $formatDate,
            'current_time' => $formatTime,
            'balance' => $profile->getBalance(),
            'user_id' => $userID,
            'country' => $country,
            'city' => $city,
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
        $profile = $entityManager->getRepository(Profile::class)->findUserByEmail($login);
        $userID = sprintf ("%'.010d\n",$this->security->getUser()->getId());

        // Date
        $currentDate = date("Y-m-d H:i:s");
        $dateTime = \DateTime::createFromFormat("Y-m-d H:i:s", $currentDate);
        $formatDate = $dateTime->format("j F Y");
        $formatTime = $dateTime->format("H:i");

        // Location IP
        $ip = $_SERVER['REMOTE_ADDR']; //'185.6.187.55';
        $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip. '?lang=en'));
        if($query && $query['status'] == 'success') {
            $country = $query['country'];
            $city = $query['city'];
        } else {
            $country = 'Unknown';
            $city = 'Unknown';
        }

        $form = $this->createForm(UserType::class, $profile);

        $successMessage = '';
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // The submitted values
            $task = $form->getData();

            $profile->setUsername($task->getUsername());
            $profile->setCountry($task->getCountry());
            $profile->setCity($task->getCity());
            $profile->setGender($task->getGender());
            $profile->setAge($task->getAge());
            $profile->setHeight($task->getHeight());
            $profile->setBodytype($task->getBodytype());
            $profile->setEthnicity($task->getEthnicity());
            $profile->setPhone($task->getPhone());
            $profile->setEmployment($task->getEmployment());
            $profile->setSexuality($task->getSexuality());
            $profile->setPrefer($task->getPrefer());
            $profile->setPurpose($task->getPurpose());
            $profile->setUpdatedAt(new \DateTime());

            // Update user data in DB
            $entityManager->flush();

            $successMessage = 'Your data has been successfully saved.';
            //return $this->redirectToRoute('task_success');
        }

        $profile = $entityManager->getRepository(Profile::class)->findUserByEmail($login);
        if ($profile->getImageName() != '') $avatarImage = $profile->getImageName();
        else $avatarImage = 'avatar-default.png';

        return $this->render('pages/profile.html.twig', [
            'controller_name' => 'PagesController',
            'username' => $profile->getUsername(),
            'avatar' => $avatarImage,
            'current_date' => $formatDate,
            'current_time' => $formatTime,
            'balance' => $profile->getBalance(),
            'user_id' => $userID,
            'country' => $country,
            'city' => $city,
            'user_form' => $form->createView(),
            'form_success' => $successMessage,
        ]);

    }

}
