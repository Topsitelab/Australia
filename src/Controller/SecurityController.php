<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(Request $request,AuthenticationUtils $authenticationUtils): Response
    {
        if (isset($request->request)) {
            // Get the login error if there is one
            if (null !== $error = $authenticationUtils->getLastAuthenticationError(true)) {
                $error_message = $error->getMessageKey();
                // Return status for ajax
                return $this->json([
                    'status' => 'ERROR',
                    'error_message' => $error_message,

                ]);
            }
            // Success
            else {
                // Return status for ajax
                return $this->json([
                    'status' => 'OK',

                ]);
            }
        }
        // Return status for ajax
        return $this->json([
            'status' => 'ERROR',

        ]);
    }

    /*public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }*/

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        // Go to the Homepage
        //return $this->redirectToRoute('homepage');
        //throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/registration", name="app_registration")
     */
    public function ajaxReg(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        if (isset($request->request)) {
            // Get data from ajax
            $username = trim($request->request->get('username'));
            $email = trim($request->request->get('email'));
            $password = trim($request->request->get('password'));
            $password2 = trim($request->request->get('password2'));
            // Errors check
            $error_username = $error_email = $error_password = $error_password2 = '';
            if ($username == '') $error_username = 'Enter your name';
            if ($email == '') $error_email = 'Enter your email';
            if ($password == '') $error_password = 'Enter password';
            if ($password2 != $password) $error_password2 = 'Passwords must match';
            // Success
            if ($error_username == '' and $error_email == '' and $error_password == '' and $error_password2 == '') {
                // Insert new user in DB
                $entityManager = $this->getDoctrine()->getManager();
                $user = new User();

                $role = ["ROLE_USER"];
                //$role = ["ROLE_ADMIN"];
                $encoded = $encoder->encodePassword($user, $password);

                $user->setAccount($username);
                $user->setEmail($email);
                $user->setPassword($encoded);
                $user->setRoles($role);
                $user->setCreatedAt(new \DateTime());

                $byDefaultString = '';
                $byDefaultNum = 0;
                $user->setCountry($byDefaultString);
                $user->setCity($byDefaultString);
                $user->setGender($byDefaultString);
                $user->setAge(18);
                $user->setHeight(155);
                $user->setBodytype($byDefaultString);
                $user->setEthnicity($byDefaultString);
                $user->setPhone($byDefaultString);
                $user->setEmployment($byDefaultString);
                $user->setSexuality($byDefaultString);
                $user->setPrefer($byDefaultString);
                $user->setPurpose($byDefaultString);
                $user->setBalance($byDefaultNum);
                $user->setStatus('active');
                $user->setVip('free');

                $entityManager->persist($user);

                $entityManager->flush();

                // Return status for ajax
                return $this->json([
                    'status' => 'OK',

                ]);
            }
            // Error
            else {
                return $this->json([
                    'status' => 'ERROR',
                    'error_username' => $error_username,
                    'error_email' => $error_email,
                    'error_password' => $error_password,
                    'error_password2' => $error_password2,

                ]);
            }
        }
        // Return status for ajax
        return $this->json([
            'status' => 'ERROR',

        ]);

    }
}
