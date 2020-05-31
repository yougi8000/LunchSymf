<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\RegistersuiteType;
use App\Form\UpdateProfileType;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration", methods={"GET","POST"})
     */
    public function registration(Request $request,
    UserPasswordEncoderInterface $encoder): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        $form= $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('register_suite', array(
                'id' => $user->getId()));
        };
        
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }


     /**
     * @Route("/registersuite/{id}", name="register_suite", methods={"GET","POST"})
     */
    public function registersuite(Request $request, User $user): Response
    {
        $form = $this->createForm(RegistersuiteType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        //code pour authentifier automatiquement mais qui ne marche pas
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->container->get('security.token_storage')->setToken($token);
        $this->container->get('session')->set('_security_login', serialize($token));
        //fin du code pour authentifier

            
            return $this->redirectToRoute('restaurant');
        }
        
        return $this->render('security/register_suite.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }


    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout() {}


    /**
     * Permet de modifier le mot de passe
     *
     * @Route("/account/password-update", name="account_password")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder) {
        $passwordUpdate = new PasswordUpdate();
        $manager = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // 1. Vérifier que le oldPassword du formulaire soit le même que le password de l'user
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())){
                // Gérer l'erreur
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel !"));
            } else {
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);

                $user->setPassword($hash);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe a bien été modifié !"
                );

                return $this->redirectToRoute('home');
            }
        }


        return $this->render('user/password.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * Permet d'afficher et de traiter le formulaire de modification de profil
     *
     * @Route("/account/update/profile", name="update_profile")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function profile(Request $request) {
        $user = $this->getUser();
        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm(UpdateProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les données du profil ont été enregistrée avec succès !"
            );
            return $this->redirectToRoute('account_index');
        }

        return $this->render('user/update-profile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le profil de l'utilisateur connecté
     *
     * @Route("/account", name="account_index")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function myAccount() {
        return $this->render('user/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    /**
     * Permet d'afficher le profil de l'utilisateur connecté
     *
     * @Route("/account/pro", name="account_pro")
     * @IsGranted("ROLE_PRO")
     * 
     * @return Response
     */
    public function myAccountPro() {
        return $this->render('user-pro/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }
    

}


