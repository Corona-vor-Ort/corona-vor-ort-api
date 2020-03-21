<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkMeldungenKategorienRepository")
 */
class LinkMeldungenKategorien
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
    private $meldung_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $kategorie_id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getKategorieId(): ?int
    {
        return $this->kategorie_id;
    }

    public function setKategorieId(int $kategorie_id): self
    {
        $this->kategorie_id = $kategorie_id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
