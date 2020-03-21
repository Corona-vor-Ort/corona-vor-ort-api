<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocaleRepository")
 */
class Locale
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=255)
     */
    private $iso;

    /**
     * @Groups("locale.countryTranslations")
     * @ORM\OneToMany(targetEntity="App\Entity\CountryTranslation", mappedBy="locale", orphanRemoval=true)
     */
    private $countryTranslations;

    /**
     * @Groups("locale.stateTranslations")
     * @ORM\OneToMany(targetEntity="App\Entity\StateTranslation", mappedBy="locale", orphanRemoval=true)
     */
    private $stateTranslations;

    public function __construct()
    {
        $this->countryTranslations = new ArrayCollection();
        $this->stateTranslations = new ArrayCollection();
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

    /**
     * @return Collection|StateTranslation[]
     */
    public function getStateTranslations(): Collection
    {
        return $this->stateTranslations;
    }

    public function addStateTranslation(StateTranslation $stateTranslation): self
    {
        if (!$this->stateTranslations->contains($stateTranslation)) {
            $this->stateTranslations[] = $stateTranslation;
            $stateTranslation->setLocale($this);
        }

        return $this;
    }

    public function removeStateTranslation(StateTranslation $stateTranslation): self
    {
        if ($this->stateTranslations->contains($stateTranslation)) {
            $this->stateTranslations->removeElement($stateTranslation);
            // set the owning side to null (unless already changed)
            if ($stateTranslation->getLocale() === $this) {
                $stateTranslation->setLocale(null);
            }
        }

        return $this;
    }
}
