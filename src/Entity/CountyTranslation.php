<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountyTranslationRepository")
 */
class CountyTranslation
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="uuid")
     */
    private $county_id;

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
     * @Groups("countyTranslation.county")
     * @ORM\ManyToOne(targetEntity="App\Entity\County", inversedBy="translation", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $county;

    /**
     * @Groups("default")
     * @ORM\ManyToOne(targetEntity="App\Entity\Locale", inversedBy="countyTranslations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $locale;

    public function getCountyId()
    {
        return $this->county_id;
    }

    public function setCountyId($county_id): self
    {
        $this->county_id = $county_id;

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

    public function getCounty(): ?County
    {
        return $this->county;
    }

    public function setCounty(?County $county): self
    {
        $this->county = $county;

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
