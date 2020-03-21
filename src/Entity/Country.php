<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iso;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CountryTranslation", mappedBy="country", orphanRemoval=true)
     */
    private $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function setIso(string $iso): self
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * @return Collection|CountryTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(CountryTranslation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setCountry($this);
        }

        return $this;
    }

    public function removeTranslation(CountryTranslation $translation): self
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getCountry() === $this) {
                $translation->setCountry(null);
            }
        }

        return $this;
    }
}
