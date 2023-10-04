<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Room;
use App\Form\ImageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/{id}', name: 'app_image_index')]
    public function index(Room $room): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);

        return $this->renderForm('image/index.html.twig', [
            'room' => $room,
            'form' => $form
        ]);
    }

    #[Route('addtoroom/{id}', name: 'app_image_room_add')]
    public function addImage(Room $room, Request $request, EntityManagerInterface $manager): Response
    {

        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

                $image->addRoom($room);
                $manager->persist($image);
                $manager->flush();

        }

        return $this->redirectToRoute('app_image_index', ['id' => $room->getId()]);


    }
}
