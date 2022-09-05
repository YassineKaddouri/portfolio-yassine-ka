<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{

    /**
     * @Route("/Inscription", name="security_inscription")
     */
    public function Inscription(Request $request,EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder){
        $user =new User();
        $form=$this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $hash= $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }
        return $this->render('security/Inscription.html.twig',
            ['form'=>$form->createView()]);
    }
    /**
     * @Route("/Connexion", name="security_login")
     */

    public function login(AuthenticationUtils $authentication)
    {
        return $this->render('security/Login.html.twig',[


        ]);

    }
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){

    }
}
