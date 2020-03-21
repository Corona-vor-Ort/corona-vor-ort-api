<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PLZRepository")
 */
class PLZ
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
    private $plz;

    /**
     * @ORM\Column(type="integer")
     */
    private $kreisnummer;

    /**
     * @ORM\Column(type="string", length=63)
     */
    private $ort;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlz(): ?int
    {
        return $this->plz;
    }

    public function setPlz(int $plz): self
    {
        $this->plz = $plz;

        return $this;
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

    public function getOrt(): ?string
    {
        return $this->ort;
    }

    public function setOrt(string $ort): self
    {
        $this->ort = $ort;

        return $this;
    }
}
