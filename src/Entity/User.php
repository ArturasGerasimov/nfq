<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"username", "surname"},
 *     errorPath="admin-page",
 *     message="This user already exist!",
 *     groups={"username_validation"}
 * )
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     * @Assert\Email
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $surname;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $hours;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $minutes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getHours(): ?string
    {
        return $this->hours;
    }

    public function setHours(?string $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getMinutes(): ?string
    {
        return $this->minutes;
    }

    public function setMinutes(?string $minutes): self
    {
        $this->minutes = $minutes;

        return $this;
    }
}
