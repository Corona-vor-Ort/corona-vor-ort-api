<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryTranslationRepository")
 */
class CountryTranslation
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $country_id;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $locale_id;

    /**
     * @Groups("countryTranslation.country")
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="translations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @Groups("countryTranslation.locale")
     * @ORM\ManyToOne(targetEntity="App\Entity\Locale", inversedBy="countryTranslations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $locale;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getLocaleId()
    {
        return $this->locale_id;
    }

    public function setLocaleId($locale_id): self
    {
        $this->locale_id = $locale_id;

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
