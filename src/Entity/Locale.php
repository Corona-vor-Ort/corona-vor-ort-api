<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocaleRepository")
 */
class Locale
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iso;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CountryTranslation", mappedBy="locale", orphanRemoval=true)
     */
    private $countryTranslations;

    public function __construct()
    {
        $this->countryTranslations = new ArrayCollection();
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
    public function getCountryTranslations(): Collection
    {
        return $this->countryTranslations;
    }

    public function addCountryTranslation(CountryTranslation $countryTranslation): self
    {
        if (!$this->countryTranslations->contains($countryTranslation)) {
            $this->countryTranslations[] = $countryTranslation;
            $countryTranslation->setLocale($this);
        }

        return $this;
    }

    public function removeCountryTranslation(CountryTranslation $countryTranslation): self
    {
        if ($this->countryTranslations->contains($countryTranslation)) {
            $this->countryTranslations->removeElement($countryTranslation);
            // set the owning side to null (unless already changed)
            if ($countryTranslation->getLocale() === $this) {
                $countryTranslation->setLocale(null);
            }
        }

        return $this;
    }
}
