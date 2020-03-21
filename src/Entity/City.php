<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=255)
     */
    private $ags;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=255)
     */
    private $osm;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $county_id;

    /**
     * @Groups("city.county")
     * @ORM\ManyToOne(targetEntity="App\Entity\County", inversedBy="cities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $county;

    /**
     * @Groups("city.translations")
     * @ORM\OneToMany(targetEntity="App\Entity\CityTranslation", mappedBy="city", orphanRemoval=true)
     */
    private $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function getAgs(): ?string
    {
        return $this->ags;
    }

    public function setAgs(string $ags): self
    {
        $this->ags = $ags;

        return $this;
    }

    public function getOsm(): ?string
    {
        return $this->osm;
    }

    public function setOsm(string $osm): self
    {
        $this->osm = $osm;

        return $this;
    }

    public function getCountyId()
    {
        return $this->county_id;
    }

    public function setCountyId($county_id): self
    {
        $this->county_id = $county_id;

        return $this;
    }

    public function getCounty(): ?County
    {
        return $this->county;
    }

    public function setCounty(?County $county): self
    {
        $this->county = $county;

        return $this;
    }

    /**
     * @return Collection|CityTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(CityTranslation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setCity($this);
        }

        return $this;
    }

    public function removeTranslation(CityTranslation $translation): self
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getCity() === $this) {
                $translation->setCity(null);
            }
        }

        return $this;
    }
}
