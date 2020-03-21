<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BundeslandRepository")
 */
class Bundesland
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
    private $bundesland_id;

    /**
     * @ORM\Column(type="string", length=63)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBundeslandId(): ?int
    {
        return $this->bundesland_id;
    }

    public function setBundeslandId(int $bundesland_id): self
    {
        $this->bundesland_id = $bundesland_id;

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
}
