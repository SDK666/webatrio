<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $BirthDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getBirthDate(): ?DateTime
    {
        return $this->BirthDate;
    }

    public function setBirthDate(DateTime $BirthDate): self
    {
        $from = new DateTime($BirthDate);
        $to   = new DateTime('today');
        if ($from->diff($to)->y < 150) {
            $this->BirthDate = $BirthDate;

            return $this;
        }

        return false;
    }
}
