<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StateRepository")
 */
class State
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $country_id;

    /**
     * @Groups("state.country")
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="states")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @Groups("state.translations")
     * @ORM\OneToMany(targetEntity="App\Entity\StateTranslation", mappedBy="state", orphanRemoval=true)
     */
    private $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|StateTranslation[]
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(StateTranslation $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setState($this);
        }

        return $this;
    }

    public function removeTranslation(StateTranslation $translation): self
    {
        if ($this->translations->contains($translation)) {
            $this->translations->removeElement($translation);
            // set the owning side to null (unless already changed)
            if ($translation->getState() === $this) {
                $translation->setState(null);
            }
        }

        return $this;
    }
}
