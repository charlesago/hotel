<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\ProfileType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{

    #[Route('/myprofile', name: 'app_profile')]
    public function index(UserRepository $userRepository): Response
    {
        $profile= $userRepository->findAll();
        return $this->render('profile/index.html.twig', [
            'profile'=>$profile,

        ]);
    }
    #[Route('/profile/update', name: 'update_profile')]
    public function update( Request $request, EntityManagerInterface $manager): response
    {
        $profile = $this->getUser()->getProfile();
        $formName = $this->createForm(ProfileType::class, $profile);
        $formName->handleRequest($request);
        if ($formName->isSubmitted() && $formName->isValid()) {


            $manager->persist($profile);
            $manager->flush();

            return $this->redirectToRoute("app_profile");
        }
        return $this->renderForm('profile/update.html.twig', [
            'formName'=>$formName

        ]);
    }



}
