<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Equipement;
use App\Entity\Image;
use App\Entity\Room;
use App\Form\BookingType;
use App\Form\ImageType;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use DateTime;
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
    public function show(Room $room, Equipement $equipement): Response
    {


        return $this->renderForm('room/show.html.twig', [
            'room' => $room,
            'equipement'=>$equipement
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

    #[Route("/book/{id}")]
    public function book(Room $room, Request $request, EntityManagerInterface $manager):Response{

        $book = new Booking();
        $bookForm = $this->createForm(BookingType::class, $book);
        $bookForm->handleRequest($request);
        if ($bookForm->isSubmitted() && $bookForm->isValid()){

            $book->setRoom($room);
            $book->setNumberOfNights($book->getLeavingDate()->getTimestamp()-$book->getArrivedDate()->getTimestamp());
            $book->setOfUser($this->getUser());

            $day1 = $book->getLeavingDate()->format("d");
            $day2 = $book->getArrivedDate()->format("d");
            $month1 = $book->getLeavingDate()->format("m");
            $month2 = $book->getArrivedDate()->format("m");
            $year1 = $book->getLeavingDate()->format("Y");
            $year2 = $book->getArrivedDate()->format("Y");

            $sqlData1=$day1 . "." . $month1 . "." . $year1;
            $sqlData2=$day2 . "." . $month2 . "." . $year2;


            $local1=new DateTime($sqlData1);
            $local2=new DateTime($sqlData2);

            $interval = $local1->diff($local2);

            $book->setNumberOfNights($interval->days);

            $manager->persist($book);
            $manager->flush();



            return $this->redirectToRoute("show_room",[
                "id"=>$room->getId()
            ]);
        }


        return $this->render("room/book.html.twig",[
            "bookForm"=>$bookForm->createView()
        ]);
    }

}
