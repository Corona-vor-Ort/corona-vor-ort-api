<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityTranslationRepository")
 */
class CityTranslation
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $city_id;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $locale_id;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups("cityTranslation.city")
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="translations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @Groups("cityTranslation.locale")
     * @ORM\ManyToOne(targetEntity="App\Entity\Locale", inversedBy="cityTranslations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $locale;

    public function getCityId()
    {
        return $this->city_id;
    }

    public function setCityId($city_id): self
    {
        $this->city_id = $city_id;

        return $this;
    }

    public function getLocaleId()
    {
        return $this->locale_id;
    }

    public function setLocaleId($locale_id): self
    {
        $this->locale_id = $locale_id;

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

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getLocale(): ?Locale
    {
        return $this->locale;
    }

    public function setLocale(?Locale $locale): self
    {
        $this->locale = $locale;

        return $this;
    }
}
