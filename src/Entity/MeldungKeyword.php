<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeldungKeywordRepository")
 */
class MeldungKeyword
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("meldungKeyword.meldungs")
     * @ORM\ManyToMany(targetEntity="App\Entity\Meldung", inversedBy="keywords")
     */
    private $meldungs;

    /**
     * @Groups("default")
     * @ORM\OneToMany(targetEntity="App\Entity\MeldungKeywordTranslation", mappedBy="keyword", orphanRemoval=true)
     */
    private $translations;

    public function __construct()
    {
        $this->meldungs = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * @return Collection|Meldung[]
     */
    public function getMeldungs(): Collection
    {
        return $this->meldungs;
    }

    public function addMeldung(Meldung $meldung): self
    {
        if (!$this->meldungs->contains($meldung)) {
            $this->meldungs[] = $meldung;
        }

        return $this;
    }

    public function removeMeldung(Meldung $meldung): self
    {
        if ($this->meldungs->contains($meldung)) {
            $this->meldungs->removeElement($meldung);
        }

        return $this;
    }

    /**
     * @return Collection|MeldungKeywordTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(MeldungKeywordTranslation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setKeyword($this);
        }

        return $this;
    }

    public function removeTranslation(MeldungKeywordTranslation $translation): self
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getKeyword() === $this) {
                $translation->setKeyword(null);
            }
        }

        return $this;
    }
}
