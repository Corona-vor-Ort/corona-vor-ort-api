<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeldungsreferenzRepository")
 */
class Meldungsreferenz
{
    /**
     * @Groups("default")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("meldungsreferenz.origin")
     * @ORM\OneToOne(targetEntity="App\Entity\Meldung", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $origin;

    /**
     * @Groups("meldungsreferenz.target")
     * @ORM\OneToOne(targetEntity="App\Entity\Meldung", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $target;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrigin(): ?Meldung
    {
        return $this->origin;
    }

    public function setOrigin(Meldung $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getTarget(): ?Meldung
    {
        return $this->target;
    }

    public function setTarget(Meldung $target): self
    {
        $this->target = $target;

        return $this;
    }
}
