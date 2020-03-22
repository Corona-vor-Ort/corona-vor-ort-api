<?php declare(strict_types=1);

namespace App\Entity;

use App\Support\EntityId;
use App\Support\EntityTimestamps;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeldungKeywordTranslationRepository")
 */
class MeldungKeywordTranslation
{
    use EntityId;
    use EntityTimestamps;

    /**
     * @Groups("default")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups("meldungKeywordTranslation.keyword")
     * @ORM\ManyToOne(targetEntity="App\Entity\MeldungKeyword", inversedBy="translations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $keyword;

    /**
     * @Groups("meldungKeywordTranslation.locale")
     * @ORM\ManyToOne(targetEntity="App\Entity\Locale", inversedBy="meldungKeywordTranslations")
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

    public function getKeyword(): ?MeldungKeyword
    {
        return $this->keyword;
    }

    public function setKeyword(?MeldungKeyword $keyword): self
    {
        $this->keyword = $keyword;

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
