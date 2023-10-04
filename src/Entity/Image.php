<?php


namespace App\Entity;


use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[Vich\Uploadable]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[Vich\UploadableField(mapping: 'appimages', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;


    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;


    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;


    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'image', targetEntity: Room::class)]
    private Collection $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }




    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;


        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }


    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }


    public function getImageName(): ?string
    {
        return $this->imageName;
    }


    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }


    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function setRooms(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }
    public function addRoom(Room $room): static
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
            $room->setImage($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): static
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getImage() === $this) {
                $room->setImage(null);
            }
        }

        return $this;
    }

    /**
     * @param Collection $rooms
     * @return Image
     */



}

