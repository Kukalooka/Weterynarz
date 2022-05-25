<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 * @ApiResource(
 *  itemOperations={"get"},
 *  collectionOperations={"get"}
 * )
 */

class Animal
{
    /**
     * @Groups("animal")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("animal")
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @Groups("animal")
     * @ORM\Column(type="string", length=32)
     */
    private $species;

    /**
     * @Groups("animal")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\ManyToOne(targetEntity=Owner::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("ownerPlug")
     */
    private $owner_id;

    /**
     * @ORM\ManyToOne(targetEntity=Vet::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("vetPlug")
     */
    private $vet_id;

    /**
     * @ORM\OneToMany(targetEntity=Visits::class, mappedBy="animal_id", orphanRemoval=true)
     */
    private $visits;

    public function __construct()
    {
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

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getOwnerId(): ?Owner
    {
        return $this->owner_id;
    }

    public function setOwnerId(?Owner $owner_id): self
    {
        $this->owner_id = $owner_id;

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
            $visit->setAnimalId($this);
        }

        return $this;
    }

    public function removeVisit(Visits $visit): self
    {
        if ($this->visits->removeElement($visit)) {
            // set the owning side to null (unless already changed)
            if ($visit->getAnimalId() === $this) {
                $visit->setAnimalId(null);
            }
        }

        return $this;
    }
}
