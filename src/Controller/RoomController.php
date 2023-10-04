<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Room;
use App\Form\ImageType;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    #[Route('/', name: 'app_room')]
    public function index(RoomRepository $repository): Response
    {


        return $this->render('room/index.html.twig', [
            'rooms' => $repository->findAll(),


        ]);
    }
    #[Route('/show/{id}', name: 'show_room')]
    public function show(Room $room): Response
    {


        return $this->renderForm('room/show.html.twig', [
            'room' => $room,
        ]);
    }

    #[Route('/admin/create/', name: 'create_room')]
    #[Route('/update/{id}', name: 'update_room')]
    public function create(Room $room = null, Request $request, EntityManagerInterface $manager,): response
    {
        $edit = false;

        if ($room) {
            $edit = true;
        }
        if (!$edit) {
            $room = new Room();
        }

        $formRoom = $this->createForm(RoomType::class, $room);
        $formRoom->handleRequest($request);
        if ($formRoom->isSubmitted() && $formRoom->isValid()) {

            $manager->persist($room);
            $manager->flush();

            return $this->redirectToRoute('app_room');
        }
        return $this->renderForm('room/create.html.twig', [
            'formRoom' => $formRoom,
        ]);

    }
}
