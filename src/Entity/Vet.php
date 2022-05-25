<?php

namespace App\Entity;

use App\Repository\VetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VetRepository::class)
 * @ApiResource(
 *  itemOperations={"get"},
 *  collectionOperations={"get"}
 * )
 */
class Vet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("vet")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     * @Groups("vet")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=32)
     * @Groups("vet")
     */
    private $lastname;

    /**
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="vet_id")
     */
    private $animals;

    /**
     * @ORM\OneToMany(targetEntity=Visits::class, mappedBy="vet_id", orphanRemoval=true)
     */
    private $visits;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
        $this->visits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animals->contains($animal)) {
            $this->animals[] = $animal;
            $animal->setVetId($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getVetId() === $this) {
                $animal->setVetId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Visits>
     */
    public function getVisits(): Collection
    {
        return $this->visits;
    }

    public function addVisit(Visits $visit): self
    {
        if (!$this->visits->contains($visit)) {
            $this->visits[] = $visit;
            $visit->setVetId($this);
        }

        return $this;
    }

    public function removeVisit(Visits $visit): self
    {
        if ($this->visits->removeElement($visit)) {
            // set the owning side to null (unless already changed)
            if ($visit->getVetId() === $this) {
                $visit->setVetId(null);
            }
        }

        return $this;
    }
}
