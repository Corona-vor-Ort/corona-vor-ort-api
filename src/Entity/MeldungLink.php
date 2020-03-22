<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeldungLinkRepository")
 */
class MeldungLink
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Meldung", inversedBy="meldungLinks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $meldung;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=2048)
     */
    private $link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeldung(): ?Meldung
    {
        return $this->meldung;
    }

    public function setMeldung(?Meldung $meldung): self
    {
        $this->meldung = $meldung;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
