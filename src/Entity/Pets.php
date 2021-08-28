<?php

namespace App\Entity;

use App\Repository\PetsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PetsRepository::class)
 */
class Pets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $pet_type_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $gender;

    /**
     * @ORM\Column(type="integer")
     */
    private $breed_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $client_id;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="client_id")
     */
    private $client_id_relation;

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

    public function getPetTypeId(): ?int
    {
        return $this->pet_type_id;
    }

    public function setPetTypeId(int $pet_type_id): self
    {
        $this->pet_type_id = $pet_type_id;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBreedId(): ?int
    {
        return $this->breed_id;
    }

    public function setBreedId(int $breed_id): self
    {
        $this->breed_id = $breed_id;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getClientId(): ?int
    {
        return $this->client_id;
    }

    public function setClientId(?int $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getClientIdRelation(): ?Clients
    {
        return $this->client_id_relation;
    }

    public function setClientIdRelation(?Clients $client_id_relation): self
    {
        $this->client_id_relation = $client_id_relation;

        return $this;
    }
}
