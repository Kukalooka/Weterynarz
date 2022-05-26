<?php

namespace App\Entity;

use App\Repository\VisitsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VisitsRepository::class)
 * @ApiResource(
 *  itemOperations={"get"},
 *  collectionOperations={"get"}
 * )
 */
class Visits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("visits")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups("visits")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Vet::class, inversedBy="visits")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("visits")
     */
    private $vet_id;

    /**
     * @ORM\ManyToOne(targetEntity=Animal::class, inversedBy="visits")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("visits")
     */
    private $animal_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getVetId(): ?Vet
    {
        return $this->vet_id;
    }

    public function setVetId(?Vet $vet_id): self
    {
        $this->vet_id = $vet_id;

        return $this;
    }

    public function getAnimalId(): ?Animal
    {
        return $this->animal_id;
    }

    public function setAnimalId(?Animal $animal_id): self
    {
        $this->animal_id = $animal_id;

        return $this;
    }
}
