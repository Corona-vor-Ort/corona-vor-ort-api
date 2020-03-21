<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkKreiseMeldungenRepository")
 */
class LinkKreiseMeldungen
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
     * @ORM\Column(type="integer")
     */
    private $meldung_id;

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

    public function getMeldungId(): ?int
    {
        return $this->meldung_id;
    }

    public function setMeldungId(int $meldung_id): self
    {
        $this->meldung_id = $meldung_id;

        return $this;
    }
}
