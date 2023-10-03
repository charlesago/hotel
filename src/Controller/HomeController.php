<?php

namespace App\Controller;

use App\Repository\HomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(HomeRepository $homeRepository): Response
    {
        $rooms = $homeRepository->findAll();
        return $this->render('home/index.html.twig', [
            'rooms'=>$rooms,

        ]);
    }
}
