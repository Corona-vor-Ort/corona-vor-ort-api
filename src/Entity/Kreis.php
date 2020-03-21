<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KreisRepository")
 */
class Kreis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $kreisnummer;

    /**
     * @ORM\Column(type="string", length=63)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $bundesland;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKreisnummer(): ?int
    {
        return $this->kreisnummer;
    }

    public function setKreisnummer(int $kreisnummer): self
    {
        $this->kreisnummer = $kreisnummer;

        return $this;
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

    public function getBundesland(): ?int
    {
        return $this->bundesland;
    }

    public function setBundesland(int $bundesland): self
    {
        $this->bundesland = $bundesland;

        return $this;
    }
}
