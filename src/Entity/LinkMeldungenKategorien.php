<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkMeldungenKategorienRepository")
 */
class LinkMeldungenKategorien
{
    /**
     * @Groups("default")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("default")
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Groups("linkMeldungenKategorien.meldung")
     * @ORM\OneToOne(targetEntity="App\Entity\Meldung", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $meldung_id;

    /**
     * @Groups("linkMeldungenKategorien.kategorie")
     * @ORM\OneToOne(targetEntity="App\Entity\Kategorie", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $kategorie_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMeldungId(): ?Meldung
    {
        return $this->meldung_id;
    }

    public function setMeldungId(Meldung $meldung_id): self
    {
        $this->meldung_id = $meldung_id;

        return $this;
    }

    public function getKategorieId(): ?Kategorie
    {
        return $this->kategorie_id;
    }

    public function setKategorieId(Kategorie $kategorie_id): self
    {
        $this->kategorie_id = $kategorie_id;

        return $this;
    }
}
