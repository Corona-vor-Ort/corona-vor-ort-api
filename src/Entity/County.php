<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountyRepository")
 */
class County
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $country_id;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid", nullable=true)
     */
    private $state_id;

    /**
     * @Groups("county.country")
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="counties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @Groups("county.state")
     * @ORM\ManyToOne(targetEntity="App\Entity\State", inversedBy="counties")
     */
    private $state;

    /**
     * @Groups("county.translations")
     * @ORM\OneToMany(targetEntity="App\Entity\CountyTranslation", mappedBy="county", orphanRemoval=true)
     */
    private $translations;

    /**
     * @Groups("county.cities")
     * @ORM\OneToMany(targetEntity="App\Entity\City", mappedBy="county", orphanRemoval=true)
     */
    private $cities;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->cities = new ArrayCollection();
    }

    public function getCountryId()
    {
        return $this->country_id;
    }

    public function setCountryId($country_id): self
    {
        $this->country_id = $country_id;

        return $this;
    }

    public function getStateId()
    {
        return $this->state_id;
    }

    public function setStateId($state_id): self
    {
        $this->state_id = $state_id;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection|CountyTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(CountyTranslation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setCounty($this);
        }

        return $this;
    }

    public function removeTranslation(CountyTranslation $translation): self
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getCounty() === $this) {
                $translation->setCounty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->setCounty($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->cities->contains($city)) {
            $this->cities->removeElement($city);
            // set the owning side to null (unless already changed)
            if ($city->getCounty() === $this) {
                $city->setCounty(null);
            }
        }

        return $this;
    }
}
