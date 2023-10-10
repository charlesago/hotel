<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $arrivedDate = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $leavingDate = null;

    #[ORM\Column()]
    private ?int $numberOfNights = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $room = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ofUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrivedDate(): ?\DateTimeImmutable
    {
        return $this->arrivedDate;
    }

    public function setArrivedDate(?\DateTimeImmutable $arrivedDate): static
    {
        $this->arrivedDate = $arrivedDate;

        return $this;
    }

    public function getLeavingDate(): ?\DateTimeImmutable
    {
        return $this->leavingDate;
    }

    public function setLeavingDate(?\DateTimeImmutable $leavingDate): static
    {
        $this->leavingDate = $leavingDate;

        return $this;
    }

    public function getNumberOfNights(): ?int
    {
        return $this->numberOfNights;
    }

    public function setNumberOfNights(?int $numberOfNights): static
    {
        $this->numberOfNights = $numberOfNights;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): static
    {
        $this->room = $room;

        return $this;
    }

    public function getOfUser(): ?User
    {
        return $this->ofUser;
    }

    public function setOfUser(?User $ofUser): static
    {
        $this->ofUser = $ofUser;

        return $this;
    }
}
