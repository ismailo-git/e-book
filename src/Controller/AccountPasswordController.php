<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AccountPasswordController extends AbstractController
{   
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
    
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/account/password", name="account_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {   
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
            $old_pwd = $form->get('old_password')->getData();
            
            if ($encoder->isPasswordValid($user, $old_pwd)) {
                $new_pwd = $form->get('new_password')->getData();
                 $password = $encoder->encodePassword($user, $new_pwd);

                $user->getPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }

        }
        return $this->render('account/password.html.twig', [

            'form' => $form->createView()
        ]);
    }
}
